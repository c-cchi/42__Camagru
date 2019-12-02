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
            $this->view = $newuser;
            
            if ($_POST['submit'] != "SignUp" || $rslt == "fail"){
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
                if ($rslt == FALSE){
                    $this->renderView();
                }
            }
        }

        public function addUser(){
            $pwdstrength = $this->checkPwdstrength($_POST['pwd']);
            if($_POST['submit'] == "SignUp" && $pwdstrength == TRUE){
                $newusermodel = new NewuserModel();
                $rsltadduser = $newusermodel->addUserdata();
                if ($rsltadduser == FALSE){
                    echo '<div class="alert-box">Error of database.</div>';
                    return (FALSE);
                }else{
                    return (TRUE);
                }
        }elseif($_POST['submit'] == "SignUp" && $pwdstrength == FALSE){
            header("Location: newuser?error=invalidpwd&uid=".$this->username."&email=".$this->email);
            }
            return (FALSE);
        }

    public function checkPwdstrength($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return (FALSE);
        }else{
            return (TRUE);
        }
    }

}