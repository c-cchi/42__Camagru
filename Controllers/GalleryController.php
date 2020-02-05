<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process();
            if (isset($_SESSION['user'])){
                $this->renderView();
                if ($params[1] == "uploads"){
                    require "/uploads/upload.php";
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
