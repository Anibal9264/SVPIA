<?php 
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
//$_SESSION["carrito"] = [];
?>     <div class="row">
<div class="col-lg-6">
    <div class="addScroll">
    <table class="table table-bordered">
			<thead>
				<tr>
			
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
                                  if($i === 0){ 
                                      $totalP = $_SESSION["carrito"][$i];
                                      $granTotal += $totalP;
                                  
                                  }else{
                                     
                                      $producto = $_SESSION["carrito"][$i]["producto"];
                                      $precioVenta = $producto->precioVenta;
                                      $cantidad = $_SESSION["carrito"][$i]["cantidad"];
                                      $totalP = $precioVenta * $cantidad;
                                      ?>
				<tr>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $cantidad?></td>
					<td><?php echo $totalP ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $i?>"><i class="fa fa-trash"></i></a></td>
				</tr>
                                <?php 
                                }} ?>
			</tbody>
		</table>

		<h3>Total: <?php echo $granTotal; ?></h3>
		<form action="./terminarVenta.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
</div>
    </div>
   
    <div class="col-lg-6">
        <br>
                 <input class="form-control" id="myInput" type="text" placeholder="Buscar..">
                 <br>
        <div class="addScroll">
       
                 
        
 <?php
     include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>       
           <?php 
           $i = 0;
           foreach($productos as $producto){ 
            ?>   
        <?php if($i==0){ ?> 
        <br>
        <div class="card-group">
        <?php }?>     
       
          <!-- Card -->
          
          <div class="card bg-light border-secondary mb-3 mx-2" style="max-width: 18rem;">
              <div class="card-header mb-0">
                  <img class="card-img-bottom" src="<?php echo $producto->img?>">
              </div>    
              <div class="card-body ">
                      <h5 class="card-title"><?php echo $producto->descripcion ?></h5>
                      <p class="card-text">₡ <?php echo $producto->precioVenta ?></p>
                      
              </div>
              <div class="card-footer">
                  <a href="agregarAlCarrito.php?codigo=<?php echo $producto->id?>" class="btn btn-primary w-100">Agregar</a>
              </div>
              </div>
         
            <br>
        <?php 
        $i++; 
        if($i==3){ ?>        
        </div>
        
        <?php
        $i=0;
        }?>  
        
       
   
                
                <?php } ?>
         </div>
        </div>
        
    </div>
    
<?php include_once "pie.php" ?>