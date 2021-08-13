<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
include_once "../../base_de_datos.php";
$desde= $_GET["desde"];
$hasta = $_GET["hasta"];
$tipo = $_GET["tipo"];

$arrayF = array();

$sentencia = $base_de_datos->prepare("SELECT * FROM local where id = 1");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
array_push($arrayF,$local);


$aTP = array();

if($tipo == "1"){
$sentencia = $base_de_datos->query("SELECT date(fecha) as fecha,"
        . "count(id) as cantidad,"
        . "sum(total) as total, "
        . "tipoPago "
        . "FROM ventas where date(fecha) between "
        . "date('$desde') and date('$hasta') "
        . "and tipoPago != 4 "
        . "group by date(fecha);");
for($i=1; $i<=3 ;$i++){
    $sent = $base_de_datos->query("SELECT sum(total) as total "
        . "FROM ventas where date(fecha) between "
        . "date('$desde') and date('$hasta') "
        . "and tipoPago = $i");
    $total = $sent->fetchAll(PDO::FETCH_OBJ);
    $tt = $total[0]->total;
    if (!$tt) { $tt = 0;}
        array_push($aTP,$tt);
}


}elseif ($tipo == "2") {
    $sentencia = $base_de_datos->query("SELECT CONCAT('Semana', ' ', week(fecha)) as fecha,"
        . "count(id) as cantidad,"
        . "sum(total) as total "
        . "FROM ventas where week(fecha) between "
        . "week('$desde') and week('$hasta') "
        . "and year(fecha) between year('$desde') and year('$hasta') "
        . "and tipoPago != 4 "
        . "group by week(fecha);");
    
    for($i=1; $i<=3 ;$i++){
    $sent = $base_de_datos->query("SELECT sum(total) as total "
        . "FROM ventas where week(fecha) between "
        . "week('$desde') and week('$hasta') "
        . "and year(fecha) between year('$desde') and year('$hasta') "
        . "and tipoPago = $i");
    $total = $sent->fetchAll(PDO::FETCH_OBJ);
    $tt = $total[0]->total;
    if (!$tt) { $tt = 0;}
        array_push($aTP,$tt);
}
    
    
    
}elseif($tipo == "3"){
     $sentencia = $base_de_datos->query("SELECT CONCAT('Mes', ' ', month(fecha)) as fecha,"
        . "count(id) as cantidad,"
        . "sum(total) as total "
        . "FROM ventas where month(fecha) between "
        . "month('$desde') and month('$hasta') "
        . "and year(fecha) between year('$desde') and year('$hasta') "
        . "and tipoPago != 4 "
        . "group by month(fecha);");
     
        for($i=1; $i<=3 ;$i++){
    $sent = $base_de_datos->query("SELECT sum(total) as total "
        . "FROM ventas where month(fecha) between "
        . "month('$desde') and month('$hasta') "
        . "and year(fecha) between year('$desde') and year('$hasta') "
        . "and tipoPago = $i");
    $total = $sent->fetchAll(PDO::FETCH_OBJ);
    $tt = $total[0]->total;
    if (!$tt) { $tt = 0;}
        array_push($aTP,$tt);
}
     
     
     
}

$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
array_push($ventas,$aTP);
array_push($arrayF,$ventas);

if($tipo == "1"){
$sentencia = $base_de_datos->query("SELECT * FROM ingresos WHERE fecha BETWEEN '$desde' and '$hasta';");
}elseif ($tipo == "2") {
    $sentencia = $base_de_datos->query("SELECT concat('Varios')as proveedor,"
            . "concat('Varios')as producto,"
            . "sum(monto) as monto,CONCAT('Semana', ' ', week(fecha)) as fecha "
            . "FROM ingresos WHERE week(fecha) "
            . "BETWEEN week('$desde') and week('$hasta') "
            . "and year(fecha) between year('$desde') and year('$hasta') "
            . "group by week(fecha)");
    
}elseif($tipo == "3"){
       $sentencia = $base_de_datos->query("SELECT concat('Varios')as proveedor,"
            . "concat('Varios')as producto,"
            . "sum(monto) as monto,CONCAT('Mes', ' ', month(fecha)) as fecha "
            . "FROM ingresos WHERE month(fecha) "
            . "BETWEEN month('$desde') and month('$hasta') "
            . "and year(fecha) between year('$desde') and year('$hasta') "
            . "group by month(fecha)");
}

$ingresos = $sentencia->fetchAll(PDO::FETCH_OBJ);



array_push($arrayF,$ingresos);

echo json_encode($arrayF);
