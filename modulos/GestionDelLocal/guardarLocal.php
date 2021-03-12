<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}

if(
	!isset($_POST["nombre"]) || 
	!isset($_POST["subNombre"]) || 
	!isset($_POST["direccion"]) || 
        !isset($_POST["provincia"]) || 
        !isset($_POST["canton"]) || 
        !isset($_POST["distrito"])|| 
        !isset($_POST["telefono"])|| 
        !isset($_POST["correo"])|| 
        !isset($_POST["cedula"])|| 
        !isset($_POST["propietario"])||
        !isset($_POST["tipoCambio"])|| 
        !isset($_POST["user"])||
        !isset($_POST["password"])|| 
        !isset($_POST["iva"])
) exit();


include_once "base_de_datos.php";
include_once 'configuracion.php';

$nombre = $_POST["nombre"];
$subNombre = $_POST["subNombre"];
$direccion = $_POST["direccion"];
$provincia = $_POST["provincia"];
$canton = $_POST["canton"];
$distrito = $_POST["distrito"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$iva = $_POST["iva"];
$tipoCambio = $_POST["tipoCambio"];
$cedula = $_POST["cedula"];
$propietario = $_POST["propietario"];
$user = $_POST["user"];
$password = $_POST["password"];
$img = "";

 $uploads_dir = $rootDir.'/logo';
   if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
    }
 if ($_FILES["logo"]["error"]== 0) {
        $rand = "logo";
        $tmp_name = $_FILES["logo"]["tmp_name"];
        $path = $_FILES['logo']['name'];
        $ext = ".".pathinfo($path, PATHINFO_EXTENSION);
        $name = $rand.basename($ext);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $img = "logo/$name";
        
        $sentencia = $base_de_datos->prepare("UPDATE local SET "
        . "nombre = ?, "
        . "subNombre = ?, "
        . "cedula = ?, "
        . "propietario = ?, "
        . "user = ?, "
        . "password = ?, "
        . "direccionExacta = ?, "
        . "provincia = ?, "
        . "canton = ?, "
        . "distrito = ?, "
        . "telefono = ?, "
        . "correo = ?, "
        . "logotipo = ?, "
        . "impuesto = ?, "
        . "tipoDeCambio = ? "
        . "WHERE id = 1;");
    $resultado = $sentencia->execute([
    $nombre,
    $subNombre,
    $cedula,
    $propietario,
    $user,
    $password,
    $direccion,
    $provincia,
    $canton,
    $distrito,
    $telefono,
    $correo,
    $img,
    $iva,
    $tipoCambio]);
}else{
    $sentencia = $base_de_datos->prepare("UPDATE local SET "
        . "nombre = ?, "
        . "subNombre = ?, "
        . "cedula = ?, "
        . "propietario = ?, "
        . "user = ?, "
        . "password = ?, "
        . "direccionExacta = ?, "
        . "provincia = ?, "
        . "canton = ?, "
        . "distrito = ?, "
        . "telefono = ?, "
        . "correo = ?, "
        . "impuesto = ?, "
        . "tipoDeCambio = ? "
        . "WHERE id = 1;");
    $resultado = $sentencia->execute([
    $nombre,
    $subNombre,
    $cedula,
    $propietario,
    $user,
    $password,
    $direccion,
    $provincia,
    $canton,
    $distrito,
    $telefono,
    $correo,
    $iva,
    $tipoCambio]);
}



if($resultado === TRUE){
	header("Location: ./index.php?p=local&correcto=yes");
	exit;
}else{
echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
}
