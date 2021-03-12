<?php
$busqueda = $_GET["buscar"];
session_start();
$cat = $_SESSION["CoP"];
include_once "../../base_de_datos.php";






if($cat == "1"){
   $sql = "SELECT *,SUM(pv.cantidad) AS sumaC "
        . "FROM productos left JOIN productos_vendidos as pv "
        . "on pv.producto = id "
        . "where productos.descripcion like UPPER('%$busqueda%')  "
        . "GROUP BY id "
        . "ORDER BY sumaC DESC;"; 
}else{
    $sql = "SELECT *,SUM(pv.cantidad) AS sumaC "
        . "FROM productos left JOIN productos_vendidos as pv "
        . "on pv.producto = id "
        . "where productos.descripcion like UPPER('%$busqueda%') "
        . "and categoria = $cat "
        . "GROUP BY id "
        . "ORDER BY sumaC DESC;";
    
$sentencia1 = $base_de_datos->prepare("SELECT * FROM categoria WHERE id = ?;");
$sentencia1->execute([$cat]);
$categoria = $sentencia1->fetch(PDO::FETCH_OBJ);
echo "
    <div class='alert alert-warning alert-dismissible mt-1 btn-mod alert-mod'>
                Categoria Selecionada : $categoria->descripcion
    </div>
";


    
    
    
}

$sentencia = $base_de_datos->query($sql);
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

 
$i = 0;
foreach ($productos as $producto) {

    if ($i == 0) {
        echo "<div class='row ml-1'>";
    }

    echo "<div class='col col-mod'>
             <a href='#' onclick='agregarAlCarrito($producto->id);'>
                  <div class='card-flyer'>
                            <div class='text-box'>
                <div class='image-box'>
                  <img src='$producto->img'> 
                </div>    
              <div class='text-container'>
                      <p>$producto->descripcion</p>
                      <p>₡ $producto->precioVenta</p>
                      
              </div>
              </div>
              </div>
              </a>
              </div>
         
            ";

    $i++;
    if($i==6){
    echo "</div>";
    $i = 0;
    }
} 

