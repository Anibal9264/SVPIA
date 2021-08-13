<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM ingresos WHERE id = '$id';");
$resultado = $sentencia->execute();
if($resultado === TRUE){
	header("Location: ./index.php?p=ingresos&correcto=del");
	exit;
}
else echo "Algo salió mal";
?>