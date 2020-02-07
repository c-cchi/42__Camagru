<?php
    class LoginController extends Controller{

    public function process($login){
        $this->view = 'Login';
        if(isset($_POST['login'])){
            $msg = $this->invoke();
            if (isset($_SESSION['user'])){
                $this->redirect('gallery');
            }else{
                echo "<h4>".$msg."</h4>";
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
        if (password_verify($_POST['passwd'], $arr['password']) == TRUE){
            return (TRUE);
        }else{
            return (FALSE);
        }
    }

    public function getlogin($sqlidata){
        if (isset($_POST['login']) && isset($_POST['passwd'])){
            if (!isset($sqlidata)){
                session_destroy();
                return ('usrnonexist');
            }else{
                $rslt = $this->check_user($sqlidata[0]);
                if ($rslt == TRUE){
                    $_SESSION['user'] = $sqlidata[0]['username'];
                    $_SESSION['no'] = $sqlidata[0]['no'];
                    return (TRUE);
                }else{
                    session_destroy();
                    return ('incorrect password');
                }
            }
        }
    }

    public function invoke(){
        $qry = "SELECT `username`,`password`,`no`,`email` FROM `users` WHERE `username`= :username OR `email`= :username";
        $username = $_POST['login'];
        $arr = array('username' => $username);
        $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
        $rslt = $this->getlogin($sqlidata);
        return ($rslt);
    }
}