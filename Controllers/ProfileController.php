<?php
    class ProfileController extends Controller{

        function process($params){
            $this->view = 'profile';
            $link_pro = $this->proImg();
            $this->renderView();
        }

        public function proImg(){   //to call the profile image  
            $promodel = new ProfileModel;
            return ($promodel->profileImg());
        }

        public function myGallery(){
            
        }
    }