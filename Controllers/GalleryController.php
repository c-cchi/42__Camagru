<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $this->renderView();
            $login = new LoginController;
            $login->process('login');
            // if (isset($_SESSION['user'])){
            // }else{
            // }
        }
    }
