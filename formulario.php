<?php include_once "encabezado.php" ?>

<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM tipo;");
$tipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-xs-3"></div>
	<div class="col-xs-6">
	<h1>Nuevo producto</h1>
	<form method="post" action="nuevo.php" enctype="multipart/form-data" >
		<label for="descripcion">Imagen:</label>
                <input type='file' name='archivo' required >
                <br><br>
                <select class="form-select" aria-label="Default select example" id="tipo" name="tipo">
                    <option selected>Selecione el Tipo</option>
                    <?php foreach($tipos as $tipo){ ?>
                    <option value="<?php echo $tipo->id ?>"><?php echo $tipo->descripcion?></option>
                    <?php } ?>
                </select>
                <br><br>
		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>