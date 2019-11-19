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
    require ('Views/login.php');

    $title = "Camagrue";
    $content = ob_get_clean();

    require('template.php');


    // require('controler/frontend.php');

    // try {
    //     if (isset($_GET['action'])) {
    //         if ($_GET['action'] == 'accueil') {
    //             accueil();
    //         }

    //         elseif ($_GET['action'] == 'laFerme') {
    //             laFerme();
    //         }

    //         elseif ($_GET['action'] == 'brebisVaches') {
    //             brebisVaches($_GET['anchor']);
    //         }

    //         elseif ($_GET['action'] == 'porcs') {
    //             porcs();
    //         }
            
    //     }
    //     else {
    //         accueil();
    //     }
    // }
    // catch(Exception $e) {
    //     echo 'Erreur : ' . $e->getMessage();
    // }