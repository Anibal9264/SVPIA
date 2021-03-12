<?php

$num = $_REQUEST["num"];
session_start();
if(!isset($_SESSION["colas"])){ 
    $_SESSION["colas"] = [];
}



$cuenta = $_SESSION["carritos"][$num];
date_default_timezone_set('America/Costa_Rica');
$ahora = date("H:i:s");
$cuenta[0]["horaP"] = $ahora;

include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT COUNT(id) as numero FROM ventas WHERE date(fecha) = date(now());");
$sentencia->execute();
$cantidad = $sentencia->fetch(PDO::FETCH_OBJ);
$cantidad->numero += count($_SESSION["colas"])+1;
$cuenta[0]["numDiario"] = $cantidad->numero;
array_push($_SESSION["colas"],$cuenta);
array_splice($_SESSION["carritos"],$num, 1);