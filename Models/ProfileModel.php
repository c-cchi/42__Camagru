<?php
    class ProfileModel{
        protected $username;
        protected $email;
        protected $pwd;
        protected $nonhspwd;
        
        public function setData(){
            $this->username = $_POST['uid'];
            $this->email = $_POST['email'];
            $this->nonhspwd = $_POST['pwd'];
            $this->pwd = password_hash($this->nonhspwd, PASSWORD_DEFAULT);
        }

        public function profileImg(){
            $sql = "SELECT * FROM `profiles` WHERE `no_user`=:no";
            $arr = array('no' => $_SESSION['no']);
            $rslt = Connection::getInstance()->runQuery($sql, $arr);
            if (!empty($rslt)) {
                if ($rslt[0]['status'] == TRUE){ // already upload img
                    return ($rslt[0]['src']); //.'?'.mt_rand() ?? mt rand給予一個random數字，這樣在更新圖片的時候browser才不會記住之前的那張照片而沒有更換
                }else{
                    return ('profiledefault.jpg');
                }
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
            $qryUpd ="UPDATE `users` SET `username` = :username, `password` = :password,`email`=:email WHERE `no`=:no;";
            $arrUpd = array('username' => $this->username, 'password' => $this->pwd,'email' => $this->email, 'no' => $_SESSION['no']);
            $rsltUpd = Connection::getInstance()->updateQuery($qryUpd, $arrUpd);
        }
}