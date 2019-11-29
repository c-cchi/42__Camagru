<?php
    class NewuserController extends Controller{
        protected $username;
        protected $email;
        protected $pwd;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['mail'];
            $this->pwd = $_POST['pwd'];
        }

        public function process($newuser){
            $this->view = $newuser;
            
            if ($_POST['submit'] != "SignUp" || $rslt == "fail"){
                $this->renderView();
            }else if(empty($this->username) || empty($this->email) || empty($this->pwd)){
                header("Location: newuser?error=emptyfields&uid=".$this->username."&email=".$this->email); 
            }else{
                $rslt = $this->addUser();
                if ($rslt == FALSE);
            }
        }

        public function addUser(){
            if($_POST['submit'] == "SignUp" && $this->checkPwdstrength($_POST['pwd']) == "TRUE"){
                $newusermodel = new NewuserModel();
                $newusermodel->addUserdata();
                // if (Connection:: ) success
            return ("");
            }
    }

    public function checkPwdstrength($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            echo '<h3>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</h3>';
            return (FALSE);
        }else{
            return (TRUE);
        }
    }
}