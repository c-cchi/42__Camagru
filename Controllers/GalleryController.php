<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $this->renderView();
            // if (isset($_SESSION['logged_on_user']['user'])){
            //     $this->renderView();
            // }else{
            //     $this->redirect('login');
            // }
        }
    }
