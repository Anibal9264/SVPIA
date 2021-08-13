<?php
if (!isset($_GET["id"]))
    exit();
$id = $_GET["id"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM ingresos WHERE id = '$id';");
$sentencia->execute();
$ingreso = $sentencia->fetch(PDO::FETCH_OBJ);
if ($ingreso === FALSE) {
    echo "¡No existe algún producto con ese ID!";
    exit();
}
echo "
    <h1 class=' h3 mb-1 text-gray-800'>EDITAR COMPRA</h1>
    
    <form method='post' action='index.php?p=changeIngresos' enctype='multipart/form-data'>
    <input type='hidden' name='id' value='$ingreso->id'>
    <input type='hidden' name='archivoT' value='$ingreso->archivo'>
        <div class='form-row'> 
        <div class='form-group col'>
            <label for='FacturaN'>Factura nº</label>
            <input type='text' required class='form-control' maxlength='255'  name='FacturaN' id='FacturaN' value='$ingreso->facturaNumero'>
        </div>
        <div class='form-group col'>
            <label for='fecha'>Fecha de ingreso</label>
            <input type='text' value='$ingreso->fecha'  required  maxlength='255'class='form-control' name='fecha' id='fecha'>
        </div>
        </div>
         <div class='form-row'> 
        <div class='form-group col'>
            <label for='producto'>Producto:</label>
            <input class='form-control' value='$ingreso->producto'  name='producto' required type='txt' maxlength='255' id='producto' placeholder='Producto'>
        </div>
         <div class='form-group col'>
            <label for='monto'>Monto en colones:</label>
            <input class='form-control' value='$ingreso->monto' name='monto' required type='number' id='monto' placeholder='Monto'>
        </div>
        </div>
        <div class='form-row'> 
        <div class='form-group col'>
            <label for='proveedor'>Proveedor:</label>
            <input class='form-control'value='$ingreso->proveedor' name='proveedor' required  maxlength='255' type='txt' id='proveedor' placeholder='proveedor'>
        </div>
        <div class='form-check col'>
            <label class='form-check-label' for='cambiar'>Marque para Cargar un achivo</label>
            <input class='form-check-input ml-5' type='checkbox'
            onchange='cambiarChech();' id='cambiar' name='cambiar'>
          <div id='cargarimg'>

           </div>

        </div>
        </div>

         <div class='form-group'>
        <input class='btn btn-info' type='submit' value='Guardar'>
        <a class='btn btn-danger' href='./index.php?p=ingresos'>Cancelar</a>
        </div>
    </form>
";
