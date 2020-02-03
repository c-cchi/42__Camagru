<?php
    class ProfileController extends Controller{
        public $link_pro;
        function process($params){
            $this->view = 'profile';
            $profilemodel = new ProfileModel;
            $this->link_pro = $profilemodel->profileImg();
            $this->renderView();
        }

        public function myGallery(){
            
        }
    }