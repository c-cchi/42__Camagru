<?php
    $cmter = $_SESSION['user'];
    $sub = 'Notification From Camagru';
    $headers = "From: chichiahan@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $msg = "Hello ".$username.":,<br />";
    $msg .= "Welcome to Camagru";
    $msg .= "You get a comment from ".$cmter."<br/>";