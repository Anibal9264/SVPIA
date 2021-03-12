<?php
include_once '../../configuracion.php';

if(!empty($_GET["A"])){
    $filePath = $_GET["A"];
    $fileName = basename($filePath);
    $dir = $rootDir."/".$filePath;
    if(!empty($fileName) && file_exists($dir)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($dir);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}

