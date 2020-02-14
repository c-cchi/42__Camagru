<?php
    $sub = 'Reset your Password of Camagrue';
    $headers = "From: chichiahan@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $msg = "Hello ".$username.":,<br />";
    $msg .= "To Reset your account,<br />";
    $msg .= "Click <a href=". $url ." input type='button'>Here</a>";
