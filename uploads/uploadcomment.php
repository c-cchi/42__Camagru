<?php
    if (isset($_POST['uid']) && isset($_POST['comment']) && isset($_GET['id_photo'])){
        if (isset($_SESSION['no'])){
            $nousr = $_SESSION['no'];
        }else{
            $nousr = 0;
        }
        $usrname = htmlspecialchars($_POST['uid']);
        $id_photo = $_GET['id_photo'];
        $cmmt = htmlspecialchars($_POST['comment']);
        $qry = "INSERT INTO `comment` (no_user, username, id_photo, comment) VALUES (:nousr, :username,:idphoto, :cmmt);";
        $arr = array('nousr' => $nousr, 'username' => $usrname, 'idphoto' => $id_photo, 'cmmt' => $cmmt);
        Connection::getInstance()->insertQuery($qry, $arr);
    }