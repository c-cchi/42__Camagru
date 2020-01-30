<?php
    class ProfileController extends Controller{
        public $link_pro;
        
        function process($params){
            $this->view = 'profile';
            $this->link_pro = 'profiledefault.jpg';
            $this->renderView();
        }

        public function proImg(){
            $promodel = new ProfileModel;
            return ($promodel->profileImg());
        }

        public function myGallery(){
            
        }
    }