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
        $qry = "SELECT filename FROM photos ORDER BY rand() LIMIT 6";
        $arr = array();
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }
    
    public function my_gallery(){
        $qry = "SELECT filename FROM photos WHERE `no_user` = :nousr ORDER BY `id_photo` DESC";
        $arr = array('nousr' => $this->no_user);
        $rslt = Connection::getInstance()->runQuery($qry, $arr);
        return ($rslt);
    }

    public function one_pic(){}
    
}