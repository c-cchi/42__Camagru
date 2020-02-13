<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process($params);
            $galleryModel = new GalleryModel;
            if (isset($_SESSION['user'])){
                if (isset($params[1]) && $params[1] === "uploads"){
                    require_once("uploads/upload.php");
                    $filename = upload_res();
                    $galleryModel->photoTodb($filename);
                }else
                    $this->renderView();
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
