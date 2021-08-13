<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
#Salir si alguno de los datos no está presente
if(!isset($_POST["descripcion"]))exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$descripcion = $_POST["descripcion"];

$img = "";

include_once 'configuracion.php';

 $uploads_dir = $rootDir.'/imgCat';
   if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
    }
 if ($_FILES["archivo"]) {
        $rand = date("Y-m-d H-i-s");
        $tmp_name = $_FILES["archivo"]["tmp_name"];
        $path = $_FILES['archivo']['name'];
        $ext = ".".pathinfo($path, PATHINFO_EXTENSION);
        $name = $rand.basename($ext);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $img = "imgCat/$name";
    }

$sentencia = $base_de_datos->prepare("INSERT INTO categoria(descripcion, img) "
        . "VALUES ('$descripcion', '$img');");
$resultado = $sentencia->execute();

if ($resultado === TRUE) {
    header("Location: ./index.php?p=productos&correcto=new");
} else {
    header("Location: ./index.php?p=productos&correcto=error");
}
exit;


