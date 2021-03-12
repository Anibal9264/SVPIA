<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
$tipo = $_GET["tipo"];
if(!$tipo){
   echo "<h4 class='modal-title'>Nueva Categoria</h4>
         <br>
	<form method='post' action='index.php?p=newCategoria' enctype='multipart/form-data' >
            <div class='form-group'>
            <label for='descripcion'>Imagen:</label>
            <input type='file' name='archivo' required >
            </div>
            <div class='form-group'>
		<label for='descripcion'>Descripción:</label>
                <input required id='descripcion' maxlength='250' name='descripcion' class='form-control'>
            </div>
           
            <div class='form-group'>
		<input class='btn btn-primary' type='submit' value='Guardar'>
                <a class='btn btn-danger' href='./index.php?p=productos'>Cancelar</a>
            </div>
  </form>  ";
}else{
$id = $_GET["id"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM categoria where id = $id");
$sentencia->execute();
$categoria = $sentencia->fetch(PDO::FETCH_OBJ);
   echo "<h4 class='modal-title'>Editar Categoria</h4>
         <br>
	<form method='post' action='index.php?p=editarCategoria' enctype='multipart/form-data' >
             <input type='hidden' name='id' value='$categoria->id'>
            <div class='form-group'>
            <label class='form-check-label' for='cambiar'>Marque para cambiar la imagen </label>
            <br>
            <input class='form-check-input' type='checkbox'  
            onchange='cambiarChech();' id='cambiar' name='cambiar'>
            <div id='cargarimg'></div>
            <img src='$categoria->img ' class='rounded mx-auto d-block' width='100' height='100'>
            <input type='hidden' value='$categoria->img' class='form-control' name='img' id='img'>
            </div>
            <div class='form-group'>
		<label for='descripcion'>Descripción:</label>
                <input required id='descripcion' maxlength='250' name='descripcion' 
                value='$categoria->descripcion'class='form-control'>
            </div>
           
            <div class='form-group'>
		<input class='btn btn-primary' type='submit' value='Guardar'>
                <a class='btn btn-danger' href='./index.php?p=productos'>Cancelar</a>
            </div>
  </form>  "; 
}

