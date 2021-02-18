<?php
include_once "encabezado.php";
$ahora = date("Y-m-d");
?>
<script src="reportePDF.js" type="text/javascript"></script>
<br>
<div class="row">
    <div class="col-3">
        <h1 class="h4 mb-0 text-gray-800 mb-4 mt-4">REPORTES DE VENTAS</h1>

        <div class="row ml-5">
            <div class="form-group">
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
            <div class="form-group">
                <label for="desde">Desde</label>
                <input type="date" value="<?php echo $ahora ?>" class="form-control" id="desde" onchange="reportePDF();">
            </div>
            <div class="form-group">
                <label for="hasta">Hasta</label>
                <input type="date" value="<?php echo $ahora ?>" class="form-control" id="hasta" onchange="reportePDF();">
            </div>
        </div>
        <br>
    </div>
    <div class="col-9">
        <div class="addScroll">                
            <embed id="info" name="info" type="application/pdf" width="100%" height="500px" >                   
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        reportePDF();
    });
</script>



<?php include_once "pie.php"; ?>