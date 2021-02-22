<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM local");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="col-xs-1"></div>
	<div class="col-xs-9">
	<h1 class="h3 mb-0 text-gray-800 mb-4">DATOS DEL LOCAL</h1>
       
	<form method="post" action="index.php?p=changeLocal">
            <div class="form-group">
                <label for="nombre">Nombre del Local</label>
                <input class="form-control" name="nombre" required 
                       value="<?php echo $local->nombre ?>" type="txt" id="nombre" placeholder="Nombre del Local">
            </div>
            <div class="form-group">
                <label for="subNombre">SubNombre del Local</label>
                <input class="form-control" name="subNombre" required 
                       value="<?php echo $local->subNombre ?>" type="txt" id="subNombre" placeholder="subNombre del Local">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección exacta</label>
                <input class="form-control" name="direccion" required 
                       value="<?php echo $local->direccionExacta ?>" type="txt" id="direccion" placeholder="Direccion del Local">
            </div>
            <div class="row">
            <div class="form-group ml-5">
                <label for="provincia">Provincia</label>
                <input class="form-control" name="provincia" required 
                       value="<?php echo $local->provincia ?>" type="txt" id="provincia" placeholder="provincia">
            </div>
                <div class="form-group ml-4">
                <label for="canton">Cantón</label>
                <input class="form-control" name="canton" required 
                       value="<?php echo $local->canton ?>" type="txt" id="canton" placeholder="canton">
            </div>
                <div class="form-group ml-4">
                <label for="distrito">Distrito</label>
                <input class="form-control" name="distrito" required 
                       value="<?php echo $local->distrito ?>" type="txt" id="distrito" placeholder="Nombre del Local">
            </div>
            </div>
            <div class="row">
            <div class="form-group ml-5">
                <label for="telefono">Telefono</label>
                <input class="form-control" name="telefono" required 
                       value="<?php echo $local->telefono ?>" type="tel" id="telefono" placeholder="Nombre del Local">
            </div>
            
            <div class="form-group ml-4">
                <label for="correo">Correo</label>
                <input class="form-control" name="correo" required 
                       value="<?php echo $local->correo ?>" type="email" id="correo" placeholder="Nombre del Local">
            </div>
                <div class="form-group ml-4">
                <label for="iva">IVA</label>
                <input class="form-control" name="iva" required 
                       value="<?php echo $local->impuesto ?>" type="number" id="iva" placeholder="Nombre del Local">
            </div>
            </div>
            
		<input class="btn btn-info" type="submit" value="Guardar Cambios">
                
                <br><br>
	</form>
</div>

