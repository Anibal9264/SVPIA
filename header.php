<?php
date_default_timezone_set('America/Costa_Rica');
include_once "./base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT nombre FROM local;");
$sentencia->execute();
$NombreLocal = $sentencia->fetch(PDO::FETCH_OBJ)->nombre;
?>
<script>
    function barraDeHerramientas() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<div class="topnav bg-primary" id="myTopnav">
    <a href="./index.php" class="active bg-warning"><?php echo substr($NombreLocal,0,12);?></a>
  <a class="nav-link" href="./index.php">Orden</a>
   <a class="nav-link" href="./index.php?p=cola">Cola</a>
   <?php 
   session_start();
   if(!isset($_SESSION['Logeado'])){
      $_SESSION['Logeado'] = false;
   } 
   
   
   if ($_SESSION['Logeado']){
   ?>
 <a class="nav-link" href="./index.php?p=ventas">Ventas</a>
 <a class="nav-link" href="./index.php?p=fiado">Fiados</a>
    <a class="nav-link" href="./index.php?p=reportes">Reportes</a>
  <a class="nav-link" href="./index.php?p=productos">Productos y Categorias</a>
   <a class="nav-link" href="./index.php?p=ingresos">Compras</a>
  <a class="nav-link" href="./index.php?p=local">local</a>
  <a class="nav-link" href="./index.php?p=salir">Salir <span class="fa fa-user ml-1"></span></a>
   <?php }else{?>
  <a class="nav-link" href="./index.php?p=login">Entrar <span class="fa fa-user ml-1"></span></a>
   <?php }?>
  <a href="#" class="icon mt-1" onclick="barraDeHerramientas()">
    <i class="fa fa-bars"></i>
  </a>
</div>
