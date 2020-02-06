<?php
    class ProfileController extends Controller{
        public $pic_pro;
        protected $email;
        protected $username;
        protected $nonhspwd;
        protected $confirmed;

        function process($parsedUrl){
            $this->getData();
            if ($parsedUrl[1] == 'modify'){
                $this->view = 'modify';
                $this->renderView();
                if (isset($_POST['modify'])){
                    $rslt = $this->modifyInfo();
                    if ($rslt == 'pwderror'){
                        header("Location: /profile/modify?error=pwdrpt"); 
                    }
                }
            }else{
                $this->view = 'profile';
                $this->renderView();
            }
        }

        public function getData(){
            $profilemodel = new ProfileModel;
            $this->pic_pro = $profilemodel->profileImg();
            $arr = $profilemodel->profileInfo();
            if (isset($arr)){
                $this->email = $arr['email'];
                if ($arr['confirmed'] == 0){
                    $this->confirmed = 'No';
                }else{
                    $this->confirmed = 'Yes';
                }
            }
        }

        public function modifyInfo(){
            $this->email = $_POST['email'];
            $this->username = $_POST['username'];
            $this->nonhspwd = $_POST['pwd'];
            if ($this->nonhspwd != $_POST['pwd-repeat']){
                return ('pwderror');
            }
        }
        public function myGallery(){
            
        }
    }