<?php
    class NewuserController extends Controller{
        protected $username;
        protected $email;
        protected $pwd;

        public function __construct(){
            if (isset($_POST['uid'])){
                $this->username = $_POST['uid'];
            }if (isset($_POST['email'])){
                $this->email = $_POST['email'];
            }if (isset($_POST['pwd'])){
                $this->pwd = $_POST['pwd'];
            }
        }

        public function process($newuser){
            $this->view = 'newuser';
            
            if (empty($_POST['signup'])){
                $this->renderView();
            }else if(empty($this->username) || empty($this->email) || empty($this->pwd)){
                header("Location: newuser?error=emptyfields&uid=".$this->username."&email=".$this->email); 
                exit();
            }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) === true){
                header("Location: newuser?error=invalidemail");
                exit();
            }else if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
                header("Location: newuser?error=invaliduid&email=".$email);
                exit();
            }else{
                $this->addUser();
                // $this->redirect('gallery');
            }
        }

        public function addUser(){
            $pwdstrength = $this->checkPwdstrength($this->pwd);
            $newusermodel = new NewuserModel;
            $checkuidmail = $newusermodel->checkUidmail();
            if($pwdstrength == TRUE){
                if ($checkuidmail === 'usrnmexist'){
                    header("Location: newuser?error=usrnmexist&email=".$this->email);
                }else if ($checkuidmail === 'emailexist'){
                    header("Location: newuser?error=emailexist&uid=".$this->username);
                }else if ($checkuidmail === 'valid'){
                    $newusermodel->addUserdata();
                    // $newusermodel->addProfile();
                }
            }else if($pwdstrength == FALSE){
                header("Location: newuser?error=invalidpwd&uid=".$this->username."&email=".$this->email);
            }
        }

    public function checkPwdstrength($password){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            return (FALSE);
        }else{
            return (TRUE);
        }
    }
}