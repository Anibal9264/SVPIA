<?php
if(
	!isset($_POST["nombre"]) || 
	!isset($_POST["subNombre"]) || 
	!isset($_POST["direccion"]) || 
        !isset($_POST["provincia"]) || 
        !isset($_POST["canton"]) || 
        !isset($_POST["distrito"])|| 
        !isset($_POST["telefono"])|| 
        !isset($_POST["correo"])|| 
        !isset($_POST["iva"])
) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";

$nombre = $_POST["nombre"];
$subNombre = $_POST["subNombre"];
$direccion = $_POST["direccion"];
$provincia = $_POST["provincia"];
$canton = $_POST["canton"];
$distrito = $_POST["distrito"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$iva = $_POST["iva"];

$sentencia = $base_de_datos->prepare("UPDATE local SET "
        . "nombre = ?, "
        . "subNombre = ?, "
        . "direccionExacta = ?, "
        . "provincia = ?, "
        . "canton = ?, "
        . "distrito = ?, "
        . "telefono = ?, "
        . "correo = ?, "
        . "impuesto = ? "
        . "WHERE id = 1;");
$resultado = $sentencia->execute([
    $nombre,
    $subNombre,
    $direccion,
    $provincia,
    $canton,
    $distrito,
    $telefono,
    $correo,
    $iva]);

if($resultado === TRUE){
	header("Location: ./formularioLocal.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
