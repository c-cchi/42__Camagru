<?php
$folder = "/uploads/images/";
$destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder;
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$file = $request->data;
$img = str_replace('data:image/png;base64,', '', $file);
$img = str_replace(' ', '+', $img);
$img = base64_decode($img);
$filename = date("d_m_Y_H_i_s")."-".time().".png";
$destinationPath = "$destinationFolder$img";
$success = file_put_contents($destinationPath, $img);


// $target_dir = "uploads/photo/";

// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//     echo "Sorry, only JPG, JPEG, PNG files are allowed.";
//     $uploadOk = 0;
// }

