<?php
    class LoginController extends Controller{

    public function process($login){
        $this->view = 'Login';
        if(isset($_POST['login'])){
            $msg = $this->invoke();
            if (isset($_SESSION['user'])){
                $this->redirect('gallery');
            }else{
                echo "<h4>error of login</h4>";
            }
        }else if(isset($_POST['submit']) && $_POST['submit'] == "Logout"){
            session_destroy();
            $this->redirect('index');
        }
        if(isset($_SESSION['user'])){
            include "views/Logout.phtml";
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
        if (isset($_POST['login']) && isset($_POST['passwd'])){
            if (!$sqlidata){
                session_destroy();
                return ('usrnonexist');
            }else{
                if ($this->check_user($sqlidata) == TRUE){
                    $_SESSION['user'] = $sqlidata[0]['username'];
                    $_SESSION['no'] = $sqlidata[0]['no'];
                    return (TRUE);
                }else{
                    session_destroy();
                    return (FALSE);
                }
            }
        }
    }

    public function invoke(){
        $qry = "SELECT `username`,`password`,`no`,`email` FROM `users` WHERE `username`= :username OR `email`= :username";
        $username = $_POST['login'];
        $arr = array('username' => $username);
        $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
        return ($this->getlogin($sqlidata));
    }
}