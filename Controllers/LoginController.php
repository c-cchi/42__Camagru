<?php
    class LoginController extends Controller{

        protected $username;

        public function process($login){
            $this->view = 'Login';
            if(isset($_POST['uid'])){
                $this->invoke();
                if (isset($_SESSION['user'])){
                    $this->redirect('gallery');
                }
            }
            if(isset($_POST['submit']) && $_POST['submit'] == "Logout"){
                session_destroy();
                $this->redirect('index');
            }else if(isset($_SESSION['user'])){
                include "views/Logout.phtml";
            }else{
                $this->renderView();
            }
        }

        public function check_user($arr){
            if (password_verify($_POST['passwd'], $arr['password']) == TRUE){
                return (TRUE);
            }else{
                return (FALSE);
            }
        }

        public function getlogin($sqlidata){
            if (isset($_POST['uid']) && isset($_POST['passwd'])){
                if (!isset($sqlidata)){
                    session_destroy();
                    header("Location: login?error=usrnotexist");
                }else{
                    $rslt = $this->check_user($sqlidata[0]);
                    if ($rslt == TRUE){
                        $_SESSION['user'] = $sqlidata[0]['username'];
                        $_SESSION['no'] = $sqlidata[0]['no'];
                        return (TRUE);
                    }else{
                        session_destroy();
                        header("Location: login?error=incorrectpwd&uid=".$this->username);
                    }
                }
            }else{
                header("Location: login?error=emptyfields");
            }
        }

        public function invoke(){
            $qry = "SELECT `username`,`password`,`no`,`email` FROM `users` WHERE `username`= :username OR `email`= :username";
            $username = $_POST['uid'];
            $arr = array('username' => $username);
            $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
            $rslt = $this->getlogin($sqlidata);
            return ($rslt);
        }
}