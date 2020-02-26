<?php
class GalleryModel{

    protected $no_user;

    public function __construct(){
        if (isset($_SESSION['no'])){
            $this->no_user = $_SESSION['no'];
        }
    }

    public function photoTodb($filename){
        $qry = "INSERT INTO `photos` (no_user, filename) VALUES (:nousr, :filnm);";
        $arr = array('nousr' => $this->no_user, 'filnm' => $filename);
        $addData = Connection::getInstance()->insertQuery($qry, $arr);
    }

    public function all_gallery(){
        $qry = "SELECT filename, id_photo FROM photos ORDER BY `id_photo` DESC";
        $arr = array();
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }
    
    public function my_gallery(){
        $qry = "SELECT * FROM photos WHERE `no_user` = :nousr ORDER BY `id_photo` DESC";
        $arr = array('nousr' => $this->no_user);
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }

    public function p_gallery(){
        $qry = "SELECT * FROM `like_photo` WHERE `no_user`= :nousr AND `id_photo`= :idphoto";
        $arr = array('nousr' => $this->no_user, 'idphoto' => $_GET['id_photo']);
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }

    public function p_like($rsltLike){
            if (isset($rsltLike[0])){
                $qry = "DELETE FROM `like_photo` WHERE `id_photo`=:idphoto AND `no_user`=:nouser;";
                $like = false;
            }else{
                $qry = "INSERT INTO `like_photo` (id_photo, no_user) VALUES (:idphoto, :nouser);";
                $like = true;
            }
            $arr = array('idphoto' => $_GET['id_photo'], 'nouser' => $_SESSION['no']);
            Connection::getInstance()->insertQuery($qry, $arr);
            return ($like);
    }

    public function p_cmmt(){
            $qry = "SELECT * FROM `comment` WHERE `id_photo` = :idphoto;";
            $arr = array('idphoto' => $_GET['id_photo']);
            $rslt = Connection::getInstance()->runQuery($qry, $arr);
            return ($rslt);
    }

    public function p_dlt_cmt($id_cmt){
        $qry = "DELETE FROM `comment` WHERE `id_comment` = :idcmt;";
        $arr = array('idcmt' => $id_cmt);
        Connection::getInstance()->insertQuery($qry, $arr);
    }

    public function dlt_photo(){
        $qry = "SELECT `filename` FROM `photos` WHERE `id_photo` = :idphoto;";
        $arr = array('idphoto' => $_POST['id_photo']);
        $filename = Connection::getInstance()->runQuery($qry, $arr);
        if (unlink("uploads/photo/".$filename[0]['filename']."")){
            $qry = "DELETE FROM `photos` WHERE `id_photo` = :idcmt;";
            $arr = array('idcmt' => $_POST['id_photo']);
            Connection::getInstance()->insertQuery($qry, $arr);
            $qry = "DELETE FROM `comment` WHERE `id_photo` = :idcmt;";
            Connection::getInstance()->insertQuery($qry, $arr);
            $qry = "DELETE FROM `like_photo` WHERE `id_photo` = :idcmt;";
            Connection::getInstance()->insertQuery($qry, $arr);
        }
    }

    public function user_email($id_photo){
        $qry = "SELECT `no_user` FROM `photos` WHERE `id_photo` = :idphoto;";
        $arr = array('idphoto' => $id_photo);
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        $qry = "SELECT `email`,`username` FROM `users` WHERE `no` = :nouser;";
        $arr = array('nouser' => $rslt[0]['no_user']);
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }
}