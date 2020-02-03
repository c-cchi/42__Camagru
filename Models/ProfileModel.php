<?php
    class ProfileModel{

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
}