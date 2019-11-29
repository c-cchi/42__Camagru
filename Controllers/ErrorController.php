<?php
    class ErrorController extends Controller{

        public function process($parsedURL){
            $this->view = $parsedURL;
            // $this->head
            $this->renderView();
        }
    }