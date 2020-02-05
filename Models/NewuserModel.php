<?php
    class NewuserModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;
        protected $conf_id;
        protected $verify_id;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['email'];
            $this->nonhspwd = $_POST['pwd'];
            $this->conf_id = uniqid('verifyemail');
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
                    return ('usrnmexist');
                }else if (isset($sqlidataemail[0])){
                    return ('emailexist');
                }
            }else{
                return ('valid');
            }
        }
    
        public function addProfile(){
            $qryPrf = "INSERT INTO `profiles` (no_user) VALUES (:no);";
            $arrPrf = array('no' => $rslt[0]['no']);
            $rsltPrf = Connection::getInstance()->runQuery($qryPrf, $arrPrf);
        }

        // public function sendMail(){
        //     $sub = 'Mail: Activate your Account of Camagrue';
        //     $msg = "Hello ".$this->username." :,<br />
        //     To Activate your account of Camagrue<br />
        //     Click <a href='localhost:8080/activate?at_id=".$this->verify_id."'>Here</a>";
        //     $headers = 'From: admin@camagrue.42';
        //     mb_internal_encoding("UTF-8");
        //     if (!mb_send_mail($this->email, $sub, $msg, $header)){
        //         return (FALSE);
        //     }
        //     return (TRUE);
        // }

        public function addUserdata(){
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
            $this->verify_id = uniqid(rand());
            $qry = "INSERT INTO `users` (username, password, email, verify_id) VALUES (:usrname, :pwd, :mail, :verify_id);";
            $arr = array('usrname' => $this->username, 'pwd' => $this->pwd, 'mail' => $this->email, 'verify_id' => $this->verify_id);
            $addData = Connection::getInstance()->runQuery($qry, $arr);
            // $qry = "SELECT `no` FROM `users` WHERE `username`=:username";
            // $arr = array('username' => $this->username);
            // $rslt = Connection::getInstance()->runQuery($qry, $arr);
            // $_SESSION['no'] = $rslt[0]['no'];
            // if (sendMail() === FALSE){
            //     return (FALSE);
            // }
        }
    }