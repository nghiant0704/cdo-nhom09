<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_library
{
    var $CI = '';

    function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * @param string $upload_path : đường dẫn lưu file
     * @param string $field_name : tên thẻ input upload file
     * @return mixed|string
     */
    function upload($upload_path = '', $field_name = ''){
        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);

        if($this->CI->upload->do_upload($field_name)) {
            $data = $this->CI->upload->data();
        }
        else{ //upload thất bại
            $data = $this->CI->upload->display_errors();
        }
        return $data;
    }

    /**
     * @param string $upload_path : đường dẫn lưu file
     * @param string $field_name : tên thẻ input upload file
     * @return array : tên các file upload thành công
     */
    function upload_file($upload_path = '', $field_name = '')
    {
        $config = $this->config($upload_path);

        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES[$field_name];
        $count = count($file['name']);//lấy tổng số file được upload

        $image_list = array();
        for($i=0; $i<=$count-1; $i++) {

            $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
            $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
            $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
            $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
            //load thư viện upload và cấu hình
            $this->CI->load->library('upload', $config);
            //thực hiện upload từng file
            if($this->CI->upload->do_upload())
            {
                //nếu upload thành công thì lưu toàn bộ dữ liệu
                $data = $this->CI->upload->data();
                //lưu tên file đã upload thành công vào mảng
                $image_list[] = $data['file_name'];
            }
        }
        return $image_list;
    }

    /**
     * Cấu hình upload
     *
     * @param string $upload_path
     * @return array
     */
    function config($upload_path = ''){
        $config = array();
        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        return $config;
    }
}