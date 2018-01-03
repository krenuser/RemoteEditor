<?php

class Js extends CI_Controller {

    public function _remap($filename) {
        if(file_exists(FCPATH.'js_data/'.$filename)) {
            //$this->output->cache(1);
            header('Content-Type: text/javascript; charset=utf-8');
            $this->load->view('vGetJS', ['js' => $filename]);
        }
        else {
            header('Content-Type: text/html; charset=utf-8');
            echo FCPATH.'js/'.$filename."<br/>";
            show_404();
        }
    }
    
}