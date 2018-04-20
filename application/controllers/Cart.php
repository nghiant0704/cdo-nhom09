<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller
{
    function __construct() {
        parent::__construct();

    }

    /*
     * Them sp vào giỏ hàng
     */
    function add(){
        $id = $this->uri->rsegment(3);
        $this->load->model('product_model');
        $product = $this->product_model->get_info($id);
        if(!$product)
            redirect();

        //tổng số sp
        $qty = 1;

        $price = $product->price;
        if($product->discount > 0){
            $price = $product->price - $product->discount;
        }
        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = url_title($product->name);
        $data['image_link'] = $product->image_link;
        $data['price'] = $price;
        $this->cart->insert($data);

        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('cart');
        }
    }

    /*
     * Danh sách sản phẩm trong giỏ hàng
     */
    function index(){
        //load view
        $this->data['template'] = 'front/cart/index';
        $this->load->view('front/layout', $this->data);
    }

    /*
     * Cập nhật giỏ hàng
     */
    function update(){
        $carts = $this->cart->contents();
        foreach ($carts as $key => $cart){
            $total_qty = $this->input->post('qty_'.$cart['id']);
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $this->cart->update($data);
        }

        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('cart');
        }
    }

    function delete(){
        $id = intval($this->uri->rsegment(3));

        $carts = $this->cart->contents();
        foreach ($carts as $key => $cart){
            if($cart['id'] == $id){
                $data = array();
                $data['rowid'] = $key;
                $data['qty'] = 0;
                $this->cart->update($data);
            }

        }

        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('cart');
        }
    }
}