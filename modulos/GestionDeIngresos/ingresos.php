<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
include_once "base_de_datos.php";
if(isset($_REQUEST["correcto"])){
    switch ($_REQUEST["correcto"]){
        case "new":
            echo "<script>Swal.fire({ icon: 'success', title: 'Guardado Correctamente!', text: 'Los datos se guardaron correctamente!',})</script>'";
        break;
        case "del":
            echo "<script>Swal.fire({ icon: 'success', title: 'Eliminado Correctamente!', text: 'Los datos se eliminaron correctamente!',})</script>'";
        break;
        case "mod":
            echo "<script>Swal.fire({ icon: 'success',title: 'Modificado Correctamente!', text: 'Los datos se modificaron correctamente!',})</script>'";
        break;
         case "error":
            echo "<script>Swal.fire({ icon: 'error', title: 'Error!', text: 'Ocurrio un error al guardar el cambio'});</script>";
        break;
    }
    
}
$sentencia = $base_de_datos->query("SELECT * FROM ingresos ORDER BY fecha DESC LIMIT 20;");
$ingresos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<script src="modulos/GestionDeIngresos/controller.js" type="text/javascript"></script>
	 <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-12 card">
		 <h1 class="h3 mb-0 text-gray-800">COMPRAS</h1>
    <br>
		<div>
                    <a class="btn btn-success" href="#" onclick="NuevoGasto();" data-toggle='modal' data-target='#myModal'>Nuevo <i class="fa fa-plus"></i></a>
            </div> 
		
                 <br>
                 <table class="table table-bordered card" id="TIngresos">
			<thead>
				<tr>
					<th>FACTURA Nº</th>
                                        <th>FECHA</th>
					<th>PRODUCTO</th>
					<th>MONTO</th>
					<th>PROVEEDOR</th>
                                        <th>ARCHIVO</th>
					<th>EDITAR</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
                       
			<tbody id="BIngresos">
                            
     
        
				<?php foreach($ingresos as $ingreso){ ?>
				<tr>
					<td><?php echo $ingreso->facturaNumero?></td>
                                        <td><?php echo $ingreso->fecha?></td>
                                        <td><?php echo $ingreso->producto?></td>
					<td><?php echo $ingreso->monto ?></td>
					<td><?php echo $ingreso->proveedor?></td>
                                        <td><?php if($ingreso->archivo){
                                            echo " <a class='btn btn-success' href='modulos/GestionDeIngresos/descargarArchivo.php?A=".$ingreso->archivo."'><i class='fa fa-file-excel'></i></a>";
                                          }?>
                                        </td>
                                        <td><a class="btn btn-warning" href="#" onclick="editarGasto(<?php echo $ingreso->id?>);" data-toggle='modal' data-target='#myModal'><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "index.php?p=delIngreso&id=" . $ingreso->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>


<!-- The Modal for gastos -->
<div class="modal w-0" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content w-50 ml-mod2">
      <!-- Modal body -->
      <div class="modal-body" id="mBody">
       
      </div>

    </div>
  </div>
</div>
