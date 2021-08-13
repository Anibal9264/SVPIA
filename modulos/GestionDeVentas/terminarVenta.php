<?php
$total = $_POST["total"];
$num = $_POST["num"];

if (!$_SESSION) {
    session_start();
}
$cliente = (int)$_SESSION["carritos"][$num][0]["idCliente"]?:false;
$tipoPago = (int)$_SESSION["carritos"][$num][0]["tipoPago"];
$tClientes = (int)$_SESSION["carritos"][$num][0]["tClientes"];

if($total == "0"){
header("Location: ./index.php");
exit;
}
include_once "base_de_datos.php";

date_default_timezone_set('America/Costa_Rica');
$ahora = date("Y-m-d H:i:s");
if(!$cliente){
$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total,cantidadPersonas,tipoPago) "
        . "VALUES ('$ahora','$total','$tClientes','$tipoPago');");
}else{
$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total,cliente,cantidadPersonas,tipoPago) "
        . "VALUES ('$ahora','$total','$cliente','$tClientes','$tipoPago');");
}
$sentencia->execute();

$sentencia1 = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia1->execute();
$resultado = $sentencia1->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

for ($i = 1; $i < count($_SESSION["carritos"][$num]); $i++) {
    $producto = $_SESSION["carritos"][$num][$i]["producto"];
    $cantidad = $_SESSION["carritos"][$num][$i]["cantidad"];
    $sentencia2 = $base_de_datos->prepare("INSERT INTO productos_vendidos(producto, factura, cantidad) "
            . "VALUES ('$producto->id','$idVenta','$cantidad');");
    $sentencia2->execute();
}
$sentencia3 = $base_de_datos->prepare("DELETE from ventas WHERE id not in (SELECT factura FROM productos_vendidos);");
$sentencia3->execute();
array_splice($_SESSION["carritos"],$num, 1);
header("Location: ./index.php?factura=$resultado->id");


