<?php
/**
 * Created by PhpStorm.
 * User: ThisPC
 * Date: 21/12/2017
 * Time: 9:20 CH
 */

function public_url($url =''){
    return base_url('public/'.$url);
}

function admin_url($url = ''){
    return base_url('admin/'.$url);
}