<?php
    $sub = 'Activate your Account of Camagrue';
    $headers = "From: chichiahan@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $msg = "Hello ".$username.":,<br />To Activate your account of Camagrue<br />Click <a href='localhost:8080/activate?activate_id=".$verify_id."'>Here</a>";