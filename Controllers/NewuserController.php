<?php
    class NewuserController extends Controller{
        protected $username;
        protected $email;
        protected $pwd;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['email'];
            $this->pwd = $_POST['pwd'];
        }

        public function process($newuser){
            $this->view = 'newuser';
            
            if ($_POST['submit'] != "SignUp"){
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
                $rslt = $this->addUser();
                if ($rslt == TRUE){
                    $this->redirect('gallery');
                
                }
                // $this->renderView();
            }
        }

        public function addUser(){
            $pwdstrength = $this->checkPwdstrength($_POST['pwd']);
            $newusermodel = new NewuserModel;

            if($pwdstrength == TRUE){
                $checkuidmail = $newusermodel->checkUidmail();

                if ($chekuidmail === 'usrnmexist'){
                    header("Location: newuser?error=usrnmexist&email=".$this->email);
                }else if ($chekuidmail === 'emailexist'){
                    header("Location: newuser?error=emailexist&uid=".$this->username);
                }else if ($chekuidmail === 'valid'){
                    return ($newusermodel->addUserdata());
                }
            }else if($pwdstrength == FALSE){
                header("Location: newuser?error=invalidpwd&uid=".$this->username."&email=".$this->email);
            }
            return (FALSE);
        }

    public function checkPwdstrength($password){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            return (FALSE);
        }else{
            return (TRUE);
        }
    }

}