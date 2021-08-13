<?php
if (!isset($_REQUEST["codigo"])) {
    return;
}
$num = $_REQUEST["num"];
$id = $_REQUEST["codigo"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = '$id';");
$sentencia->execute();
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 1; $i < count($_SESSION["carritos"][$num]); $i++) {
    $idt = $_SESSION["carritos"][$num][$i]["producto"]->id;
    if ($idt=== (int)$id) {
        $indice = $i;
        break;
    }
}

$_SESSION["carritos"][$num][0]["granT"] += (int)$producto->precioVenta; 
if ($indice === false) {
    $array = array(
    "producto" => $producto,
    "cantidad" => 1,
    "detalle" => "0",
    );
   
   array_push($_SESSION["carritos"][$num],$array);
} else {
   $_SESSION["carritos"][$num][$indice]["cantidad"]++;
}
