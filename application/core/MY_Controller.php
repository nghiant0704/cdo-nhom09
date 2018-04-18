<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = array();

    function __construct() {
        parent::__construct();

        $controller = $this->uri->segment(1);
        switch ($controller){
            case 'admin':{
                //truy cập admin
                $this->_check_login();

                $this->data['admin_info'] = $this->session->userdata('login');
                break;
            }
            default: {
                //trang kkhac admin

                //lấy ds Danh mục sp
                $this->load->model('category_model');

                //lấy ra danh mục cha (parent_id = 0)
                $inp = array();
                $inp['where'] = array('parent_id' => 0);
                $categories = $this->category_model->get_list($inp);

                foreach ($categories as $category){
                    //lấy danh mục con từ id của danh mục cha (parent_id = category->id)
                    $inp['where'] = array('parent_id' => $category->id);
                    $subs = $this->category_model->get_list($inp);

                    //gán tất cả các danh mục con vào biến $subs của danh mục cha
                    $category->subs = $subs;
                }

                $this->data['categories'] = $categories;


                $this->load->library('cart');
                $this->data['total_cart'] = $this->cart->total_items();
                $this->data['amount_cart'] = $this->cart->total();
                $carts = $this->cart->contents();

                $this->data['carts'] = $carts;

                //kiểm tra user đã đăng nhập hay chưa
                $user_id_login = $this->session->userdata('user_id_login');
                $this->data['user_id_login'] = $user_id_login;
                if($user_id_login){
                    $this->load->model('user_model');
                    $user_info = $this->user_model->get_info($user_id_login);

                    $this->data['user_info'] = $user_info;
                }
            }
        }
    }

    private function _check_login(){
        $controller = $this->uri->rsegment(1);
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        //nếu chưa đăng nhập chỉ cho vào trang login
        if(!$login && $controller != 'login'){
            redirect(admin_url('login'));
        }

        //đã đăng nhập nhưng cố tình vào trang login
        if($login && $controller == 'login'){
            redirect(admin_url('home'));
        }
    }
}