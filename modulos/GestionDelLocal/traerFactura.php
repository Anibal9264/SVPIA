<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
$arrayF = array();

include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM ventas");
$facturas = $sentencia->fetchAll(PDO::FETCH_OBJ);
array_push($arrayF,$facturas);

$sentencia = $base_de_datos->prepare("SELECT * FROM local where id = 1");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
array_push($arrayF,$local);

 $productosFacturas = array();

for ($a = 0; $a < count($facturas); $a++) {
    $factura = $facturas[$a];

$sentencia = $base_de_datos->query("SELECT * from productos WHERE id in (SELECT producto FROM productos_vendidos WHERE factura = $factura->id )");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT cantidad FROM productos_vendidos WHERE factura = ? and producto = ?");

$pFactura = array();

for ($i = 0; $i < count($productos); $i++) {
    $producto = $productos[$i];
    $sentencia->execute([$factura->id,$producto->id]);
    $cantidad = $sentencia->fetch(PDO::FETCH_OBJ);
    $array = array(
    "producto" => $producto,
    "cantidad" => $cantidad,
    );
    
    array_push($pFactura,$array);
}
array_push($productosFacturas,$pFactura);
}

array_push($arrayF,$productosFacturas);

echo json_encode($arrayF);

