<?php
    class ProfileController extends Controller{
        function process($params){
            $this->view = 'profile';
            $this->renderView();
        }

        public function proImg(){
            session_start();
        
            $promodel = new ProfileModel;
            
        }
    }