<?php
    class ErrorController extends Controller{
        public function process(){
            $this->view = 'error';
            $this->renderView();
        }
    }