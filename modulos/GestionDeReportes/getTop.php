<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
$cod = $_GET["cod"];
$fecha = $_GET["fecha"];
include_once "../../base_de_datos.php";
switch($cod){
            
case"1":
    $sql = "SELECT p.descripcion,pv.producto,SUM(pv.cantidad) AS sumaC "
            . "FROM productos_vendidos pv left join productos p "
            . "on p.id = pv.producto where factura "
            . "in (SELECT id FROM ventas v where date(fecha) = date('$fecha'))"
            . "GROUP BY pv.producto ORDER BY sumaC DESC ";
    ;break;
case"2":
     $sql = "SELECT p.descripcion,pv.producto,SUM(pv.cantidad) AS sumaC "
            . "FROM productos_vendidos pv left join productos p "
            . "on p.id = pv.producto where factura "
            . "in (SELECT id FROM ventas v where week(fecha) = week('$fecha') "
            . " and year(fecha) = year('$fecha'))"
            . "GROUP BY pv.producto ORDER BY sumaC DESC";
    break;
case"3":
     $sql = "SELECT p.descripcion,pv.producto,SUM(pv.cantidad) AS sumaC "
            . "FROM productos_vendidos pv left join productos p "
            . "on p.id = pv.producto where factura "
            . "in (SELECT id FROM ventas v where month(fecha) = month('$fecha'))"
            . "GROUP BY pv.producto ORDER BY sumaC DESC";
    break;
}
$sentencia = $base_de_datos->query($sql);
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
$cantidad = 0;
for($i=0;$i<sizeof($productos);$i++){
    $cantidad += (int)$productos[$i]->sumaC;
	echo "<h4 class='small font-weight-bold'>".$productos[$i]->descripcion."<span class='float-right'>".$productos[$i]->sumaC."</span></h4>
      <div class='progress mb-4'>
      <div class='progress-bar bg-success' role='progressbar' style='width:".$productos[$i]->sumaC."%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>
      </div>";
}
echo "<h4 class='small font-weight-bold'> Cantidad de productos: <span class='float-right'>".$cantidad."</span></h4>";
