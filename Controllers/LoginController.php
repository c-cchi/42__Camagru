<?php
    class LoginController extends Controller{

        public function process($params){
            $this->view = 'Login';
            if (isset($_SESSION['loggued_on_user']['user']))
                echo 'Hello User '.$_SESSION['loggued_on_user']['user'];
            else if (isset($_POST['login'])){
                $msg = $this->invoke();
                if (isset($_SESSION['loggued_on_user']['user']))
                    echo 'Hello User '.$_SESSION['loggued_on_user']['user'];
            }
            else{
                $this->renderView();
            }
        }

        public function check_user($arr){
            if ($_POST['passwd'] == $arr[0]['password']){
                return (TRUE);
            }else{
                return (FALSE);
            }
        }
    
        public function getlogin($sqlidata){
            if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] == "Login"){
                if (!$sqlidata){
                    $_SESSION['loggued_on_user']['user'] = "";
                    return ('usrnonexist');
                }else{
                    if ($this->check_user($sqlidata) === TRUE){
                        $_SESSION['loggued_on_user']['user'] = $_POST['login'];
                        return ('loggued');
                    }else{
                        $_SESSION['loggued_on_user']['user'] = "";
                        return ('pwinvalid');
                    }
                }
            }
        }

        public function invoke(){
            $qry = "SELECT `username`,`password` FROM `users` WHERE `username`= :username";
            $username = $_POST['login'];
            $arr = array('username' => $username);
            $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
            $reslt = $this->getlogin($sqlidata);
            if ($reslt == 'loggued'){
                return ('loggued in');
            }
            else{
                return ('fail to login');
            }
        }
}