<?php
    class NewuserModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;
        protected $conf_id;

        public function __construct(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['email'];
            $this->nonhspwd = $_POST['pwd'];
            $this->conf_id = 
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
    
        // public function addProfile(){
        //     $qry = "SELECT `no` FROM `users` WHERE `username`=:username";
        //     $arr = array('username' => $this->username);
        //     $rslt = Connection::getInstance()->runQuery($qry, $arr);
        //     $qryPrf = "INSERT INTO `profile` (`no`, `username`, `statusimg`) VALUES (:no, :uname);";
        //     $arrPrf = array('no' => $rslt['no'], 'username' => $this->username);
        //     $rsltPrf = Connection::getInstance()->runQuery($qryPrf, $arrPrf);
        //     echo $rsltPrf;
        // }

        public function addUserdata(){
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
            $qry = "INSERT INTO `users` (username, password, email, con_id) VALUES (:usrname, :pwd, :mail, :conf_id);";
            $arr = array('usrname' => $this->username, 'pwd' => $this->pwd, 'mail' => $this->email, 'conf_id' => $this->conf_id);
            $addData = Connection::getInstance()->runQuery($qry, $arr);
            // $this->addProfile();
        }
    }