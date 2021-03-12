<?php
if (!isset($_SESSION["colas"])) {
    $colas = array();
} else {
    $colas = $_SESSION["colas"];
}
?>
<script src="modulos/GestionDeCola/controller.js" type="text/javascript"></script>
<div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-12">
    <h1 class="h3 mb-0 text-gray-800">Ordenes en Cola</h1>
    <br>
    <br>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <br>
    <div class="addScroll6">
    <table class="table table-bordered" id="TCola">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Cliente</th>
                <th>Tiempo en cola</th>
                <th>Detalle</th>
                <th>Cancelar</th>
                <th>Terminar</th>
            </tr>
        </thead>

        <tbody id="Tbody">



            <?php 
            for ($i = count($colas); $i > 0; $i--) { ?>
                <tr>
                    <td><?php echo $colas[$i - 1][0]["numDiario"] ?></td>
                    <td><?php echo $colas[$i - 1][0]["cliente"] ?></td>
                    
                    <td><input class="form-control" type="text" id="reloj<?php echo $i ?>">
                    <input hidden type="text" id="relojP<?php echo $i ?>" value="<?php echo $colas[$i - 1][0]["horaP"] ?>" >
                    </td>
                    <td>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Detalle</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>


             <?php
    $productos = $colas[$i - 1];
    for ($p=1;$p<count($productos);$p++) { 
          $producto = $productos[$p]["producto"];
        ?>					
                                    <tr>
                                        <td><small><?php echo$producto->descripcion ?></small></td>
                                        <td><small><?php echo$productos[$p]["detalle"]?></small></td>
                                        <td><small><?php echo$productos[$p]["cantidad"] ?></small></td>
                                    </tr> 
                                   <?php  } ?>
                                </tbody>
                            </table>
                        </td>
                        <td><a class="btn btn-danger" href="#" onclick="delOfCola(<?php echo $i-1?>)"><i class="fa fa-trash"></i></a></td>
                        <td><a class="btn btn-success" href="#"onclick="realizarPago(<?php echo $i-1?>)"><i class="fa fa-check"></i></a></td>
                    </tr>
                <?php } ?>
        </tbody>

    </table>
</div>
</div>
 <input hidden type="text" id="cantC" value="<?php echo count($colas) ?>" >

<script>
$( document ).ready(function() {
    buscarEn();
    tiempo();
    
});
</script>
