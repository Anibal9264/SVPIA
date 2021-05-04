<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM debe where activo = 1");
$sentencia->execute();
$deben = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_REQUEST["estado"])) {
    switch ($_REQUEST["estado"]) {
        case "correcto":
            echo "<script>Swal.fire({ icon: 'success', title: 'Guardado Correctamente!', text: 'Los datos se guardaron correctamente!'});</script>";
            break;
       
        case "error":
            echo "<script>Swal.fire({ icon: 'error', title: 'Error!', text: 'DEBE DE AGREGAR UN CLIENTE!'});</script>";
            break;
    }
}
?>
<script src="modulos/GestionDebe/controller.js" type="text/javascript"></script>
<div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-12">
    <h1 class="h3 mb-0 text-gray-800">Lista De Deben</h1>
    <br>
    <br>
    <input class="form-control" id="myInput" type="text" placeholder="Search.." onchange="totalcal();">
    <br>
    <div class="addScroll6">
    <table class="table table-bordered" id="TCola">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha y hora</th>
                <th>Detalle</th>
                <th>Total</th>
                <th>Cancelar</th>
                <th>Terminar</th>
            </tr>
        </thead>

        <tbody id="Tbody">



            <?php 
            for ($i = count($deben); $i > 0; $i--) { ?>
                <tr>
                    
                    <td id="cliente"><?php echo $deben[$i - 1]->cliente ?></td>
                    
                    <td><?php echo $deben[$i - 1]->fecha ?></td>
                    <td>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>


             <?php
    $debe = $deben[$i - 1];
    
$sentencia = $base_de_datos->query("SELECT * from productos WHERE id in (SELECT producto FROM productos_debe WHERE debe = $debe->id )");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT cantidad FROM productos_debe WHERE debe = ? and producto = ?");

for ($a = 0; $a < count($productos); $a++) {
    
    $producto = $productos[$a];
    $sentencia->execute([$debe->id,$producto->id]);
    $cantidad = $sentencia->fetch(PDO::FETCH_OBJ);  
?>					
                                    <tr>
                                        <th><small><?php echo$producto->descripcion ?></small></th>
                                        <th><small><?php echo$cantidad->cantidad ?></small></th>
                                    </tr> 
                                   <?php  } ?>
                                </tbody>
                            </table>
                        </td>
                        <td><?php echo $deben[$i - 1]->total ?></td>
                        <td><a class="btn btn-danger" href="#" onclick="delOfDebe(<?php echo $debe->id?>)"><i class="fa fa-trash"></i></a></td>
                        <td><a class="btn btn-success" href="#"onclick="terminarVenta(<?php echo $debe->id?>)"><i class="fa fa-check"></i></a></td>
                    </tr>
                <?php } ?>
        </tbody>
      
    </table>
</div>
</div>
 <input hidden type="text" id="cantC" value="<?php echo count($deben) ?>" >

<script>
$( document ).ready(function() {
    buscarEn();
});
</script>
