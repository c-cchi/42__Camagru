<?php
session_start();

if($_SESSION['submit'] == 'sign_new'){
    require('');
}else if ($_POST['submit'] == "Login"){
    $logcheck = new LoginController;
    $reslt = $logcheck->invoke();
    require('Views/index.php');
}else if ($_POST['submit'] == "SignNew"){
    $newcheck = new UserController;
    $reslt = $newcheck->check_username();
    // require_once('Views/sign_new.php');
}else{
    // require('Views/login.php');
}