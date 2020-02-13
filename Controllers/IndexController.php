<?php
    class IndexController extends Controller{
        function process($params){
            $this->head = array(
                'title' => 'Camagrue');
            $gallery = new GalleryController;
            $gallery->process($params);
        }
    }