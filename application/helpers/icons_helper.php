<?php
defined('BASEPATH') or die('No direct script access allowed!');

if(!function_exists('insert_icon')){

    function insert_icon($name, $size = 16) {
        $CI =& get_instance(); 
        $path = $CI->load->helper(['url']);
        return "<img src='".base_url()."img/icons/{$name}.svg' style='width: {$size}px; margin-top: -3px;' />";
    }

}