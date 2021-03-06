<?php
    class UserModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;
        protected $verify_id;

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
            $arrPrf = array('no' => $_SESSION['no']);
            $rsltPrf = Connection::getInstance()->insertQuery($qryPrf, $arrPrf);
        }

        public function addUserdata(){
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
            $this->verify_id = uniqid(rand());
            $qry = "INSERT INTO `users` (username, password, email, verify_id) VALUES (:usrname, :pwd, :mail, :verify_id);";
            $arr = array('usrname' => $this->username, 'pwd' => $this->pwd, 'mail' => $this->email, 'verify_id' => $this->verify_id);
            $addData = Connection::getInstance()->insertQuery($qry, $arr);
            $qry1 = "SELECT * FROM `users` WHERE `username`=:username";
            $arr1 = array('username' => $this->username);
            $rslt = Connection::getInstance()->runQuery($qry1, $arr1);
            $_SESSION['no'] = $rslt[0]['no'];
            $_SESSION['user'] = $rslt[0]['username'];
            $_SESSION['email'] = $rslt[0]['email'];
            $_SESSION['confirmed'] = $rslt[0]['confirmed'];
            $this->addProfile();
            // return (TRUE);
            // if (sendMail() === FALSE){
            //     return (FALSE);
            // }
        }
    }