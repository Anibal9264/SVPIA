<?php
if(!isset($_POST["total"])||
   !isset($_POST["cliente"])
   )exit;


session_start();


$total = $_POST["total"];
if($total == "0"){
header("Location: ./index.php");
exit;
}

$cliente = $_POST["cliente"];
include_once "base_de_datos.php";

date_default_timezone_set('America/Costa_Rica');
$ahora = date("Y-m-d H:i:s");

$sentencia1 = $base_de_datos->query("SELECT impuesto FROM local where id = 1;");
$result = $sentencia1->fetch(PDO::FETCH_OBJ);
$r1 = "0.".(int)$result->impuesto;
$totalimpuestos = $total * (float)$r1;
$totalsinimpuestos = $total - $totalimpuestos;

$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total, totalsinImpuestos, totalimpuestos, cliente, local) VALUES (?, ?, ?, ?, ?, ?);");
$sentencia->execute([$ahora, $total, $totalsinimpuestos, $totalimpuestos, $cliente, 1]);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(producto, factura, cantidad) VALUES (?, ?, ?);");

for ($i = 1; $i < count($_SESSION["carrito"]); $i++) {
    $producto = $_SESSION["carrito"][$i]["producto"];
    $cantidad = $_SESSION["carrito"][$i]["cantidad"];
    $sentencia->execute([$producto->id, $idVenta, $cantidad]);
}

$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./index.php?p=modalPDF&factura=$resultado->id");
?>