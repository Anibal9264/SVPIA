<?php

$busqueda = $_GET["buscar"];

include_once "../../base_de_datos.php";
$sql = "SELECT *,SUM(pv.cantidad) AS sumaC "
        . "FROM productos left JOIN productos_vendidos as pv "
        . "on pv.producto = id "
        . "where productos.descripcion like UPPER('%$busqueda%')  "
        . "GROUP BY id "
        . "ORDER BY sumaC DESC;";
$sentencia = $base_de_datos->query($sql);
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);


$i = 0;
foreach ($productos as $producto) {

    if ($i == 0) {
        echo "<br> <div class='card-group'>";
    }

    echo "<div class='card bg-light border-secondary mb-3 mx-2' style='max-width: 20rem;'>
              <div class='card-header mb-0'>
                  <a href='agregarAlCarrito.php?codigo=$producto->id'>
                   <img class='card-img-bottom' src='$producto->img'> </a>
              </div>    
              <div class='card-body'>
                      <h5 class='card-title'>$producto->descripcion</h5>
                      <p class='card-text'>₡ $producto->precioVenta</p>
                      
              </div>
              <div class='card-footer'>
                  <a href='index.php?p=agregarAlCarrito&codigo=$producto->id' class='btn btn-primary w-100'>Agregar</a>
              </div>
              </div>
         
            <br>";

    $i++;
    if($i==3){
    echo "</div>";
    $i = 0;
    }
} 

