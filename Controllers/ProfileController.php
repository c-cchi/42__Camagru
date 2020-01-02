<?php
    class ProfileController extends Controller{
        function process($params){
            $this->view = 'profile';
            $this->renderView();
        }

        public function proImg(){        
            $promodel = new ProfileModel;
            
        }
    }