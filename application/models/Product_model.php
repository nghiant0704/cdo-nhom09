<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model
{
    var $table = 'PRODUCT';

    function topmonth($month,$year){
        $this->db->select('order.product_id,product.name as name, SUM(order.qty) as qty');
        $this->db->from('transaction');
        $this->db->join('order','transaction.id = order.transaction_id');
        $this->db->join('product', 'order.product_id = product.id');
        $this->db->where('MONTH(date(transaction.created))',$month);
        $this->db->where('YEAR(date(transaction.created))',$year);
        $this->db->group_by('order.product_id');
        $this->db->order_by('SUM(order.qty)','DESC');

        $query = $this->db->get()->result();

        return $query;
    }

    function thongkesl($month,$year){
        $this->db->select('DATE(transaction.created) as date, order.product_id, product.name as name , SUM(order.qty) as qty');
        $this->db->from('transaction');
        $this->db->join('order','transaction.id = order.transaction_id');
        $this->db->join('product', 'order.product_id = product.id');
        $this->db->where('MONTH(date(transaction.created))',$month);
        $this->db->where('YEAR(date(transaction.created))',$year);
        $this->db->where('date(transaction.created) IN ','(SELECT DATE(transaction.created) FROM transaction GROUP BY transaction.created)',false);
        $this->db->group_by('order.product_id');

        $query = $this->db->get()->result();

        return $query;
    }

    /*
     * Thống kê tiền bán đc hàng ngày của tháng
     */
    function thongketien($month,$year){
        $this->db->select('date(transaction.created) as date, SUM(transaction.amount) as amount');
        $this->db->from('transaction');
        $this->db->join('order','transaction.id = order.transaction_id');
        $this->db->where('MONTH(date(transaction.created))',$month);
        $this->db->where('YEAR(date(transaction.created))',$year);
        $this->db->where('date(transaction.created) IN ','(SELECT DATE(transaction.created) FROM transaction GROUP BY transaction.created)',false);

        $query = $this->db->get()->result();

        return $query;
    }
}