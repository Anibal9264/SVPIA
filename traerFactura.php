<?php

$busqueda = $_GET["buscar"];

$arrayF = array();

include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM ventas where id = $busqueda");
$sentencia->execute();
$factura = $sentencia->fetch(PDO::FETCH_OBJ);
array_push($arrayF,$factura);

$sentencia = $base_de_datos->prepare("SELECT * FROM local where id = 1");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
array_push($arrayF,$local);

$sentencia = $base_de_datos->query("SELECT * from productos WHERE id in (SELECT producto FROM productos_vendidos WHERE factura = $busqueda)");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT cantidad FROM productos_vendidos WHERE factura = ? and producto = ?");

for ($i = 0; $i < count($productos); $i++) {
    
    $producto = $productos[$i];
    $sentencia->execute([$busqueda,$producto->id]);
    $cantidad = $sentencia->fetch(PDO::FETCH_OBJ);
    $array = array(
    "producto" => $producto,
    "cantidad" => $cantidad,
    );
    
    array_push($arrayF,$array);
    
}

echo json_encode($arrayF);

