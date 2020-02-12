<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process();
            if (isset($_SESSION['user'])){
                if ($params[1] == "uploads"){
                    $folder = "/uploads/photo/";
                    $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder;
                    $postdata = $_POST['canvas'];
                    // $postdata = file_get_contents('php://input');
                    $request = json_decode($postdata);
                    $file = $request->data;
                    $uploadOk = 1;
                    $img = str_replace('data:image/png;base64,', '', $file);
                    $img = str_replace(' ', '+', $img);
                    $img = base64_decode($img);
                    $file = $folder . date("d_m_Y_H_i_s")."-".time().".png";
                    $success = file_put_contents($file, $img);
                    echo $success;
                }
                else
                    $this->renderView();
            }else{
                // msg Please log in or sign up, turn to login page
            }
        }
        public function personnal_gallery(){
            }
        public function one_photo(){
            }
        public function take_picture(){
            }
    }
