

<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}


include_once "base_de_datos.php";

$sentencia = $base_de_datos->prepare("SELECT sum(total) as tDia FROM ventas WHERE date(fecha) = date(NOW())GROUP BY  DAY(fecha)");
$sentencia->execute();
$tDia = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT sum(total)as tMes FROM ventas WHERE MONTH(fecha) = MONTH(NOW()) and YEAR(fecha) = YEAR(NOW()) GROUP BY  MONTH(fecha)");
$sentencia->execute();
$tMes = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->prepare("SELECT sum(total)as tAnio FROM ventas WHERE YEAR(fecha) = YEAR(NOW())GROUP BY  YEAR(fecha)");
$sentencia->execute();
$tAnio = $sentencia->fetch(PDO::FETCH_OBJ);
$ahora = date("Y-m-d");
?>
<script src="modulos/GestionDeReportes/controller.js" type="text/javascript"></script>
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
                                    VENTAS DEL DIA</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php if($tDia){echo $tDia->tDia;}else{echo '0';} ?></div>
                            </div>
                            <div class="col-auto mr-5 mt-2">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                   VENTAS DEL MES</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php if($tMes){echo $tMes->tMes;}else{echo '0';}?></div>
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
                                    VENTAS DEL AÑO</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₡<?php if($tAnio){echo $tAnio->tAnio;}else{echo '0';}?></div>
                            </div>
                            <div class="col-auto mr-5 mt-2">
                                <i class="fas fa-calendar fa-2x text-gray-300 "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
     <div class="row mt-2">
         <h1 class="h4 text-gray-800">BUSCAR COMPRA: </h1>
                <div class="form-group ml-4">
                    <label for="fechaB">Filtar por fecha</label>
                    <input type="text" class="form-control input-sm" id="fechaB" onchange="buscarFactura();">
                </div>
                    

                <div class="form-group ml-4  ">
                    <label for="numeroB">Buscar por numero</label>
                    <input class="form-control input-sm" id="numeroB" type="number" min="1" onclick="borra();" onkeyup="buscarFactura();">
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
                    <div class="row">
                    <h6 class="m-0 font-weight-bold text-primary col-4">Mas vendidos</h6>
                    <input class=" form-control input-sm col-6" type="text" id="fechaTop" onchange="ventasTop();" value="<?php echo $ahora?>">
                    </div>
                </div>
                <div class="card-body addScroll4">
                       <div class="form-inline mb-5 justify-content-center">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="dia" value="1" checked onchange="ventasTop();">
                <label class="form-check-label" for="dia">DIA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="semana" value="2" onchange="ventasTop();">
                <label class="form-check-label" for="semana">SEMANA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="mes" value="3" onchange="ventasTop();">
                <label class="form-check-label" for="mes">MES</label>
            </div>
             </div>
                    <div id="top"></div>
                    
                </div>
            </div>
        </div>
    </div>

  

   
   </div>

<script>
$( document ).ready(function() {
    cargarFechas();
    buscarFactura();
    ventasTop();
    
});
</script>