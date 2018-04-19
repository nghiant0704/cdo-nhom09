<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    /*
     * DS người dùng
     */
    function index(){

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        $total_rows = $this->user_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this->load->library('pagination');

        //cấu hình phân trang
        $config = array();
        $config['base_url'] = admin_url('user/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 4;
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
        $email = $this->input->get('email');
        if($email) {
            $inp['like'] = array('email', $email);
        }

        $users = $this->user_model->get_list($inp);
        $this->data['users'] = $users;


        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //load view
        $this->data['template'] ='admin/user/index';
        $this->load->view('admin/layout',$this->data);
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

    function add(){
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
                    $this->session->set_flashdata('message', 'Tạo tài khoản mới thành công!');
                }
                else{
                    $this->session->set_flashdata('message', 'Có lỗi!');
                }
                redirect(admin_url('user'));
            }
        }

        $this->data['template'] ='admin/user/add';
        $this->load->view('admin/layout',$this->data);

    }

    function edit(){
        //lấy id từ url
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $this->load->library('form_validation');
        $this->load->helper('form');

        $user = $this->user_model->get_info($id);
        if(!$user){
            $this->session->set_flashdata('message','User không tồn tại');
            redirect(admin_url('user'));
        }
        $this->data['user'] = $user;

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
                //chuyen tới trang danh sách Admin
                redirect(admin_url('user'));
            }

        }

        $this->data['template'] ='admin/user/edit';
        $this->load->view('admin/layout',$this->data);
    }

    /*
     * Xóa 1 giao dịch
     */
    function delete(){
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa Thành viên thành công!');
        redirect(admin_url('user'));
    }


    /*
     * Xóa nhiều giao dịch
     */
    function delete_multi(){
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id);
        }
    }

    private function _del($id)
    {
        $user = $this->user_model->get_info($id);
        if(!$user) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại gkao dịch này');
            redirect(admin_url('user'));
        }
        //thuc hien xoa giao
        $this->user_model->delete($id);
    }
}