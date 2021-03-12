<?php
$busqueda = $_GET["buscar"];
include_once "../../base_de_datos.php";
$sql = "SELECT * FROM categoria;";
$sentencia = $base_de_datos->query($sql);
$categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);

$a="%%";
$i = 0;
foreach ($categorias as $categoria) {

    if ($i == 0) {
        echo "<div class='row ml-1'>";
    }

    echo "<div class='col col-mod'>
             <a href='#' onclick='establecerCategoria($categoria->id);'>
                  <div class='card-flyer'>
                            <div class='text-box'>
                <div class='image-box'>
                  <img src='$categoria->img'> 
                </div>    
              <div class='text-container'>
                      <p>$categoria->descripcion</p>
                      
                      
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

