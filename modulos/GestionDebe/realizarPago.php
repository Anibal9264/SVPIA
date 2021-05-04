<?php
$arrayF = array();
$num = $_REQUEST["num"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM debe where id = $num");
$sentencia->execute();
$cuenta = $sentencia->fetch(PDO::FETCH_OBJ);
$car = array(
    "granT" => $cuenta->total,
    "cliente" => $cuenta->cliente,
    "idcliente" => "",
    "tClientes" => 1,
    "tPago" => 1,
    "numDiario" => 0,
    "horaP" => "",
     
);

array_push($arrayF,$car);


$sentencia = $base_de_datos->query("SELECT * from productos WHERE id in (SELECT producto FROM productos_debe WHERE debe = $cuenta->id )");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);


$sentencia = $base_de_datos->prepare("SELECT cantidad FROM productos_debe WHERE debe = ? and producto = ?");

for ($a = 0; $a < count($productos); $a++) {
    
    $producto = $productos[$a];
    $sentencia->execute([$cuenta->id,$producto->id]);
    $cantidad = $sentencia->fetch(PDO::FETCH_OBJ); 
$array = array(
    "producto" => $producto,
    "detalle" => "",
    "cantidad" => $cantidad->cantidad,
    );
    
    array_push($arrayF,$array);
    
}

session_start();
array_push($_SESSION["carritos"],$arrayF);

$sentencia = $base_de_datos->prepare("UPDATE debe SET activo = '0' WHERE id = $num;");
$sentencia->execute();
$cant = sizeof($_SESSION["carritos"])-1;
echo $cant;

