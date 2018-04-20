<?php
/**
 * Created by PhpStorm.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{
    function __construct() {
        parent::__construct();
    }

    /*
     * Lấy thông tin khách hàng
     */
    function checkout(){
        $carts = $this->cart->contents();

        $total_items = $this->cart->total_items();
        if($total_items <= 0)
            redirect();

        //tổng số tiền cần thanh toán
        $total_amount = 0;
        foreach ($carts as $cart) {
            $total_amount = $total_amount + $cart['subtotal'];
        }
        $this->data['total_amount'] = $total_amount;

        //nếu đã đăng nhập thì lấy thông tin của thành viên
        $user_id = 0;
        $user = '';
        if($this->session->userdata('user_id_login'))
        {
            //lay thong tin cua thanh vien
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->user_model->get_info($user_id);
        }
        $this->data['user']  = $user;

        $this->load->library('form_validation');
        $this->load->helper('form');

        //neu ma co du lieu post len thi kiem tra
        if($this->input->post()){
            $this->form_validation->set_rules('txtEmail', 'Email nhận hàng', 'required|valid_email');
            $this->form_validation->set_rules('txtName', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('txtPhone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('txtAddress', 'Địa chỉ nhận hàng', 'required');
            $this->form_validation->set_rules('txtNote', 'Ghi chú', 'required');
            $this->form_validation->set_rules('payment', 'Cổng thanh toán', 'required');

            //nhập liệu chính xác
            if($this->form_validation->run()) {
                $payment = $this->input->post('payment');
                //them vao csdl
                $data = array(
                    'status'   => 0, //trạng thái chưa thanh toán
                    'user_id'  => $user_id, //id thanh vien mua hang neu da dang nhap
                    'user_email'    => $this->input->post('txtEmail'),
                    'user_name'     => $this->input->post('txtName'),
                    'user_phone'    => $this->input->post('txtPhone'),
                    'message'       => $this->input->post('txtNote'), //ghi chú khi mua hàng
                    'amount'        => $total_amount,//tong so tien can thanh toan
                    'payment'       => $payment, //cổng thanh toán,
                    'created'    => date('d-M-Y h:i:s'),
                );
                //them du lieu vao bang transaction
                $this->load->model('transaction_model');
                $this->transaction_model->create($data);
				
				//lấy ra id của giao dịch vừa thêm vào
				$this->db->select_max('id');
				$this->db->from('TRANSACTIONS');
				$transaction_id = $this->db->get()->result()[0]->id;
				
				//them vao bảng order (chi tiết đơn hàng)
                $this->load->model('order_model');
                $this->load->model('product_model');
                foreach ($carts as $cart)
                {
                    $data = array(
                        'transaction_id' => $transaction_id,
                        'product_id'     => $cart['id'],
                        'qty'            => $cart['qty'],
                        'amount'         => $cart['subtotal'],
                        'status'         => 0,
                    );
                    $this->order_model->create($data);

                    //tăng mục buyed của product lên
                    $product = $this->product_model->get_info($cart['id']);
                    $datas = array(
                        'buyed' => $cart['qty'] + $product->buyed,
                    );

                    $this->product_model->update($cart['id'],$datas);
                }
                //xóa toàn bô giỏ hang
                $this->cart->destroy();
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Bạn đã đặt hàng thành công, chúng tôi sẽ kiểm tra và gửi hàng cho bạn');

                redirect();
            }
        }

        //load view
        $this->data['template'] = 'front/order/checkout';
        $this->load->view('front/layout', $this->data);
    }
}