<?php

if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../base_de_datos.php";
$sentencia1 = $base_de_datos->prepare("UPDATE ventas SET tipoPago = '1' WHERE id = $id;");
$resultado = $sentencia1->execute();
