<?php
if (!isset($_GET["id"]))
    exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM ingresos WHERE id = ?;");
$sentencia->execute([$id]);
$ingreso = $sentencia->fetch(PDO::FETCH_OBJ);
if ($ingreso === FALSE) {
    echo "¡No existe algún producto con ese ID!";
    exit();
}
?>
<?php include_once "encabezado.php" ?>
<div class="col-xs-3"></div>
<div class="col-xs-6">
    <h1 class="h3 mb-0 text-gray-800">EDITAR INGRESO</h1>
    <br> <br>
    <form method="post" action="guardarCambiosIngresos.php">
        <input type="hidden" name="id" value="<?php echo $ingreso->id; ?>">

        <div class="form-group">
            <label for="fecha">Fecha de ingreso</label>
            <input type="date" value="<?php echo $ingreso->fecha; ?>"  required class="form-control" name="fecha" id="fecha">
        </div>
        <div class="form-group">
            <label for="producto">Producto:</label>
            <input class="form-control" value="<?php echo $ingreso->producto;?>" name="producto" required type="txt" id="producto" placeholder="Producto">
        </div>
         <div class="form-group">
            <label for="monto">Monto en colones:</label>
            <input class="form-control" value="<?php echo $ingreso->monto; ?>" name="monto" required type="number" id="monto" placeholder="Monto">
        </div>
        <div class="form-group">
            <label for="proveedor">Proveedor:</label>
            <input class="form-control" value="<?php echo $ingreso->proveedor; ?>" name="proveedor" required type="txt" id="proveedor" placeholder="Monto">
        </div>
        <br><br><input class="btn btn-info" type="submit" value="Guardar">
        <a class="btn btn-warning" href="./ingresos.php">Cancelar</a>
    </form>
</div>
<?php include_once "pie.php" ?>
