<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    function check_email() {
        $email = $this->input->post('txtEmail');
        $where = array('email' => $email);
        //kiêm tra xem email đã tồn tại chưa
        if($this->user_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại!');
            return false;
        }
        return true;
    }

    function register(){
        //kiểm tra user đăng nhập chưa, nếu rồi thì ko cho đăng kí
        $user_id_login = $this->session->userdata('user_id_login');
        if($user_id_login)
            redirect();

        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('txtName', 'Họ và tên', 'required|min_length[8]');
            $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|callback_check_email');
            $this->form_validation->set_rules('txtPass', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('txtRePass', 'Nhập lại mật khẩu', 'matches[txtPass]');
            $this->form_validation->set_rules('txtPhone', 'Số điện thoại', 'required|numeric|min_length[10]|max_length[12]');
            $this->form_validation->set_rules('txtAddress', 'Địa chỉ', 'required');

            if($this->form_validation->run()){
                //mã hoá password
                $pass_hash = password_hash($this->input->post('txtPass'),PASSWORD_DEFAULT);
                $data = array(
                    'name' => $this->input->post('txtName') ,
                    'email' => $this->input->post('txtEmail') ,
                    'password' => $pass_hash ,
                    'phone' => $this->input->post('txtPhone') ,
                    'address' => $this->input->post('txtAddress') ,
                    'created'    => date('d-M-Y h:i:s'),
                );
                if($this->user_model->create($data)){
                    $this->session->set_flashdata('success_msg', 'Tạo tài khoản mới thành công, bây giờ bạn có thể đăng nhập!');
                    redirect(base_url('user/login'));
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi!');
                }

            }
        }

        //load view
        $this->data['template'] = 'front/user/register';
        $this->load->view('front/layout', $this->data);
    }

    function login(){
        $user_id_login = $this->session->userdata('user_id_login');
        if($user_id_login)
            redirect();

        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post()){
            $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('txtPass', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('login' ,'login', 'callback_login_check');
            if($this->form_validation->run()) {
                redirect();
            }
        }

        //load view
        $this->data['template'] = 'front/user/login';
        $this->load->view('front/layout', $this->data);
    }

    function login_check() {
        $email = $this->input->post('txtEmail');
        $password = $this->input->post('txtPass');

        $inp['where'] = array('email' => $email);
        $user = $this->user_model->get_row($inp);
        if($user != null){//user tồn tại
            if(password_verify($password,$user->password)){//mật khẩu khớp
                $this->session->set_userdata('user_id_login', $user->id);
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

    function logout(){
        if($this->session->userdata('user_id_login')){
            $this->session->unset_userdata('user_id_login');
        }
        redirect();
    }
	
	function edit(){
        //kiểm tra user đã đăng nhập chưa, nếu chưa thì chuyển về trang chủ
        $user_id_login = $this->session->userdata('user_id_login');
        if(!$user_id_login)
            redirect();

        //lấy id của user từ session
        $id = intval($user_id_login);

        $this->load->library('form_validation');
        $this->load->helper('form');

        $user = $this->user_model->get_info($id);
        //ko tồn tại user
        if(!$user){
            $this->session->set_flashdata('message','Có lỗi');
            redirect();
        }

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|numeric|min_length[10]|max_length[12]');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            if($this->form_validation->run()){
                $data = array(
                    'name' => $this->input->post('name') ,
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address')
                );

                if($password) {
                    //mã hoá password
                    $pass_hash = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
                    $data['password'] = $pass_hash;
                }

                if($this->user_model->update($id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi');
                }

                redirect(base_url('user/info'));
            }
        }

        $this->data['template'] ='front/user/edit';
        $this->load->view('front/layout',$this->data);
    }

    function transaction(){
        $user_id_login = $this->session->userdata('user_id_login');
        if(!$user_id_login)
            redirect();

        $this->load->model('transaction_model');

        $input['where'] = array('user_id' => $user_id_login);

        $list = $this->transaction_model->get_list($input);

        $this->data['list'] = $list;

        $this->data['template'] ='front/user/transaction';
        $this->load->view('front/layout',$this->data);
    }
}