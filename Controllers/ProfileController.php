<?php
    class ProfileController extends Controller{
        protected $email;
        protected $username;
        protected $nonhspwd;
        protected $confirmed;
        protected $notif;
        protected $oldpwd;

        function process($parsedUrl){
            $login = new LoginController;
            $login->process($parsedUrl);
            if (isset($_SESSION['user'])){
                $this->getData();
                if (isset($parsedUrl[1]) && $parsedUrl[1] == 'modify'){
                    $this->view = 'modify';
                    $this->renderView();
                    if (isset($_POST['modify'])){
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
            $arr = $profilemodel->profileInfo();
            if (isset($arr)){
                $this->email = $arr['email'];
                if ($arr['confirmed'] == 0){
                    $this->confirmed = 'No';
                }else{
                    $this->confirmed = 'Yes';
                }
                if ($arr['notification'] == 0){
                    $this->notif = 0;
                }else{
                    $this->notif = 1;
                }

            }
        }

        public function modifyInfo(){
            $this->email = $_POST['email'];
            $this->username = $_POST['uid'];
            $this->oldpwd = $_POST['oldpwd'];
            $this->nonhspwd = $_POST['pwd'];
            $this->notif = $_POST['notif'];   
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
                    session_destroy();
                    $this->redirect('index?ok=pwdupdate');
                }else{
                    header("Location: /profile/modify?error=incorrectoldpw"); 
                }
            }
        }
    }