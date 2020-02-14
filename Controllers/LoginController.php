<?php
    class LoginController extends Controller{
        protected $username;

        public function process($parsedUrl){
            $this->view = 'Login';
            if (isset($_POST['uid'])){
                $this->username = $_POST['uid'];
            }
            if(isset($_POST['submit']) && $_POST['submit'] == "Logout"){
                session_destroy();
                $this->redirect('index');
            }else if(isset($_SESSION['user'])){
                include "views/Logout.phtml";
            }else if (isset($parsedUrl[1]) && $parsedUrl[1] === 'forgot_password'){
                if (isset($_POST['fgpwdbtn'])){
                    $checkuidmail = $this->invoke();
                    if ($checkuidmail === 'reset password'){
                        $this->mailresetPwd();
                    }else{
                        header("Location: /login/forgot_password?error=usrnotexist");
                        exit;
                    }
                }else{
                    require_once "Views/forgot_password.phtml";
                }
            }else if (isset($parsedUrl[1]) && $parsedUrl[1] === 'reset'){
                if (isset($_GET['token'])){
                    // if () //usrn and salted token correspond
                    $salt = 'resetpwdforcamagru:o';
                    $token = hash('sha1',$sqlidata[0]['username'].$sqlidata[0]['password'].$sqlidata[0]['no'].$salt);
                }
            }else if(isset($_POST['uid'])){
                $rsltlogin = $this->invoke();
                if (isset($_SESSION['user'])){
                    $this->redirect('gallery');
                }else{
                    if ($rsltlogin === 'usrnotexist'){
                        header("Location: login?error=usrnotexist");
                    }else{
                        header("Location: login?error=incorrectpwd&uid=".$this->username);
                    }
                }
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
                    $rslt = $this->check_user($sqlidata[0]);
                    if ($rslt == TRUE){
                        $_SESSION['user'] = $sqlidata[0]['username'];
                        $_SESSION['no'] = $sqlidata[0]['no'];
                        $_SESSION['email'] = $sqlidata[0]['email'];
                        return (TRUE);
                    }else{
                        return ('incorrectpwd');
                    }
            }
        }

        public function invoke(){
            $qry = "SELECT `username`,`password`,`no`,`email` FROM `users` WHERE `username`= :username OR `email`= :username";
            $arr = array('username' => $this->username);
            $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
            if (!isset($sqlidata[0])){
                return ('usrnotexist');
            }else if (isset($_POST['fgpwdbtn'])){
                return ('reset password');
            }else{
                $rslt = $this->getlogin($sqlidata);
                return ($rslt);
            }
        }

        public function mailresetPwd(){
            $getpasstime = time();
            $qry = "SELECT `username`,`password`,`no`,`email` FROM `users` WHERE `username`= :username OR `email`= :username";
            $arr = array('username' => $this->username);
            $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
            $salt = 'resetpwdforcamagru:o';
            $token = hash('sha1',$sqlidata[0]['username'].$sqlidata[0]['password'].$sqlidata[0]['no'].$salt);
            $url = 'localhost:8080/login/reset?uid='.$this->username."&token=".$token;
            $time = date('Y-m-d H:i');
            $template = "mail/resetpwd.php";
            $rslt = $this->sendMail($sqlidata[0]['username'], $sqlidata[0]['email'], $template, $url);
            if ($rslt == TRUE){
                echo "<p>We just sended a reset password email to ".$sqlidata[0]['email']."</p>";
            }else{
                echo "<p>problem of send email to reset password</p>";
            }
        }
}