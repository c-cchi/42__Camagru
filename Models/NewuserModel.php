<?php
    class NewuserModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['email'];
            $this->nonhspwd = $_POST['pwd'];
        }
        public function checkUidmail(){
            $qry = "SELECT * FROM `users` WHERE `username`=:username";
            $qry2 = "SELECT * FROM `users` WHERE `email`=:email";
            $arr = array('username' => $this->username);
            $arr2 = array('email' => $this->email);
            
            $sqlidatauid = Connection::getInstance()->runQuery($qry, $arr);
            $sqlidataemail = Connection::getInstance()->runQuery($qry2, $arr2);
            if (isset($sqlidataemail[0]) || isset($sqlidatauid[0])){
                if (isset($sqlidatauid[0])){
                    echo "<div class=\"alert-box\">Username exist.</div>";
                }
                if (isset($sqlidataemail[0])){
                    echo "<div class=\"alert-box\">E-mail exist.</div>";
                }
                return (FALSE);
            }
            else{
                $rslt = $this->addUserdata();
                if ($rslt == "TRUE"){
                    echo "Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.";
                }else{
                    echo "<div class=\"alert-box\">Fail to Sign Up.</div>";
                }
            }
        }
    
        public function addUserdata(){
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
            $qry = "INSERT INTO `users` (username, password, email) VALUES (:usrname, :pwd, :mail);";
            $arr = array('usrname' => $this->username, 'pwd' => $this->pwd, 'mail' => $this->email);
            $addData = Connection::getInstance()->runQuery($qry, $arr);
            return (TRUE);
        }
    }