<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class  Admin extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    /*
     * ds admin
     */
    function index(){
        $input = array();
        $admins = $this->admin_model->get_list($input);
        $this->data['admins'] = $admins;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['template'] ='admin/admin/index';
        $this->load->view('admin/layout',$this->data);

    }


    function check_username() {
        $username = $this->input->post('username');
        $where = array('username' => $username);
        //kiêm tra xem username đã tồn tại chưa
        if($this->admin_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại!');
            return false;
        }
        return true;
    }

    /*
     * thêm mới 1 admin
     */
    function add(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');

            if($this->form_validation->run()){
                //mã hoá password
                $pass_hash = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
                $data = array(
                    'name' => $this->input->post('name') ,
                    'username' => $this->input->post('username') ,
                    'password' => $pass_hash ,
                );
                if($this->admin_model->create($data)){
                    $this->session->set_flashdata('message', 'Tạo tài khoản mới thành công!');
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi!');
                }
                redirect(admin_url('admin'));
            }
        }

        $this->data['template'] ='admin/admin/add';
        $this->load->view('admin/layout',$this->data);

    }

    function edit(){
        //lấy id từ url
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $this->load->library('form_validation');
        $this->load->helper('form');

        $admin = $this->admin_model->get_info($id);
        if(!$admin){
            $this->session->set_flashdata('message','Admin không tồn tại');
            redirect(admin_url('admin'));
        }
        $this->data['admin'] = $admin;

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');

            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            if($this->form_validation->run()){
                $data = array(
                    'name' => $this->input->post('name') ,
                    'username' => $this->input->post('username'),
                );

                if($password) {
                    //mã hoá password
                    $pass_hash = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
                    $data['password'] = $pass_hash;
                }

                if($this->admin_model->update($id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi');
                }
                //chuyen tới trang danh sách Admin
                redirect(admin_url('admin'));
            }

        }

        $this->data['template'] ='admin/admin/edit';
        $this->load->view('admin/layout',$this->data);

    }

    function delete(){
        //lấy id từ url
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $admin = $this->admin_model->get_info($id);
        if(!$admin){
            $this->session->set_flashdata('message','Admin không tồn tại');
            redirect(admin_url('admin'));
        }

        $this->admin_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('admin'));
    }

    function logout(){
        if($this->session->userdata('login')){
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
}