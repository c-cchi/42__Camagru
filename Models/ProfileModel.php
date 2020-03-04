<?php
    class ProfileModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;
        protected $notif;
        
        public function setData(){
            if (isset($_POST['uid']))
                $this->username = $_POST['uid'];
            if (isset($_POST['email']))
                $this->email = $_POST['email'];
            if (isset($_POST['pwd'])){
                $this->nonhspwd = $_POST['pwd'];
                $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
            }
            if (isset($_POST['notif'])){
                $this->notif = $_POST['notif'];
            }
        }

        public function profileInfo(){
            $sql = "SELECT * FROM `users` WHERE `no`=:no";
            $arr = array('no' => $_SESSION['no']);
            $rslt = Connection::getInstance()->runQuery($sql, $arr);
            return ($rslt[0]);
        }

        public function updateProfile(){
            $this->setData();
            $qryUpd ="UPDATE `users` SET `username` = :username, `password` = :password,`email`=:email, `notification`=:notif WHERE `no`=:no;";
            $arrUpd = array('username' => $this->username, 'password' => $this->pwd,'email' => $this->email, 'notif' => $this->notif, 'no' => $_SESSION['no']);
            $rsltUpd = Connection::getInstance()->updateQuery($qryUpd, $arrUpd);
        }

        public function updatePwd(){ // for forgetPwd
            $this->setData();
            $usrname = $_GET['uid'];
            $qryUpd ="UPDATE `users` SET `password` = :password WHERE `username`=:username OR `email`=:username;";
            $arrUpd = array('password' => $this->pwd, 'username' => $usrname);
            $rsltUpd = Connection::getInstance()->updateQuery($qryUpd, $arrUpd);
        }
}