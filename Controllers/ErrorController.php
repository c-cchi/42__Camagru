<?php
    class ErrorController extends Controller{

        public function process($parsedURL){
            $this->view = 'error';
            // $this->head
            $this->renderView();
        }
    }