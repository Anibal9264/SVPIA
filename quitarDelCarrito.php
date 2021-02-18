<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
 $_SESSION["carrito"][0] -=  $_SESSION["carrito"][$indice]["producto"]->precioVenta;
array_splice($_SESSION["carrito"], $indice, 1);
header("Location: ./vender.php?status=3");
?>