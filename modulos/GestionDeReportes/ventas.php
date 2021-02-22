<script src="modulos/GestionDeReportes/controller.js" type="text/javascript"></script>

<?php
include_once "base_de_datos.php";

$sentencia = $base_de_datos->prepare("SELECT sum(total) as tDia FROM ventas WHERE DAY(fecha) = DAY(NOW())GROUP BY  DAY(fecha)");
$sentencia->execute();
$tDia = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT sum(total)as tMes FROM ventas WHERE MONTH(fecha) = MONTH(NOW())GROUP BY  MONTH(fecha)");
$sentencia->execute();
$tMes = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT sum(total)as tAnio FROM ventas WHERE YEAR(fecha) = YEAR(NOW())GROUP BY  YEAR(fecha)");
$sentencia->execute();
$tAnio = $sentencia->fetch(PDO::FETCH_OBJ);

$sql = "SELECT *,SUM(pv.cantidad) AS sumaC "
        . "FROM productos left JOIN productos_vendidos as pv "
        . "on pv.producto = id "
        . "GROUP BY id "
        . "ORDER BY sumaC DESC LIMIT 5;";
$sentencia = $base_de_datos->query($sql);
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container">
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="bModal">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<h1 class="h3 mb-0 text-gray-800">VENTAS Y ESTADISTICAS</h1>
<br>
<div class="row"> 
<div class="col-xs-12 col-sm-12 col-md-12  col-lg-8 col-xl-8">
    
    <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-4 col-sm-4 col-md-4  col-lg-4 col-xl-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body ml-4">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    TOTAL VENTAS DEL DIA</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php if($tDia){echo $tDia->tDia;}else{echo '0';} ?></div>
                            </div>
                            <div class="col-auto mr-5 mt-2">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-4 col-sm-4 col-md-4  col-lg-4 col-xl-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body ml-4">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    TOTAL VENTAS DEL MES</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php echo $tMes->tMes ?></div>
                            </div>
                            <div class="col-auto mr-5  mt-2">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4  col-lg-4 col-xl-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body ml-4">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    TOTAL VENTAS DEL AÑO</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php echo $tAnio->tAnio ?></div>
                            </div>
                            <div class="col-auto mr-4 mt-2">
                                <i class="fas fa-calendar fa-2x text-gray-300 "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
 
     <div class="row mt-5 ml-2">
      <h1 class="h4 mb-0 text-gray-800 mb-4 mt-4">BUSCAR COMPRA: </h1>
     </div>
     <div class="row ml-2">
                <div class="form-group ml-4">
                    <label for="fechaB">Filtar por fecha</label>
                    <input type="date" class="form-control" id="fechaB" onchange="buscarFactura();">
                </div>
                <button class="btn btn-primary ml-2 p-1" id="btBorar" onclick="borra();">borrar</button>     

                <div class="form-group ml-4  ">
                    <label for="numeroB">Buscar por numero</label>
                    <input class="form-control" id="numeroB" type="number" min="1" onkeyup="buscarFactura();">
                </div>
                
     </div>
    
    <div class="row">
        <div class="addScroll">
            <table class="table table-bordered table-fixed">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Fecha</th>
                        <th>Productos vendidos</th>
                        <th>Total</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody id="tFacturas">
                    
                </tbody>
            </table>
         </div>
    </div>
    
</div>

        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-4 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mas vendidos</h6>
                </div>
                <div class="card-body">

                    <?php
                    $primero = $productos[0]->sumaC ;
                    $segundo = $productos[1]->sumaC ;
                    $tercero = $productos[2]->sumaC ;
                    $cuarto = $productos[3]->sumaC ;
                    $quinto = $productos[4]->sumaC ;
                    ?>


                    <h4 class="small font-weight-bold"><?php echo $productos[0]->descripcion ?> <span class="float-right"><?php echo $primero ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success " role="progressbar" style="width: <?php echo $primero ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold"><?php echo $productos[1]->descripcion ?><span class="float-right"><?php echo $segundo ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $segundo ?>" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold"><?php echo $productos[2]->descripcion ?> <span class="float-right"><?php echo $tercero ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $tercero ?>" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold"><?php echo $productos[3]->descripcion ?> <span class="float-right"><?php echo $cuarto ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning " role="progressbar" style="width: <?php echo $cuarto ?>" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold"><?php echo $productos[4]->descripcion ?> <span class="float-right"><?php echo $quinto ?></span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $quinto ?>" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

  

   
   </div>

<script>
$( document ).ready(function() {
    buscarFactura();
});
</script>