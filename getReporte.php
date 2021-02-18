<?php
include_once "base_de_datos.php";
$desde= $_GET["desde"];
$hasta = $_GET["hasta"];
$tipo = $_GET["tipo"];

$arrayF = array();

$sentencia = $base_de_datos->prepare("SELECT * FROM local where id = 1");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
array_push($arrayF,$local);
if($tipo == "1"){
$sentencia = $base_de_datos->query("SELECT date(fecha) as fecha,"
        . "count(id) as cantidad,"
        . "sum(totalsinImpuestos) as totalsinImpuestos,"
        . "sum(totalimpuestos) as totalimpuestos,sum(total) as total "
        . "FROM SVPIA.ventas where date(fecha) between "
        . "date('$desde') and date('$hasta') "
        . "group by date(fecha);");

}elseif ($tipo == "2") {
    $sentencia = $base_de_datos->query("SELECT CONCAT('Semana', ' ', week(fecha)) as fecha,"
        . "count(id) as cantidad,"
        . "sum(totalsinImpuestos) as totalsinImpuestos,"
        . "sum(totalimpuestos) as totalimpuestos,sum(total) as total "
        . "FROM SVPIA.ventas where week(fecha) between "
        . "week('$desde') and week('$hasta') "
        . "group by week(fecha);");
    
}elseif($tipo == "3"){
     $sentencia = $base_de_datos->query("SELECT CONCAT('Mes', ' ', month(fecha)) as fecha,"
        . "count(id) as cantidad,"
        . "sum(totalsinImpuestos) as totalsinImpuestos,"
        . "sum(totalimpuestos) as totalimpuestos,sum(total) as total "
        . "FROM SVPIA.ventas where month(fecha) between "
        . "month('$desde') and month('$hasta') "
        . "group by month(fecha);");
}

$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

array_push($arrayF,$ventas);

if($tipo == "1"){
$sentencia = $base_de_datos->query("SELECT * FROM ingresos WHERE fecha BETWEEN '$desde' and '$hasta';");
}elseif ($tipo == "2") {
    $sentencia = $base_de_datos->query("SELECT concat('Varios')as proveedor,"
            . "concat('Varios')as producto,"
            . "sum(monto) as monto,CONCAT('Semana', ' ', week(fecha)) as fecha "
            . "FROM ingresos WHERE week(fecha) "
            . "BETWEEN week('$desde') and week('$hasta') group by week(fecha)");
    
}elseif($tipo == "3"){
       $sentencia = $base_de_datos->query("SELECT concat('Varios')as proveedor,"
            . "concat('Varios')as producto,"
            . "sum(monto) as monto,CONCAT('Mes', ' ', month(fecha)) as fecha "
            . "FROM ingresos WHERE month(fecha) "
            . "BETWEEN month('$desde') and month('$hasta') group by month(fecha)");
}

$ingresos = $sentencia->fetchAll(PDO::FETCH_OBJ);



array_push($arrayF,$ingresos);

echo json_encode($arrayF);
