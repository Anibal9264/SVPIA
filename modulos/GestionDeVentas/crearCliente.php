<?php
$n = $_REQUEST["nombre"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("INSERT INTO cliente (id, nombre) VALUES (NULL, '$n');");
$sentencia->execute();


