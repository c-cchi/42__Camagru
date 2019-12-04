<?php
    class ProfileController extends Controller{
        function porcess($params){
            $this->view = 'profile';
            $this->renderView();
        }

        public function proImg(){
            session_start();
            $conn = Connection::getInstance();
        
            $sql = "SELECT * FROM users";
            $rslt = mysqli_query($conn, $sql);
            if (my_sqli_num_rows($rslt) > 0){
                while ($row = mysqli_fetch_assoc($rslt)){
                    $id = $row['id'];
                    $sqlImg = "SELECT * FROM profileimg WHERE userid ='$id'";
                    $rsltImg = mysqli_query($conn, $sqlImg);
                    while($rowImg = mysqli_fetch_assoc($rsltImg)){
                        echo "<div>";
                        if ($rowImag['status'] == 0){ // already upload img
                            echo "<img src='uploads/profile".$id.".jpg?".mt_rand().">"; //mt rand給予一個random數字，這樣在更新圖片的時候browser才不會記住之前的那張照片而沒有更換
                        }else{
                            echo "<img src='uploads/profiledefault.jpg'>";
                        }
                        echo "</div>";
                    }
                }
            }
        }
    }