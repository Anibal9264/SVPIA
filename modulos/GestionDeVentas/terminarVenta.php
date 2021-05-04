<?php
$total = $_POST["total"];
$num = $_POST["num"];
$cliente = $_POST["cliente"];
$idcliente = $_POST["idcliente"];
$tipoPago = $_POST["tipoPago"];
$tClientes = (int)$_POST["tClientes"];
if($total == "0"){
header("Location: ./index.php");
exit;
}
include_once "base_de_datos.php";

date_default_timezone_set('America/Costa_Rica');
$ahora = date("Y-m-d H:i:s");
if($tipoPago != '4'){
$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total,cliente,cantidadPersonas,tipoPago) VALUES (?, ?, ?, ?, ?);");
$sentencia->execute([$ahora, $total,$cliente,$tClientes,$tipoPago]);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(producto, factura, cantidad) VALUES (?, ?, ?);");

for ($i = 1; $i < count($_SESSION["carritos"][$num]); $i++) {
    $producto = $_SESSION["carritos"][$num][$i]["producto"];
    $cantidad = $_SESSION["carritos"][$num][$i]["cantidad"];
    $sentencia->execute([$producto->id, $idVenta, $cantidad]);
}

$base_de_datos->commit();
array_splice($_SESSION["carritos"],$num, 1);
header("Location: ./index.php?factura=$resultado->id");
}else{
if($cliente == ""||$idcliente == ""){
header("Location: ./index.php?estado=error");
exit;
}else{
$sentencia = $base_de_datos->prepare("INSERT INTO debe(fecha, total,cliente) VALUES (?, ?, ?);");
$sentencia->execute([$ahora, $total,$cliente]);

$sentencia = $base_de_datos->prepare("SELECT id FROM debe ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_debe(producto, debe, cantidad) VALUES (?, ?, ?);");

for ($i = 1; $i < count($_SESSION["carritos"][$num]); $i++) {
    $producto = $_SESSION["carritos"][$num][$i]["producto"];
    $cantidad = $_SESSION["carritos"][$num][$i]["cantidad"];
    $sentencia->execute([$producto->id, $idVenta, $cantidad]);
}

$base_de_datos->commit();
array_splice($_SESSION["carritos"],$num, 1);
header("Location: ./index.php?estado=correcto");
exit;
}
       
}

