<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process($params);
            $galleryModel = new GalleryModel;
                $this->renderView();
            if ($_SESSION['no']){
                if (isset($params[2]) && $params[2] === "uploads"){
                    require_once("uploads/upload.php");
                    $filename = upload_res();
                    $galleryModel->photoTodb($filename);
                }else if (isset($params[1]) && $params[1] === "take_photo"){
                    $qry = "SELECT * FROM `stickers`";
                    $arr = array();
                    $stickers = Connection::getInstance()->runQuery($qry, $arr);
                    require_once("Views/take_photo.phtml");
                }else if (isset($params[1]) && $params[1] === "my_gallery"){
                    $rsltmygallery = $galleryModel->my_gallery();
                    if(isset($rsltmygallery)){
                        for ($i = 0; $i < 6; $i++) {
                            if (isset($rsltmygallery[$i]['filename'])){
                                echo "<img class='photo' src='/uploads/photo/".$rsltmygallery[$i]['filename']."'>";
                            }
                        }
                    }
                }else if(isset($params[1]) && $params[1] === "p" && isset($_GET['id_photo'])){
                    $rsltCmmt = $galleryModel->p_cmmt();
                    $rsltLike = $galleryModel->p_gallery();
                    if (isset($_SESSION['no'])){
                        if (isset($_POST['comment'])){
                            require "uploads/uploadcomment.php";
                        }else if (isset($_POST['delete_x'])){
                            $id_cmt = $_POST['id_comment'];
                            $galleryModel->p_dlt_cmt($id_cmt);
                        }else if (isset($_POST['like_x'])){
                            $galleryModel->p_like($rsltLike);
                        }
                    }
                }
            }
            $rsltAllgallery = $galleryModel->all_gallery();
            if(isset($params[1]) && $params[1] === "p" && isset($_GET['id_photo'])){
                $rsltCmmt = $galleryModel->p_cmmt();
                $rsltLike = $galleryModel->p_gallery();
                require "Views/p.phtml";
            }else if(isset($rsltAllgallery) && !isset($params[1])){
                for ($i = 0; $i < 6; $i++) {
                    $fname = $rsltAllgallery[$i]['filename'];
                    if (isset($fname)){
                        echo "<a href='/gallery/p?pic=".$fname."&id_photo=".$rsltAllgallery[$i]['id_photo']."'>
                        <img class='photo' name='.$fname.' src='/uploads/photo/".$fname."'></a>";
                    }
                }
            }
        }

        public function personnal_gallery(){
            }
        public function one_photo(){
            }
        public function take_picture(){
            }
    }
