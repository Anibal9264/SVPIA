<?php
date_default_timezone_set('America/Costa_Rica');
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
  <a href="./index.php" class="active bg-warning">POLLOS DANNY</a>
  <a class="nav-link" href="./index.php">Vender</a></li>
 <a class="nav-link" href="./index.php?p=ventas">Ventas</a></li>
    <a class="nav-link" href="./index.php?p=reportes">Reportes</a></li>
  <a class="nav-link" href="./index.php?p=productos">Productos</a></li>
   <a class="nav-link" href="./index.php?p=ingresos">Ingresos</a></li>
    <a class="nav-link" href="./index.php?p=local">local</a></li>
  <a href="javascript:void(0);" class="icon" onclick="barraDeHerramientas()">
    <i class="fa fa-bars"></i>
  </a>
</div>
