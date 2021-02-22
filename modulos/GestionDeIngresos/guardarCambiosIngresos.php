<?php

#Salir si alguno de los datos no está presente
if(!isset($_POST["fecha"]) || 
   !isset($_POST["producto"]) || 
   !isset($_POST["monto"]) || 
   !isset($_POST["id"]) || 
   !isset($_POST["proveedor"]))
    exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$id = $_POST["id"];
$fecha = $_POST["fecha"];
$producto = $_POST["producto"];
$monto = $_POST["monto"];
$proveedor = $_POST["proveedor"];

$sentencia = $base_de_datos->prepare("UPDATE ingresos SET producto = ?, proveedor = ?, monto = ?, fecha = ? WHERE id = ?;");
$resultado = $sentencia->execute([$producto,$proveedor, $monto, $fecha, $id]);

if($resultado === TRUE){
	header("Location: ./index.php?p=ingresos");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>