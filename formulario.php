<?php include_once "encabezado.php" ?>

<div class="col-xs-3"></div>
	<div class="col-xs-6">
	<h1 class="h3 mb-0 text-gray-800">Nuevo producto</h1>
	<form method="post" action="nuevo.php" enctype="multipart/form-data" >
		<label for="descripcion">Imagen:</label>
                <input type='file' name='archivo' required >
                <br>
                <br><br>
		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>