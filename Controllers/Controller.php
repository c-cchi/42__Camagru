<?php
abstract class Controller{
    protected $data = array();
    protected $view = "";
    protected $head = array('title' => '', 'description' => '');

    abstract function process($params);

    public function renderView(){
        if ($this->view){
            extract($this->data);
            require("Views/" . $this->view . ".phtml");
        }
    }

    public function redirect($url){
        header("Location: /$url");
        header("Connection: close");
            exit;
    }
}

// class Controller{

//     protected $data = array();
//     protected $view = "";

//     public static function loadpage($filename){
//         include "Views/$filename";
//     }
// }