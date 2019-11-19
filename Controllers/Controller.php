<?php
class Controller{

    protected $data = array();
    protected $view = "";

    public static function loadpage($filename){
        include "Views/$filename";
    }

    public function renderView(){
        if ($this->view){
            extract($this->data);
            require("Views/" . $this->view . ".phtml");
        }
    }
}