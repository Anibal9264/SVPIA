
<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
include_once "../../base_de_datos.php";

$sentencia = $base_de_datos->query("SELECT * FROM categoria;"); //where id != 1
$categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);





echo "<h4 class='modal-title'>Nuevo Producto</h4>
<br>
<form method='post' action='index.php?p=newProduct' enctype='multipart/form-data' >
    <div class='form-group'>
        <label for='descripcion'>Imagen:</label>
        <input type='file' name='archivo' required >
    </div>
    <div class='form-group'>
        <label for='categorias'>Categorias</label>
        <select class='form-control form-control-mod btn-mod' name='categorias' id='categorias'>";
     foreach ($categorias as $categoria){
       echo " <option value='$categoria->id' ";
       if ($categoria->id == 1) { echo " selected ";}
       echo ">$categoria->descripcion</option>";
     }
    echo "</select>
    </div>
    <div class='form-group'>
        <label for='descripcion'>Descripción:</label>
        <input required id='descripcion' name='descripcion'class='form-control'></input>
    </div>
    <div class='form-group'>
        <label for='precioVenta'>Precio de venta:</label>
        <input class='form-control' name='precioVenta' required type='number' id='precioVenta' placeholder='Precio de venta'>
    </div>
    <div class='form-group'>
        <input class='btn btn-primary' type='submit' value='Guardar'>
        <a class='btn btn-danger' href='./index.php?p=productos'>Cancelar</a>
    </div>
  
</form>";
