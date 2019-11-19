<?php
    opcache_reset(); 

    ob_start();
    session_start();
    require_once 'Models/Connection.php';

    function autoloadFunction($class){
        if (preg_match('/Controller$/', $class))
            require("Controllers/" . $class . ".php");
        else
            require("Models/" . $class . ".php");
    }

    spl_autoload_register("autoloadFunction");
    require ('Router.php');

    $title = "Camagrue";
    $content = ob_get_clean();

    require('template.php');