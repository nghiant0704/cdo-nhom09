<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    function __construct(){
        parent::__construct();

        $this->load->model('admin_model');
    }

    function index(){
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('login' ,'login', 'callback_login_check');
            if($this->form_validation->run()) {
                redirect(admin_url('home'));
            }
        }

        $this->load->view('admin/login/index',$this->data);
    }

    function login_check() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $inp['where'] = array('username' => $username);
        $admin = $this->admin_model->get_row($inp);

        if($admin != null){//user tồn tại
            if(password_verify($password,$admin->password)){//mật khẩu khớp
                $login = array('name' => $admin->name, 'username' => $admin->username);
                $this->session->set_userdata('login', $login);
                return TRUE;
            }
            else{//ko khớp
                $this->form_validation->set_message('login_check', 'Sai Username hoặc Password.');
                return FALSE;
            }
        }
        else{//user ko tồn tại
            $this->form_validation->set_message('login_check', 'Sai Username hoặc Password.');
            return FALSE;
        }
    }
}