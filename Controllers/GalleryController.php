<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process($params);
            $galleryModel = new GalleryModel;
            if (isset($_SESSION['user'])){
                $this->renderView();
                if (isset($params[2]) && $params[2] === "uploads"){
                    require_once("uploads/upload.php");
                    $filename = upload_res();
                    $galleryModel->photoTodb($filename);
                }else if (isset($params[1]) && $params[1] === "take_photo"){
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
                }else{
                    $rsltAllgallery = $galleryModel->all_gallery();             
                    if(isset($rsltAllgallery)){
                        for ($i = 0; $i < 6; $i++) {
                            if (isset($rsltAllgallery[$i]['filename'])){
                                echo "<img class='photo' src='/uploads/photo/".$rsltAllgallery[$i]['filename']."'>";
                            }
                        }
                    }
                }
            }else{
                // msg Please log in or sign up, turn to login page
            }
        }

        public function personnal_gallery(){
            }
        public function one_photo(){
            }
        public function take_picture(){
            }
    }
