<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["fecha"]) || 
   !isset($_POST["producto"]) || 
   !isset($_POST["monto"]) || 
   !isset($_POST["proveedor"]))
    exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$fecha = $_POST["fecha"];
$producto = $_POST["producto"];
$monto = $_POST["monto"];
$proveedor = $_POST["proveedor"];


$sentencia = $base_de_datos->prepare("INSERT INTO ingresos(proveedor, producto, monto, fecha) VALUES (?, ?, ?, ?);");
$resultado = $sentencia->execute([$proveedor, $producto, $monto,$fecha]);

if($resultado === TRUE){
	header("Location: ./ingresos.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";

