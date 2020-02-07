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
                $this->newuser();
        }

        public function addUser(){
            $pwdstrength = $this->checkPwdstrength($this->pwd);
            $usermodel = new UserModel;
            $checkuidmail = $usermodel->checkUidmail();
            if($pwdstrength == TRUE){
                if ($checkuidmail === 'usrnmexist'){
                    header("Location: newuser?error=usrnmexist&email=".$this->email);
                }else if ($checkuidmail === 'emailexist'){
                    header("Location: newuser?error=emailexist&uid=".$this->username);
                }else if ($checkuidmail === 'valid'){
                    $usermodel->addUserdata();
                    return (TRUE);
                }
            }else if($pwdstrength == FALSE){
                header("Location: newuser?error=invalidpwd&uid=".$this->username."&email=".$this->email);
            }
        }

        public function newuser(){
            $this->view = 'newuser';
            if (!isset($_POST['signup'])){
                $this->renderView();
            }else if(empty($this->username) || empty($this->email) || empty($this->pwd)){
                header("Location: newuser?error=emptyfields&uid=".$this->username."&email=".$this->email); 
                exit();
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                header("Location: newuser?error=invalidemail&uid=".$this->username);
                exit();
            }else if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
                header("Location: newuser?error=invaliduid&email=".$email);
                exit();
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