<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('order_model');
    }

    function index(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $total_rows = $this->order_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this->load->library('pagination');

        //cấu hình phân trang
        $config = array();
        $config['base_url'] = admin_url('order/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
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
        $this->db->select('ORDERS."id", PRODUCT."name", "qty", "amount", ORDERS."status"');
        $this->db->join('PRODUCT', 'ORDERS."product_id" = PRODUCT."id"');

        $orders = $this->order_model->get_list($inp);
        $this->data['orders'] = $orders;

        //load view
        $this->data['template'] ='admin/order/index';
        $this->load->view('admin/layout',$this->data);
    }
    function chuyenhang(){
        $id = $this->uri->rsegment(3);
        $order = $this->order_model->get_info($id);

        if(!$order) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại Đơn hàng này');
            redirect(admin_url('order'));
        }
        $datas = array(
            'status' => 1,
        );
        $this->order_model->update($id,$datas);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Chuyển Hàng thành công!');
        redirect(admin_url('order'));
    }
    function huydon(){
        $id = $this->uri->rsegment(3);
        $order = $this->order_model->get_info($id);

        if(!$order) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại Đơn hàng này');
            redirect(admin_url('order'));
        }
        $datas = array(
            'status' => 2,
        );
        $this->order_model->update($id,$datas);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Đã hủy Dơn hàng!');
        redirect(admin_url('order'));
    }

    /*
     * Xóa 1 giao dịch
     */
    function delete(){
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa Đơn hàng thành công!');
        redirect(admin_url('order'));
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
        $product = $this->order_model->get_info($id);
        if(!$product) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại Đơn hàng này');
            redirect(admin_url('order'));
        }
        //thuc hien xoa giao
        $this->order_model->delete($id);
    }
}