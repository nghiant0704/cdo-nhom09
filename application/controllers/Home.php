<?php
/**
 * Created by PhpStorm.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function index() {
        $this->load->model('product_model');


        //lấy 8 sp mới nhất
        $inp['order'] = array('created', 'DESC');
        $inp['limit'] = array('8', '0');
        $newproducts = $this->product_model->get_list($inp);
        $this->data['newproducts'] = $newproducts;

        //lấy 8 sp bán chạy nhất
        $inp['order'] = array('buyed', 'DESC');
        $inp['limit'] = array('8', '0');
        $topbuyedproducts = $this->product_model->get_list($inp);
        $this->data['topbuyedproducts'] = $topbuyedproducts;

        //lấy 20 sp view nhiều nhất
        $inp['order'] = array('view', 'DESC');
        $inp['limit'] = array('20', '0');
        $topviewproducts = $this->product_model->get_list($inp);
        $this->data['topviewproducts'] = $topviewproducts;

        //lấy 20 sp bất kì
        $inp['order'] = array('created', 'DESC');
        $inp['limit'] = array('30', '0');
        $allproducts = $this->product_model->get_list($inp);
        $this->data['allproducts'] = $allproducts;

        //load view
        $this->data['template'] = 'front/home/index';
        $this->load->view('front/layout', $this->data);
    }
}