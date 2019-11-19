<?php
session_start();

if($_SESSION['submit'] == 'sign_new'){
    require('');
}else if ($_POST['submit'] == "Login"){
    $logcheck = new LoginController;
    $reslt = $logcheck->invoke();
    require('Views/index.php');
}else{
    require('Views/login.php');
}