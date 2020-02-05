<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'uploads/photo';
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'txt'];

        $all_files = count($_FILES['files']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

            $file = $path . $file_name;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
            }
        }

        if ($errors) print_r($errors);
        echo $_FILE;
    }
}
// $folder = "/uploads/photo/";
// $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . $folder;
// $postdata = file_get_contents('php://input');
// $request = json_decode($postdata);
// $file = $request->data;
// $uploadOk = 1;
// $img = str_replace('data:image/png;base64,', '', $file);
// // $img = str_replace(' ', '+', $img);
// $img = base64_decode($img);
// $filename = date("d_m_Y_H_i_s")."-".time().".png";
// $success = file_put_contents($destinationPath.$filename, $img);
// echo $success;

// $target_dir = "uploads/photo/";

// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//     echo "Sorry, only JPG, JPEG, PNG files are allowed.";
//     $uploadOk = 0;
// }

