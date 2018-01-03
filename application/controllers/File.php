<?php

class File extends CI_Controller {

    public function load() {
        $filename = $this->input->get('filename');
        if(file_exists($filename)) {
            header('Content-Type: text/javascript;');
            $content = file_get_contents($filename);
            
            die(json_encode([
                'status' => 'ok',
                'message' => 'Success!',
                'data' => [
                    'fileContent' => $content,
                    'isWritable' => (is_really_writable($filename) ? 'Y' : 'N'),
                ],
            ]));
        }
    }
    
    public function save() {
        $filename = $this->input->get('filename');
        
        if(!is_really_writable($filename)) {
            header('Content-Type: text/javascript;');
            $content = $this->input->post('content');
            
            $written = file_put_contents($filename, $content);
            
            if($written == strlen($content)) {
                die(json_encode([
                    'status' => 'ok',
                    'message' => 'Success!',
                    'data' => [
                        'fileContent' => $content,
                        'isWritable' => (is_really_writable($filename) ? 'Y' : 'N'),
                    ],
                ]));
            }
            else {
                die(json_encode([
                    'status' => 'error',
                    'message' => 'Записано меньше байт, чем ожидалось. Достаточно ли места на сервере?',
                    'data' => [
                    ],
                ]));
            }
        }
        else {
            die(json_encode([
                'status' => 'error',
                'message' => 'Невозможно записать файл. Похоже, он только для чтения.',
                'data' => [],
            ]));
        }
    }
    
    public function remove() {
        $filename = $this->input->get('filename');
        
        if(file_exists($filename) && is_really_writable($filename)) {
            if(unlink($filename)){
                die(json_encode([
                    'status' => 'ok',
                    'message' => 'successfully removed',
                    'data' => [],
                ]));
            }
        }
        die(json_encode([
            'status' => 'error',
            'message' => 'Не получилось удалить файл!',
            'data' => [],
        ]));
    }
    
    
}