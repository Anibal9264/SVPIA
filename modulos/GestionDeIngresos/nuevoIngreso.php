<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["fecha"]) || 
   !isset($_POST["producto"]) || 
   !isset($_POST["monto"]) || 
   !isset($_POST["FacturaN"]) ||
   !isset($_POST["proveedor"]))
    exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
include_once 'configuracion.php';
$fecha = $_POST["fecha"];
$producto = $_POST["producto"];
$monto = $_POST["monto"];
$proveedor = $_POST["proveedor"];
$factura = $_POST["FacturaN"];

$archivo = "";
        
$uploads_dir = $rootDir.'/ArchivosFacturas';
   if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
    }
 if ($_FILES["archivo"]) {
        $rand = date("Y-m-d H-i-s");
        $tmp_name = $_FILES["archivo"]["tmp_name"];
        $path = $_FILES['archivo']['name'];
        $ext = ".".pathinfo($path, PATHINFO_EXTENSION);
        $name = $rand.basename($ext);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $archivo = "ArchivosFacturas/$name";    
}


$sentencia = $base_de_datos->prepare("INSERT INTO ingresos(proveedor, producto, monto, fecha, facturaNumero, archivo) "
        . "VALUES ('$proveedor', '$producto', '$monto', '$fecha', '$factura', '$archivo');");
$resultado = $sentencia->execute();

if($resultado === TRUE){
	header("Location:./index.php?p=ingresos&correcto=new");
}else {
    header("Location: ./index.php?p=productos&correcto=error");
}
exit;

