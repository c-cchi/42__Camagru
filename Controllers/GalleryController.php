<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $this->renderView();
        }
    }
