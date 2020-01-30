<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process();
            if (isset($_SESSION['user'])){
                $this->renderView();
            }
        }
    }
