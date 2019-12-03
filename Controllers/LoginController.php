<?php
    class LoginController extends Controller{

        public function process($login){
            $this->view = 'Login';
            if (isset($_SESSION['logged_on_user']['user'])){
                $this->redirect('gallery');
            }else if(isset($_POST['login'])){
                $msg = $this->invoke();
                // echo $msg.'<br/>';
                if (isset($_SESSION['logged_on_user']['user'])){
                    echo "hello user";
                    // $this->redirect('gallery');
                }else{
                    echo "error of login";
                }
            }else if(isset($_POST['logout'])){
                session_destroy();
                // $this->redirect('index');
            }else{
                $this->renderView();
            }
        }

        public function check_user($arr){
            if (password_verify($_POST['passwd'], $arr[0]['password']) == TRUE){
                return (TRUE);
            }else{
                return (FALSE);
            }
        }
    
        public function getlogin($sqlidata){
            if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] == "Login"){
                if (!$sqlidata){
                    // session_destroy();
                    return ('usrnonexist');
                }else{
                    if ($this->check_user($sqlidata) == TRUE){
                        $_SESSION['logged_on_user']['user'] = $_POST['login'];
                        return ('logged');
                    }else{
                        // session_destroy();
                        return ('');
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
            if ($reslt == 'logged'){
                turn ('logged');
            }else{
                return ('fail to login');
            }
        }
}