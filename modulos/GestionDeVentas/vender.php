<?php 
if (!isset($_REQUEST["car"])){
    $numcar = 0;
}else{
    $numcar = $_REQUEST["car"];
}


if(!isset($_SESSION["CoP"])){
    $_SESSION["CoP"] = 1;
}
 ?>
<script src="modulos/GestionDeVentas/controller.js" type="text/javascript"></script>
<div class="col-xs-12 col-md-12">
<div class="row">
<div class="col-xs-3 col-sm-3 col-md-3  col-lg-4 col-xl-3 card ">
    <h1 class="h4 mb-1 text-gray-800 align-self-center">VENTAS</h1>
    <div id="carrito">

    </div>
    
</div>
   
    <div class="col-xs-9 col-sm-9 col-md-9  col-lg-8 col-xl-9">
        <br>
        <div class="row">
            <div class="col">
                <input class="form-control border-info" id="buscar" type="text" placeholder="Buscar.."
                        onkeyup="buscarProducto(this.value);">
            </div>
            <div class="col">

                <button class="btn btn-mod btn-primary" name='poc' onclick='traerPoC(0);'> Productos</button>
           <button class="btn btn-mod btn-primary " name='poc' onclick='traerPoC(1);'> Categorias</button>
           
           
            </div>    
                 
            
        </div>
                
                 <div class="addScroll3" id="productos">
     
                 </div>     
   </div>
        
    </div>



<script>
$( document ).ready(function() {
      buscarProducto("");
      traercarritos(<?php echo $numcar;?>);
});
</script>

		
</div>
   
<!-- The Modal -->
<div class="modal w-0" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content w-75 ml-mod1">

      <!-- Modal Header -->
      <div class="modal-header mb-n3">
        <h4 class="modal-title">Separar Cuentas</h4>
        <button type="button" class="close" onclick="traercarritos(0);" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="mBody">
        
      </div>

    </div>
  </div>
</div>   
