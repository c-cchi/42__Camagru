<?php

function upload_res(){
    try{
        $folder = "/uploads/photo/";
        $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder;
        
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata);
        $file = $request->data;
        $uploadOk = 1;
        $img = str_replace('data:image/png;base64,', '', $file);
        $img = str_replace(' ', '+', $img);
        $img = base64_decode($img);
        $file = $_SESSION['no']."-".date("d_m_Y_H_i_s")."-".time().".png";
        $success = file_put_contents("$destinationFolder$file", $img);
        return ($file);
    }catch(Exception $ex){
        echo $ex;
    }
}
