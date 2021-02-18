<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["descripcion"]) || 
   !isset($_POST["precioVenta"]))
    exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$descripcion = $_POST["descripcion"];
$precioVenta = $_POST["precioVenta"];

$img = "";

$uploads_dir = '/opt/lampp/htdocs/PVPIA/uploads';
   if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
    }
 if ($_FILES["archivo"]) {
        $rand = date("Y-m-d H:i:s");
        $tmp_name = $_FILES["archivo"]["tmp_name"];
        $name = $rand.basename($_FILES["archivo"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $img = "uploads/$name";
    }

$sentencia1 = $base_de_datos->query("SELECT impuesto FROM local where id = 1;");
$result = $sentencia1->fetch(PDO::FETCH_OBJ);
$r1 = "0.".(int)$result->impuesto;
$tImpuesto = $precioVenta * (float)$r1;
$precionoimpuestos = $precioVenta - $tImpuesto;


$sentencia = $base_de_datos->prepare("INSERT INTO productos(descripcion, precioVenta, precioNoImpuestos, img) VALUES (?, ?, ?, ?);");
$resultado = $sentencia->execute([$descripcion, $precioVenta, $precionoimpuestos,$img]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>