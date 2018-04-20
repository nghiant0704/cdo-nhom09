<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('transaction_model');
    }

    /*
     * DS sản phẩm
     */
    function index(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $total_rows = $this->transaction_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this->load->library('pagination');

        //cấu hình phân trang
        $config = array();
        $config['base_url'] = admin_url('transaction/index');
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

        $transactions = $this->transaction_model->get_list($inp);
        $this->data['transactions'] = $transactions;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //load view
        $this->data['template'] ='admin/transaction/index';
        $this->load->view('admin/layout',$this->data);
    }


    /*
     * Xóa 1 giao dịch
     */
    function delete(){
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa Giao dịch thành công!');
        redirect(admin_url('transaction'));
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
        $product = $this->transaction_model->get_info($id);
        if(!$product) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại gkao dịch này');
            redirect(admin_url('transaction'));
        }
        //thuc hien xoa giao
        $this->transaction_model->delete($id);
    }

    function thanhtoan(){
        $id = $this->uri->rsegment(3);
        $transaction = $this->transaction_model->get_info($id);

        if(!$transaction) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại Giao dịch này');
            redirect(admin_url('transaction'));
        }
        $datas = array(
            'status' => 1,
        );
        $this->transaction_model->update($id,$datas);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Đã thanh toán!');
        redirect(admin_url('transaction'));
    }

    function huygiaodich(){
        $id = $this->uri->rsegment(3);
        $transaction = $this->transaction_model->get_info($id);

        if(!$transaction) {//ko tồn tại
            $this->session->set_flashdata('message', 'không tồn tại Giao dịch này');
            redirect(admin_url('transaction'));
        }
        $datas = array(
            'status' => 2,
        );
        $this->transaction_model->update($id,$datas);

        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Đã hủy Giao dịch!');
        redirect(admin_url('transaction'));
    }
}