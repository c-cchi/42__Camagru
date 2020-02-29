<?php
    class IndexController extends Controller{
        function process($params){
            $this->head = array(
                'title' => 'Camagru');
            $gallery = new GalleryController;
            $gallery->process($params);
        }
    }