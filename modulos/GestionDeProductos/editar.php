<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
if (!isset($_GET["id"]))exit();
$id = $_GET["id"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if ($producto === FALSE) {
    echo "¡No existe algún producto con ese ID!";
    exit();
}

$sentencia2 = $base_de_datos->query("SELECT * FROM categoria;"); 
$categorias = $sentencia2->fetchAll(PDO::FETCH_OBJ);


echo "<h4 class='modal-title'>Editar producto</h4>
 <br>
    <form method='post' action='index.php?p=changeProduct' enctype='multipart/form-data' >
        <input type='hidden' name='id' value='$producto->id'>

        <img src='$producto->img' class='rounded mx-auto' width='100' height='100'>
        <input type='hidden' value='$producto->img' class='form-control' name='img' id='img'>
        <div class='form-check'>
            <label class='form-check-label' for='cambiar'>Marque para cambiar la imagen </label>
            <br>
            <input class='form-check-input' type='checkbox'
            onchange='cambiarChech();' id='cambiar' name='cambiar'>
            <br>

        </div>
        <div id='cargarimg'>

        </div>
        <div class='form-group'>
        <label for='categorias'>Categorias</label>
        <select class='form-control form-control-mod btn-mod' name='categorias' id='categorias'>";
     foreach ($categorias as $categoria){
       echo " <option value='$categoria->id' ";
       if ($categoria->id == $producto->categoria) { echo " selected ";}
       echo ">$categoria->descripcion</option>";
     }
       echo "</select>
        </div>

        <label for='descripcion'>Descripción:</label>
        <input required id='descripcion' name='descripcion' class='form-control' value='$producto->descripcion'>

        <label for='precioVenta'>Precio de venta:</label>
        <input value='$producto->precioVenta' class='form-control' name='precioVenta' required type='number' id='precioVenta' placeholder='Precio de venta'>

        <br><br><input class='btn btn-info' type='submit' value='Guardar'>
        <a class='btn btn-warning' href='./index.php?p=productos'>Cancelar</a>
    </form>";
