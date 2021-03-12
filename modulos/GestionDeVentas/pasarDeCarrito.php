<?php
$desde = $_GET["num"];
$hacia = $_GET["num2"];
$ind = $_GET["indice"];
$id = $_GET["id"];

session_start();
$car = $_SESSION["carritos"][$desde][$ind];
$producto = $car["producto"];
$cantidad = $car["cantidad"];
$detalle = $car["detalle"];

// lo agregamos en el carrito nuevo
# Buscar producto dentro del cartito
$indice = false;
for ($i = 1; $i < count($_SESSION["carritos"][$hacia]); $i++) {
    $idt = $_SESSION["carritos"][$hacia][$i]["producto"]->id;
    if ($idt=== (int)$id) {
        $indice = $i;
        break;
    }
}

$_SESSION["carritos"][$hacia][0]["granT"] += (int)$producto->precioVenta; 
if ($indice === false) {
    $array = array(
    "producto" => $producto,
    "cantidad" => 1,
    "detalle" => $detalle,
    );
    array_push($_SESSION["carritos"][$hacia],$array);
} else {
   $_SESSION["carritos"][$hacia][$indice]["cantidad"]++;
}


// lo quitamos del viejo
$_SESSION["carritos"][$desde][0]["granT"] -= (float)$producto->precioVenta;
if($_SESSION["carritos"][$desde][$ind]["cantidad"]>1){
    $_SESSION["carritos"][$desde][$ind]["cantidad"]--;
    echo $desde;
 }else{
   array_splice($_SESSION["carritos"][$desde], $ind, 1);
   if(count($_SESSION["carritos"][$desde]) == 1){
    array_splice($_SESSION["carritos"],$desde, 1);
   echo '0';
   }else {
     echo $desde;  
   } 
}




