<?php
if(!isset($_REQUEST["user"])||!isset($_REQUEST["contra"])){
    exit();  
}
$user = $_REQUEST["user"];
$contra = $_REQUEST["contra"];

$sentencia = $base_de_datos->prepare("SELECT user,password from local");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);

if($local->user == $user &&  $local->password==$contra){
    session_start();
    $_SESSION['Logeado']=TRUE;
}
header ("Location: index.php");
exit;
