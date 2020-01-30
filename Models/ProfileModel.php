<?php
    class ProfilerModel{

        public function profileImg(){
            $sql = "SELECT * FROM `profiles` WHERE `no_user`=:no";
            $arr = array('no' => $_SESSION['no']);
            $rslt = Connection::getInstance()->runQuery($sql, $arr);
            if (!empty($rslt)) {
                $no = $_SESSION['no'];
                $qry = "SELECT * FROM `profile` WHERE no_user =:no";
                $arr = array('no' => $no);
                $rsltProfile = Connection::getInstance()->runQuery($qry, $arr);
            //     if ($rsltProfile){
            //         if ($rsltProfile['status'] == TRUE){ // already upload img
            //             return ('profile'.$id.'.jpg?'.mt_rand()); //mt rand給予一個random數字，這樣在更新圖片的時候browser才不會記住之前的那張照片而沒有更換
            //         }else{
            //             return ('profiledefault.jpg');
            //         }
            //     }
            // }else{
                return ('profiledefault.jpg');
            // }
        }
        return ('profiledefault.jpg');
    }
}