<?php
if (!isset($_GET["id"]))
    exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if ($producto === FALSE) {
    echo "¡No existe algún producto con ese ID!";
    exit();
}
?>
<?php include_once "encabezado.php" ?>
<div class="col-xs-3"></div>
<div class="col-xs-6">
    <h1>Editar producto</h1>
    <form method="post" action="guardarDatosEditados.php" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php echo $producto->id; ?>">

        <img src="<?php echo $producto->img ?>" class="rounded mx-auto" width="100" height="100">
        <input type="hidden" value="<?php echo $producto->img ?>" class="form-control" name="img" id="img">
        <div class="form-check">
            <label class="form-check-label" for="cambiar">Marque para cambiar la imagen </label>
             <br>
            <input class="form-check-input" type="checkbox" value="" 
                   onchange="cambiarChech();" id="cambiar" name="cambiar">
            <br>

        </div>
        <div id="cargarimg">

        </div>


        <label for="descripcion">Descripción:</label>
        <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto->descripcion ?></textarea>

        <label for="precioVenta">Precio de venta:</label>
        <input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

        <br><br><input class="btn btn-info" type="submit" value="Guardar">
        <a class="btn btn-warning" href="./listar.php">Cancelar</a>
    </form>
</div>
<?php include_once "pie.php" ?>
