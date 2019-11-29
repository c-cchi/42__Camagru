<?php
    class NewuserModel{
        protected $username;
        protected $email;
        protected $pwd;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['mail'];
            $this->pwd = $_POST['pwd'];
        }
        public function checkUidmail(){
            $qry = "SELECT * FROM `users` WHERE `username`=:username";
            $qry2 = "SELECT * FROM `users` WHERE `email`=:email";
            $arr = array('username' => $this->username);
            $arr2 = array('email' => $this->email);
            
            $sqlidatauid = Connection::getInstance()->runQuery($qry, $arr);
            $sqlidataemail = Connection::getInstance()->runQuery($qry2, $arr2);
            if (isset($sqlidatauid[0]) || isset($sqlidataemail[0])){
                if (isset($sqlidatauid[0])){
                    echo "<div class=\"alert-box\">Username exist.</div>";
                }else{
                    echo "<div class=\"alert-box\">E-mail exist.</div>";
                }
                return (FALSE);
            }
            // else{
            //     $rslt = $this->addUserdata();
            //     if ($rslt == "TRUE"){
            //         echo "Sign Up successfully.";
            //     }else{
            //         echo "Fail to Sign Up.";
            //     }
            // }
        }
    
        public function addUserdata(){
            
            if ($this->checkUidmail() == false){
                return (FALSE);
            }else{
                echo "insert sql";
            }
            return (TRUE);
        }
    }