<?php
$ahora = date("Y-m-d");
?>
<script src="modulos/GestionDeReportes/reportePDF.js" type="text/javascript"></script>
<br>
<div class="col-xs-12 col-sm-12 col-md-11  col-lg-4 col-xl-4">
    <div class="row justify-content-center">
        <h1 class="h4 mb-0 text-gray-800 mb-4 mt-4">REPORTES DE VENTAS</h1>
    </div>

    <div class="row justify-content-center">
        <div class="form-inline mb-5 ml-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="dia" value="1" checked onchange="reportePDF();">
                <label class="form-check-label" for="dia">DIA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="semana" value="2" onchange="reportePDF();">
                <label class="form-check-label" for="semana">SEMANA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="mes" value="3" onchange="reportePDF();">
                <label class="form-check-label" for="mes">MES</label>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group ml-5">
                <label for="desde">Desde</label>
                <input type="date" value="<?php echo $ahora ?>" class="form-control" id="desde" onchange="reportePDF();">
            </div>
            <div class="form-group ml-5">
                <label for="hasta">Hasta</label>
                <input type="date" value="<?php echo $ahora ?>" class="form-control" id="hasta" onchange="reportePDF();">
            </div>
        </div>
    </div>
</div> 

    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-8 col-xl-8">
                    
            <embed id="info" name="info" type="application/pdf" width="100%" height="530px" >                   
      
    </div>


<script>
    $(document).ready(function () {
        reportePDF();
    });
</script>



<?php include_once "pie.php"; ?>