<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
if(
	!isset($_POST["descripcion"]) || 
	!isset($_POST["img"]) || 
	!isset($_POST["id"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
include_once 'configuracion.php';
$id = $_POST["id"];
$descripcion = $_POST["descripcion"];
$img = $_POST["img"];

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

$sentencia = $base_de_datos->prepare("UPDATE categoria SET descripcion = ?, img = ? WHERE id = ?;");
$resultado = $sentencia->execute([$descripcion, $img, $id]);

if ($resultado === TRUE) {
    header("Location: ./index.php?p=productos&correcto=mod");
}else {
    header("Location: ./index.php?p=productos&correcto=error");
}
exit;

