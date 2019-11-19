<?php
    // require_once "Models/Connection.php";
    // require_once 'Controllers/Controller.php';
    require_once 'Models/Connection.php';

    class UserController extends Controller{
        
        public function check_username(){
            $qry = "SELECT `username` FROM `users`";
            $arr = array();
            $sqlidata = Connection::getInstance()->runQuery($qry, $arr);
            print_r($sqlidata); 
            // should not insert html
        }


        public function check_password(){
            //complex password
            // should not insert html
        }

        public function check_email(){
            // email not be used
        }

        public function insert_db(){

        }

        public function send_email(){

        }
    
    }