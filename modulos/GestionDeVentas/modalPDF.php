<?php $factura = $_REQUEST["factura"];?>
<script src="modulos/GestionDeVentas/CrearPDF.js" type="text/javascript"></script>
<div class="row">
    <div class="col-1"></div>
<div class="col-xs-12 col-sm-12 col-md-12  col-lg-8 col-xl-8 mt-2">
    <div class="addScroll2">                
                        <embed id="info" name="info" type="application/pdf" width="100%" height="600px" >               
    </div>
</div>
     <div class="col-xs-12 col-sm-12 col-md-12  col-lg-3 col-xl-3 mt-5">
          <a type="button" class="btn btn-primary w-50" data-dismiss="modal" href="./index.php" >&nbsp;&nbsp;SALIR&nbsp;&nbsp;</a>
      </div>
      
                        
</div> 


<script>
$( document ).ready(function() {
      crearPDF(<?php echo $factura;?>);
});
</script>
