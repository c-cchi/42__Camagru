<?php
    class GalleryController extends Controller{
        
        public function process($params){
            $this->view = 'gallery';
            $login = new LoginController;
            $login->process($params);
            $galleryModel = new GalleryModel;
            $this->renderView();
            if (isset($_SESSION['no'])){
                if (isset($params[2]) && $params[2] === "uploads"){
                    require_once("uploads/upload.php");
                    $filename = upload_res();
                    $galleryModel->photoTodb($filename);
                }else if (isset($params[1]) && $params[1] === "take_photo"){
                    $qry = "SELECT * FROM `stickers`";
                    $arr = array();
                    $stickers = Connection::getInstance()->runQuery($qry, $arr);
                    require_once("Views/take_photo.phtml");
                }else if (isset($params[1]) && $params[1] === "my_gallery"){
                    if (isset($_POST['id_photo'])){
                        $galleryModel->dlt_photo();
                    }
                    $rsltmygallery = $galleryModel->my_gallery();
                    if(isset($rsltmygallery)){
                        require "Views/my_gallery.phtml";
                    }
                }else if(isset($params[1]) && $params[1] === "p" && isset($_GET['id_photo'])){
                    $rsltCmmt = $galleryModel->p_cmmt();
                    $rsltLike = $galleryModel->p_gallery();
                        if (isset($_POST['comment'])){
                            require "uploads/uploadcomment.php";
                            $rslt = $galleryModel->user_email($_GET['id_photo']);
                            $noti_mail = 'mail/noti_comment.php';
                            $this->sendMail($rslt[0]['username'],$rslt[0]['email'], $noti_mail, null);
                        }else if (isset($_POST['delete_x'])){
                            $id_cmt = $_POST['id_comment'];
                            $galleryModel->p_dlt_cmt($id_cmt);
                        }else if (isset($_POST['like_x'])){
                            $like = $galleryModel->p_like($rsltLike);
                            if ($like){
                                $rslt = $galleryModel->user_email($_GET['id_photo']);
                                $liker = $_SESSION['user'];
                                $noti_mail = 'mail/noti_mail.php';
                                $this->sendMail($rslt[0]['username'],$rslt[0]['email'], $noti_mail, null);
                            }
                        }
                }
            }
            $rsltAllgallery = $galleryModel->all_gallery();
            if(isset($params[1]) && $params[1] === "p" && isset($_GET['id_photo'])){
                $rsltCmmt = $galleryModel->p_cmmt();
                $rsltLike = $galleryModel->p_gallery();
                require "Views/p.phtml";
            }else if(isset($rsltAllgallery) && !isset($params[1])){
                require "Views/all_gallery.phtml";
            }
        }
    }
