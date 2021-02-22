<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
 $_SESSION["carrito"][0] -=  $_SESSION["carrito"][$indice]["producto"]->precioVenta;
 if($_SESSION["carrito"][$indice]["cantidad"]>1){
    $_SESSION["carrito"][$indice]["cantidad"]--;
 }else{
   array_splice($_SESSION["carrito"], $indice, 1);  
 }
header("Location: ./index.php");
?>