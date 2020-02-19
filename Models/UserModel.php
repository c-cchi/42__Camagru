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
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
        }

        public function checkUidmail(){
            $qry = "SELECT * FROM `users` WHERE `username`=:username OR `email`=:email;";
            $arr = array('username' => $this->username, 'email' => $this->email);
            $sqlidata= Connection::getInstance()->runQuery($qry, $arr);
            if (isset($sqlidata[0])){
                if (isset($_SESSION['no']) && ($sqlidata[0]['no'] === $_SESSION['no'])){ //for ProfileController
                    return ('valid');
                }else if ($sqlidata[0]['username'] === $this->username){ //for NewuserController and resetPassword
                    return ('username exist');
                }else if ($sqlidata[0]['email'] === $this->email){
                    return ('email exist');
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

        public function send_v_mail($username, $verify_id){
            require_once "mail/activate_mail.php";
            $rslt = mb_send_mail($this->email, $sub, $msg, $headers);
            return ($rslt);
        }

        public function addUserdata(){
            $this->verify_id = uniqid(rand());
            $qry = "INSERT INTO `users` (username, password, email, verify_id) VALUES (:usrname, :pwd, :mail, :verify_id);";
            $arr = array('usrname' => $this->username, 'pwd' => $this->pwd, 'mail' => $this->email, 'verify_id' => $this->verify_id);
            $addData = Connection::getInstance()->insertQuery($qry, $arr);
            $qry1 = "SELECT `no`,`username`,`verify_id` FROM `users` WHERE `username`=:username";
            $arr1 = array('username' => $this->username);
            $rslt = Connection::getInstance()->runQuery($qry1, $arr1);
            $_SESSION['no'] = $rslt[0]['no'];
            $_SESSION['user'] = $rslt[0]['username'];
            $_SESSION['email'] = $rslt[0]['email'];
            $this->addProfile();
            if ($this->send_v_mail($_SESSION['user'], $rslt[0]['verify_id']) == FALSE){
                return (FALSE);
            }
        }
    }