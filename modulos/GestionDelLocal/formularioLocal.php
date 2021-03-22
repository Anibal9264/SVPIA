<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}


include_once "base_de_datos.php";
if(isset($_REQUEST["correcto"])){
    echo '<script>swal("Datos Modificados!", "Los datos se modificaron correctamente!", "success");</script>';
}


$sentencia = $base_de_datos->prepare("SELECT * FROM local");
$sentencia->execute();
$local = $sentencia->fetch(PDO::FETCH_OBJ);
?>
<script src="modulos/GestionDelLocal/modificarPDF.js" type="text/javascript"></script>
<div class="col-xs-1"></div>
	<div class="col-xs-9">
	<h1 class="h3 mb-0 text-gray-800 mb-4">DATOS DEL LOCAL</h1>
       
	<form method="post" action="index.php?p=changeLocal" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                <label for="nombre">Nombre del Local</label>
                <input class="form-control" name="nombre" required 
                       value="<?php echo $local->nombre ?>" type="txt" id="nombre" placeholder="Casa grande">
            </div>
            <div class="col">
                <label for="subNombre">SubNombre del Local</label>
                <input class="form-control" name="subNombre" required 
                       value="<?php echo $local->subNombre ?>" type="txt" id="subNombre" placeholder="la Casita">
            </div>
            </div>
            <div class="row mt-1">
            <div class="col">
                <label for="propietario">Propietario</label>
                <input class="form-control" name="propietario" required 
                       value="<?php echo $local->propietario ?>" type="txt" id="propietario" placeholder="Los hermanos">
            </div>
            <div class="col">
                <label for="cedula">Cedula</label>
                <input class="form-control" name="cedula" required 
                       value="<?php echo $local->cedula ?>" type="txt" id="cedula" placeholder="5-123-456">
            </div>
                <div class="col">
                <label for="user">Usuario</label>
                <input class="form-control" name="user" required 
                       value="<?php echo $local->user ?>" type="txt" id="user" placeholder="user">
            </div>
            <div class="col">
                <label for="password">Contraseña</label>
                <input class="form-control" name="password" required 
                       value="<?php echo $local->password ?>" type="password" id="password" placeholder="password">
            </div>
            </div>
            <div class="row">
                <div class="col">
            <label for="logo">Logotipo:</label>
            <input type='file' name='logo'>
                </div>
            <div class="col">
                <label for="direccion">Dirección exacta</label>
                <input class="form-control" name="direccion" required 
                       value="<?php echo $local->direccionExacta ?>" type="txt" id="direccion" placeholder="100mts al sur...">
            </div>
            </div>
            <div class="row">
            <div class="col">
                <label for="provincia">Provincia</label>
                <input class="form-control" name="provincia" required 
                       value="<?php echo $local->provincia ?>" type="txt" id="provincia" placeholder="Guanacaste">
            </div>
                <div class="col">
                <label for="canton">Cantón</label>
                <input class="form-control" name="canton" required 
                       value="<?php echo $local->canton ?>" type="txt" id="canton" placeholder="Abangares">
            </div>
                <div class="col">
                <label for="distrito">Distrito</label>
                <input class="form-control" name="distrito" required 
                       value="<?php echo $local->distrito ?>" type="txt" id="distrito" placeholder="Las juntas">
            </div>
            </div>
            <div class="row">
            <div class="col">
                <label for="telefono">Telefono</label>
                <input class="form-control" name="telefono" required 
                       value="<?php echo $local->telefono ?>" type="tel" id="telefono" placeholder="88888888">
            </div>
            
            <div class="col">
                <label for="correo">Correo</label>
                <input class="form-control" name="correo" required 
                       value="<?php echo $local->correo ?>" type="email" id="correo" placeholder="correo@dominio.com">
            </div>
                <div class="col">
                <label for="iva">IVA</label>
                <input class="form-control" name="iva" required 
                       value="<?php echo $local->impuesto ?>" type="number" id="iva" placeholder="Impuesto">
            </div>
            <div class="col">
                <label for="iva">Tipo de Cambio</label>
                <input class="form-control" name="tipoCambio" required 
                       value="<?php echo $local->tipoDeCambio ?>" type="number" id="iva" placeholder="Tipo de Cambio">
            </div>
            </div>
            <div class="form-group mt-3">
		<input class="btn btn-primary" type="submit" value="Guardar Cambios">
                <a class="btn btn-danger" href="./index.php">Cancelar</a>
            </div>  
               
	</form>
</div>

