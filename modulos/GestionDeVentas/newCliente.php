<?php
include_once "../../base_de_datos.php";
$nombre = $_REQUEST["n"];
$telefono = $_REQUEST["t"];

$sentencia = $base_de_datos->prepare("INSERT INTO cliente(nombre, telefono) VALUES (?, ?);");
$resultado = $sentencia->execute([$nombre,$telefono]);
