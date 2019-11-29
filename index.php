<?php
    ob_start();
    function autoloadFunction($class){
        if (preg_match('/Controller$/', $class))
            require("Controllers/" . $class . ".php");
        else
            require("Models/" . $class . ".php");
    }

    spl_autoload_register("autoloadFunction");
    $router = new RouterController();
    $router->process(array($_SERVER['REQUEST_URI']));
    // $router->renderView();

    $title = "Camagrue";
    $content = ob_get_clean();
    require('template.phtml');
    ob_flush();
    flush();
