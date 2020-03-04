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

    public function checkPwdstrength($password){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            return (FALSE);
        }else{
            return (TRUE);
        }
    }


    public function sendMail($username, $email, $template, $url){
        require_once ($template);
        return (mb_send_mail($email, $sub, $msg, $headers));
    }

}
