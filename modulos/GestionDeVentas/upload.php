<?php
include_once '../../configuracion.php';
if(!empty($_FILES['data'])){
    $data = $_FILES['data'];
    $num = $_GET['num'];
    $uploads_dir = $rootDir.'/pdfs';
   if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
    }
        $tmp_name = $data["tmp_name"];
        $name = $num.'.pdf';
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
       
} else {
    echo "No Data Sent";
}

