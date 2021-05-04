<?php
$num = $_REQUEST["num"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("UPDATE debe SET activo = '0' WHERE id = $num;");
$sentencia->execute();