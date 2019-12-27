<?php
abstract class Controller{
    protected $data = array();
    // which will be used to store data retrieved from models.
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

    public function addErrMessage($err){
    }
}
