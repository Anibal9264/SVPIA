<?php

if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM productos_vendidos WHERE factura = ?;");
$resultado = $sentencia->execute([$id]);
$sentencia1 = $base_de_datos->prepare("DELETE FROM ventas WHERE id = ?;");
$resultado = $sentencia1->execute([$id]);

