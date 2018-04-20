<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    function __construct() {
        parent::__construct();

        $this->load->model('product_model');
    }

    /*
     * Hiển thị ds sản phẩm theo danh mục
     */
    function category(){
        //lấy id từ url
        $id = intval($this->uri->rsegment(3));

        //Lấy thông tin của danh mục
        $this->load->model('category_model');
        $category = $this->category_model->get_info($id);

        if(!$category)
            redirect();

        $this->data['categorys'] = $category;

        $input = array();

        //kt xem đây là danh mục cha hay là danh mục con
        if($category->parent_id == 0){//là danh mục cha
            $inp = array();
            $inp['where'] = array('parent_id' => $category->id);
            $category_subs = $this->category_model->get_list();
            //kiểm tra có danh mục con hay không
            if(!empty($category_subs)){//có danh mục con thì lấy product từ list id danh mục con
                $category_subs_id = array();
                foreach ($category_subs as $sub){
                    $category_subs_id[] = $sub->id;
                }
                $this->db->where_in('category_id',$category_subs_id);
            }
            else{//ko có danh mục con thì lấy từ chính id của nó
                $input['where'] = array('category_id' => $category->id);
            }
        }
        else{
            $input['where'] = array('category_id' => $category->id);
        }
        //lấy ds sản phẩm của danh mục
        //lấy tổng sl sp của danh mục
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = base_url('product/category/'.$category->id); //link hien thi ra danh sach san pham
        $config['per_page']   = 6;//so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '< Prev Page';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page >';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment);

        //lay danh sach san pham
        if(isset($category_subs_id))
        {
            $this->db->where_in('category_id', $category_subs_id);
        }
        $products = $this->product_model->get_list($input);
        $this->data['products'] = $products;

        //load view
        $this->data['template'] = 'front/product/category';
        $this->load->view('front/layout', $this->data);
    }
	
	/*
     * Chi tiết sản phẩm
     */
    function detail(){
        //lấy id sp từ url
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);

        if(!$product)
            redirect();

        //tăng số lượt view của sp trong database
        $data = array();
        $data['view'] = $product->view + 1;
        $this->product_model->update($product->id,$data);

        //Lấy tất cả comment của sản phẩm
        $this->load->model('comment_model');
        $input['where'] = array('product_id' => $product->id);
        $comments = $this->comment_model->get_list($input);

        $this->data['comments'] = $comments;

        $this->data['product'] = $product;
        $this->load->model('category_model');
        $pdcategory = $this->category_model->get_info($product->category_id);
        $this->data['pdcategory'] =$pdcategory;

        //load view
        $this->data['template'] = 'front/product/detail';
        $this->load->view('front/layout', $this->data);
    }
	
	function comment(){
        $this->load->model('comment_model');
        $user_id_login = $this->session->userdata('user_id_login');
        if(!$user_id_login)
            redirect();

        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('review-text', 'Review', 'required|min_length[6]');
            $this->form_validation->set_rules('pd_id', '', 'required');

            if($this->form_validation->run()){
                //mã hoá password
                $data = array(
                    'product_id' => $this->input->post('pd_id'),
                    'parent_id' => 0,
                    'user_name' => $this->input->post('name') ,
                    'user_email' => $this->input->post('email') ,
                    'user_id' => $user_id_login,
                    'content' => $this->input->post('review-text'),
                    'created' => date('d-M-Y h:i:s'),
                    'count_like' => 0,
                    'status' => 1,
                );
                if($this->comment_model->create($data)){
                    $this->session->set_flashdata('message', 'Thêm Review thành công!');
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi!');
                }
                redirect(base_url('product/detail/'.$this->input->post('pd_id')));
            }
        }
    }
	
	/*
     * Tìm kiếm theo tên sp
     */
    function search(){
        if($this->uri->rsegment('3') == 1)
        {
            //lay du lieu tu autocomplete
            $key =  $this->input->get('term');
        }else{
            $key =  $this->input->get('search');
        }

        $this->data['key'] = trim($key);

        $input = array();
        $input['like'] = array('LOWER("name")', strtolower($key));
        $list = $this->product_model->get_list($input);

        $this->data['list'] = $list;

        if($this->uri->rsegment('3') == 1) {
            //xu ly autocomplete
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] = $item;
            }
            //du lieu tra ve duoi dang json
            die(json_encode($result));
        }else{

            //load view
            $this->data['template'] = 'front/product/search';
            $this->load->view('front/layout', $this->data);
        }


    }
}