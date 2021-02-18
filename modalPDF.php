<?php
include_once "encabezado.php";
$factura = $_REQUEST["factura"];
?>
<script src="CrearPDF.js" type="text/javascript"></script>

  <div class="row">
<div class="col-lg-10">
    <div class="addScroll">                
                        <embed id="info" name="info" type="application/pdf" width="100%" height="600px" >

                       
                            
    </div>
</div>
      <div class="col-2">
          <a type="button" class="btn btn-primary" data-dismiss="modal" href="./vender.php" >&nbsp;&nbsp;SALIR&nbsp;&nbsp;</a>
      </div>
      
                        
</div> 


<script>
$( document ).ready(function() {
      crearPDF(<?php echo $factura;?>);
});
</script>

<?php include_once "pie.php" ?>