<?php
class Controller{

    protected $data = array();
    protected $view = "";

    public static function loadpage($filename){
        include "views/$filename";
    }

    public function renderView(){
        if ($this->view){
            extract($this->data);
            require("views/" . $this->view . ".phtml");
        }
    }
}