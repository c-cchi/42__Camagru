<?php
    class ProfilerModel{

        public function proImg(){
            $sql = "SELECT `status` FROM `profile` WHERE `username`=:username";
            $arr = array('username' => $_SESSION['user']);
            $rslt = Connection::getInstance()->runQuery($sql, $arr);
            if ($rslt->rowCount() > 0){
                while ($row = mysqli_fetch_assoc($rslt)){
                    $id = $_SESSION['no'];
                    $sqlImg = "SELECT * FROM `profile` WHERE userid ='$id'";
                    $rsltImg = mysqli_query($conn, $sqlImg);
                    if ($rowImg = mysqli_fetch_assoc($rsltImg)){
                        echo "<div>";
                        if ($rowImag['status'] == TRUE){ // already upload img
                            echo "<img src='uploads/profile".$id.".jpg?".mt_rand().">"; //mt rand給予一個random數字，這樣在更新圖片的時候browser才不會記住之前的那張照片而沒有更換
                        }
                    }else{
                        echo "<img src='uploads/profiledefault.jpg'>";
                    }
                    echo "</div>";
                }
            }
        }
    }