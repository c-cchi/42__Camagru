<?php
    class NewuserController extends Controller{
        protected $username;
        protected $email;
        protected $pwd;
        protected $pwdrepeat;

        public function __construct(){
            if (isset($_POST['uid'])){
                $this->username = $_POST['uid'];
            }if (isset($_POST['email'])){
                $this->email = $_POST['email'];
            }if (isset($_POST['pwd'])){
                $this->pwd = $_POST['pwd'];
            }if (isset($_POST['pwd-repeat'])){
                $this->pwdrepeat = $_POST['pwd-repeat'];
            }
        }

        public function process($newuser){

            if (isset($_POST['uid'])){
                $reslt = $this->newuser();
            }else{
                $this->view = 'newuser';
                $this->renderView();
            }
        }

        public function addUser(){
            $pwdstrength = $this->checkPwdstrength($this->pwd);
            $usermodel = new UserModel;
            $checkuidmail = $usermodel->checkUidmail();
            if($pwdstrength == TRUE){
                if ($checkuidmail === 'username exist'){
                    header("Location: newuser?error=usrnmexist&email=".$this->email);
                    exit;
                }else if ($checkuidmail === 'email exist'){
                    header("Location: newuser?error=emailexist&uid=".$this->username);
                    exit;
                }else if ($checkuidmail === 'valid'){
                    $usermodel->addUserdata();
                    return (TRUE);
                }
            }else if($pwdstrength == FALSE){
                header("Location: newuser?error=invalidpwd&uid=".$this->username."&email=".$this->email);
                exit;
            }
        }

        public function newuser(){
            $this->view = 'newuser';
            if (!isset($_POST['signup'])){
                $this->renderView();
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                header("Location: newuser?error=invalidemail&uid=".$this->username);
            }else if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
                header("Location: newuser?error=invaliduid&email=".$email);
            }else{
                $rslt = $this->addUser();
                if ($rslt == TRUE){
                    $this->redirect("gallery");
                }else{
                    header("Location: newuser?error=sql");
                }
            }
        }
    }
