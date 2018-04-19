<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 * Date: 22/12/2017
 * Time: 10:34 CH
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index(){
        $categories = $this->category_model->get_list();

        $this->data['categories'] = $categories;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //load view
        $this->data['template'] ='admin/category/index';
        $this->load->view('admin/layout',$this->data);

    }

    function add(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên', 'required');

            if($this->form_validation->run()){
                $data = array(
                    'name'      => $this->input->post('name'),
                    'parent_id' => $this->input->post('parent_id'),
                    'sort_order' => intval($this->input->post('sort_order'))
                );

                if($this->category_model->create($data)){
                    $this->session->set_flashdata('message', 'Thêm thành công!');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }

                redirect(admin_url('category'));
            }
        }

        //lấy danh sách danh mục cha
        $inp = array();
        $inp['where'] = array('parent_id' => 0);
        $parents = $this->category_model->get_list($inp);
        $this->data['parents']  = $parents;

        $this->data['template'] ='admin/category/add';
        $this->load->view('admin/layout',$this->data);
    }

    function edit(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        //lấy id từ url
        $id = $this->uri->rsegment(3);
        $category = $this->category_model->get_info($id);

        if(!$category) {
            $this->session->set_flashdata('message', 'không tồn tại danh mục này!');
            redirect(admin_url('category'));
        }
        $this->data['category'] = $category;

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên', 'required');

            if($this->form_validation->run()){
                $data = array(
                    'name'      => $this->input->post('name'),
                    'parent_id' => $this->input->post('parent_id'),
                    'sort_order' => intval($this->input->post('sort_order'))
                );

                if($this->category_model->update($id, $data)) {

                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                }else{
                    $this->session->set_flashdata('message', 'Có lỗi');
                }

                redirect(admin_url('category'));
            }
        }

        //lấy danh sách danh mục cha
        $inp = array();
        $inp['where'] = array('parent_id' => 0);
        $parents = $this->category_model->get_list($inp);
        $this->data['parents']  = $parents;

        $this->data['template'] ='admin/category/edit';
        $this->load->view('admin/layout',$this->data);
    }

    function delete(){
        //lay id từ url
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('category'));
    }

    /*
     * Xóa nhiều Danh mục
     */
    function delete_multi(){
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id , false);
        }
    }

    private function _del($id, $rediect = true) {
        $category = $this->category_model->get_info($id);
        if(!$category) {//ko tồn tại
            $this->session->set_flashdata('message', 'Danh mục ko tồn tại!');
            if($rediect) {
                redirect(admin_url('category'));
            }
            else{
                return false;
            }
        }

        //kt danh mục có sp hay ko
        $this->load->model('product_model');
        $product = $this->product_model->get_info_rule(array('category_id' => $id), 'id');
        if($product) {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Danh mục '.$category->name.' có chứa sản phẩm,bạn cần xóa các sản phẩm trước khi xóa danh mục');
            if($rediect) {
                redirect(admin_url('category'));
            }
            else{
                return false;
            }
        }

        //kt danh mục có danh mục con hay ko
        $catalog_check = $this->catalog_model->get_info_rule(array('parent_id' => $category->id,'id'));
        if ($catalog_check){
            $this->session->set_flashdata("message",'Danh mục '.$category->name.' có chứa Danh mục con, bạn cần xóa các Danh mục con trước khi xóa Danh mục cha');
            if($rediect) {
                redirect(admin_url('category'));
            }
            else{
                return false;
            }
        }

        //thực hiện xóa
        $this->catalog_model->delete($id);

    }
}