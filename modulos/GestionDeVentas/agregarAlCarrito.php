<?php
if (!isset($_REQUEST["codigo"])) {
    return;
}

$id = $_REQUEST["codigo"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 1; $i < count($_SESSION["carrito"]); $i++) {
    $idt = $_SESSION["carrito"][$i]["producto"]->id;
    if ($idt=== (int)$id) {
        $indice = $i;
        break;
    }
}

# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $array = array(
    "producto" => $producto,
    "cantidad" => 1,
    );
    
    if(count($_SESSION["carrito"])==0){
         $total = (int)$producto->precioVenta;
         array_push($_SESSION["carrito"],$total);
    }else{
       $_SESSION["carrito"][0] += (int)$producto->precioVenta; 
    }
    array_push($_SESSION["carrito"],$array);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya

   $_SESSION["carrito"][$indice]["cantidad"]++;
   $_SESSION["carrito"][0] += (int)$producto->precioVenta;
}
header("Location: ./index.php");
