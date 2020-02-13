<?php
class GalleryModel{

    protected $no_user;

    public function __construct(){
        $this->no_user = $_SESSION['no'];
    }

    public function photoTodb($filename){
        $qry = "INSERT INTO `photos` (no_user, filename) VALUES (:nousr, :filnm);";
        $arr = array('nousr' => $this->no_user, 'filnm' => $filename);
        $addData = Connection::getInstance()->insertQuery($qry, $arr);
    }
}