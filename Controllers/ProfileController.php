<?php
    class ProfileController extends Controller{
        public $pic_pro;
        protected $email;
        protected $username;
        protected $nonhspwd;
        protected $confirmed;

        function process($parsedUrl){
            $login = new LoginController;
            $login->process($params);
            if (isset($_SESSION['user'])){
                $this->getData();
                if ($parsedUrl[1] == 'modify'){
                    $this->view = 'modify';
                    $this->renderView();
                    if (isset($_POST['uid']) && isset($_POST['email']) && isset($_POST['oldpwd']) && isset($_POST['pwd']) && isset($_POST['pwdrepeat'])){
                        $rslt = $this->modifyInfo();
                    }
                }else{
                    $this->view = 'profile';
                    $this->renderView();
                }
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
            $this->username = $_POST['uid'];
            $this->oldpwd = $_POST['oldpwd'];
            $this->nonhspwd = $_POST['pwd'];
            $usermodel = new UserModel;
            $rsltusermodel = $usermodel->checkUidmail();
            $pwdstrength = $this->checkPwdstrength($this->nonhspwd);

            if ($this->nonhspwd != $_POST['pwdrepeat']){
                header("Location: /profile/modify?error=pwdrpt"); 
            }else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                header("Location: /profile/modify?error=invalidemail"); 
            }else if($pwdstrength == FALSE){
                header("Location: /profile/modify?error=invalidpwd");
            }else if ($rsltusermodel != 'valid'){
                if ($rsltusermodel == 'username exist'){
                    header("Location: /profile/modify?error=usrnmexist");
                }else{
                    header("Location: /profile/modify?error=usrnmexist");
                }
            }else{
                $sql = "SELECT `password` FROM `users` WHERE `no`= :no";
                $arr = array('no' => $_SESSION['no']);
                $sqlidata = Connection::getInstance()->runQuery($sql, $arr);
                if ((password_verify($this->oldpwd, $sqlidata[0]['password'])) == TRUE){
                    $prfmodel = new ProfileModel;
                    $prfmodel->updateProfile();
                    $this->redirect('index');
                }else{
                    header("Location: /profile/modify?error=incorrectoldpw"); 
                }
            }
        }

        public function myGallery(){
            
        }
    }