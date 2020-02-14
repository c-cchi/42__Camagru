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

    public function checkPwdstrength($password){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,50}$/', $password) || strcmp($this->pwdrepeat, $this->pwd)) {
            return (FALSE);
        }else{
            return (TRUE);
        }
    }


    public function ctl_sendMail($username, $email, $template, $url){
        require_once ($template);
        $rslt = mb_send_mail($email, $sub, $msg, $headers);
        return ($rslt);
    }

    public function addErrMessage($err){
    }
}
