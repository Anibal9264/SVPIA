<?php
include_once "encabezado.php";
$ahora = date("Y-m-d");
?>

<div class="col-xs-3"></div>
<div class="col-xs-6">
    <h1 class="h3 mb-0 text-gray-800">Nuevo Ingreso</h1>
    <br><br>
    <form method="post" action="nuevoIngreso.php" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="fecha">Fecha de ingreso</label>
            <input type="date" value="<?php echo $ahora ?>"  required class="form-control" name="fecha" id="fecha">
        </div>
        <div class="form-group">
            <label for="producto">Producto:</label>
            <input class="form-control" name="producto" required type="txt" id="producto" placeholder="Producto">
        </div>
         <div class="form-group">
            <label for="monto">Monto en colones:</label>
            <input class="form-control" name="monto" required type="number" id="monto" placeholder="Monto">
        </div>
        <div class="form-group">
            <label for="proveedor">Proveedor:</label>
            <input class="form-control" name="proveedor" required type="txt" id="proveedor" placeholder="Monto">
        </div>
        
        <br><br><input class="btn btn-info" type="submit" value="Guardar">
    </form>
</div>
<?php include_once "pie.php" ?>
