
<div class="col-xs-3"></div>
	<div class="col-xs-6">
	<h1 class="h3 mb-0 text-gray-800">Nuevo producto</h1>
	<form method="post" action="index.php?p=newProduct" enctype="multipart/form-data" >
            <div class="form-group">
            <label for="descripcion">Imagen:</label>
            <input type='file' name='archivo' required >
            </div>
            <div class="form-group">
		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">
             </div>
            <div class="form-group">
		<input class="btn btn-primary" type="submit" value="Guardar">
                <a class="btn btn-danger" href="./index.php?p=productos">Cancelar</a>
            </div>
	</form>
</div>