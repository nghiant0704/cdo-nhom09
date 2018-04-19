<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
    }

    /*
     * DS sản phẩm
     */
    function index(){

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this->load->library('pagination');

        //cấu hình phân trang
        $config = array();
        $config['base_url'] = admin_url('product/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
        //khởi chạy cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = intval($this->uri->segment(4));

        $inp = array();
        $inp['limit'] = array($config['per_page'],$segment);

        //kt có lọc hay ko
        $id = $this->input->get('id');
        if($id > 0){
            $inp['where']['id'] = $id;
        }
        $name = $this->input->get('name');
        if($name) {
            $inp['like'] = array('name', $name);
        }
        $category_id = intval($this->input->get('category'));
        if($category_id > 0) {
            $inp['where']['category_id'] = $category_id;
        }

        $products = $this->product_model->get_list($inp);
        $this->data['products'] = $products;

        //lấy ds danh mục sp để đổ vào phần lọc theo thể loại
        $this->load->model('category_model');
        $inp = array();
        $inp['where'] = array('parent_id' => 0);
        $categories = $this->category_model->get_list($inp);

        foreach ($categories as $category) {
            $input['where'] = array('parent_id' => $category->id);
            $subs = $this->category_model->get_list($input);
            $category->subs = $subs;
        }
        $this->data['categories'] = $categories;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //load view
        $this->data['template'] ='admin/product/index';
        $this->load->view('admin/layout',$this->data);
    }

    function add(){
        //lấy ds danh mục sp để đổ vào field thể loại
        $this->load->model('category_model');
        $inp = array();
        $inp['where'] = array('parent_id' => 0);
        $categories = $this->category_model->get_list($inp);

        foreach ($categories as $category) {
            $input['where'] = array('parent_id' => $category->id);
            $subs = $this->category_model->get_list($input);
            $category->subs = $subs;
        }
        $this->data['categories'] = $categories;


        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()) {

            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('category', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
            $this->form_validation->set_rules('ytb_link', 'Youtube Embed link', 'required');

            if($this->form_validation->run()) {
                //them vao csdl
                $name        = $this->input->post('name');
                $category_id  = $this->input->post('category');
                $price       = $this->input->post('price');
                $price       = str_replace(',', '', $price);

                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
				if($discount == '')
					$discount = 0;

                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name'])) {
                    $image_link = $upload_data['file_name'];
                }

                //upload cac anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list = json_encode($image_list);
				
                //luu du lieu can them
                $data = array(
                    'name'       => $name,
                    'category_id' => $category_id,
                    'price'      => $price,
                    'image_link' => $image_link,
                    'image_list' => $image_list,
                    'discount'   => $discount,
                    'warranty'   => $this->input->post('warranty'),
                    'gifts'      => $this->input->post('gifts'),
                    'content'    => $this->input->post('content'),
                    'video'     => $this->input->post('ytb_link'),
                    'created'    => date('d-M-Y h:i:s'),
					"maker_id" => 0,
					"total" => 0,
					"buyed" => 0,
                );
                //them moi vao csdl
                if($this->product_model->create($data)) {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm sản phẩm thành công');
                }
                else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }

                redirect(admin_url('product'));
            }
        }


        //load view
        $this->data['template'] ='admin/product/add';
        $this->load->view('admin/layout',$this->data);
    }

    function edit(){
        //lấy id từ URL
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);
        if(!$product) {//ko tồn tại
            //thông báo lỗi
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->data['product'] = $product;

        //lay danh sach danh muc san pham
        $this->load->model('category_model');
        $inp = array();
        $inp['where'] = array('parent_id' => 0);
        $categories = $this->category_model->get_list($inp);
        foreach ($categories as $category) {
            $inp['where'] = array('parent_id' => $category->id);
            $subs = $this->category_model->get_list($inp);
            $category->subs = $subs;
        }
        $this->data['categories'] = $categories;

        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('category', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');

            if($this->form_validation->run()) {
                //them vao csdl
                $name        = $this->input->post('name');
                $category_id  = $this->input->post('category');
                $price       = $this->input->post('price');
                $price       = str_replace(',', '', $price);

                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);

                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name'])) {
                    $image_link = $upload_data['file_name'];
                }

                //upload cac anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);

                //luu du lieu can them
                $data = array(
                    'name'       => $name,
                    'category_id' => $category_id,
                    'price'      => $price,
                    'discount'   => $discount,
                    'warranty'   => $this->input->post('warranty'),
                    'gifts'      => $this->input->post('gifts'),
                    'content'    => $this->input->post('content'),
                );

                //có sửa ảnh sản phẩm
                if($image_link != '') {
                    $data['image_link'] = $image_link;

                    //xóa ảnh cũ của sản phẩm
                    $image_link = './upload/product/'.$product->image_link;
                    if(file_exists($image_link)) {
                        unlink($image_link);
                    }

                }

                //có sửa ảnh kèm theo sp
                if(!empty($image_list)) {
                    $data['image_list'] = $image_list_json;

                    //xóa các ảnh kèm theo cụ của sp
                    $image_list = json_decode($product->image_list);
                    if(is_array($image_list)) {
                        foreach ($image_list as $img) {
                            $image_link = './upload/product/'.$img;
                            if(file_exists($image_link)) {
                                unlink($image_link);
                            }
                        }
                    }
                }

                //them moi vao csdl
                if($this->product_model->update($product->id, $data)) {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('product'));
            }
        }

        //load view
        $this->data['template'] = 'admin/product/edit';
        $this->load->view('admin/layout', $this->data);
    }

    /*
     * Xóa 1 sp
     */
    function delete(){
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa Sản phẩm thành công!');
        redirect(admin_url('product'));
    }


    /*
     * Xóa nhiều sản phẩm
     */
    function delete_multi(){
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id);
        }
    }

    private function _del($id)
    {
        $product = $this->product_model->get_info($id);
        if(!$product) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        //thuc hien xoa san pham
        $this->product_model->delete($id);
        //xóa ảnh của sản phẩm
        $image_link = './upload/product/'.$product->image_link;
        if(file_exists($image_link)) {
            unlink($image_link);
        }
        //xóa các ảnh kèm theo của sp
        $image_list = json_decode($product->image_list);
        if(is_array($image_list)) {
            foreach ($image_list as $img) {
                $image_link = './upload/product/'.$img;
                if(file_exists($image_link))
                {
                    unlink($image_link);
                }
            }
        }
    }
}