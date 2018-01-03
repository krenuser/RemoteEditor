<?php

class Filelist extends CI_Controller {

    public function get() {
        $path = $this->input->post('path');
        
        if($path == '')
            die;
        
        chdir($path);
        $fl = glob('*');
        
        sort($fl);
        
        // draw "up" link
        if($path != '/')
            $this->load->view('vFSItem', [
                'item_name' => '..', 
                'item_type' => 'up', 
                'path' => dirname($path)
            ]);
        
        // draw folders
        foreach($fl as $item) {
            if(is_dir($item)){
                $this->load->view('vFSItem', [
                    'item_path' => $path,
                    'item_name' => $item, 
                    'item_type' => 'folder',
                ]);
            }
        }
        // draw files
        foreach($fl as $item) {
            if(!is_dir($item)){
                $this->load->view('vFSItem', [
                    'item_path' => $path,
                    'item_name' => $item, 
                    'item_type' => 'file',
                ]);
            }
        }
    }

}