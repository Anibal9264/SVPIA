<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM ingresos ORDER BY fecha DESC LIMIT 20;");
$ingresos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		 <h1 class="h3 mb-0 text-gray-800">INGRESOS</h1>
    <br>
		<div>
			<a class="btn btn-success" href="./formularioIngreso.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>
		
                 <br>
                 <table class="table table-bordered" id="TIngresos">
			<thead>
				<tr>
					<th>ID</th>
                                        <th>FECHA</th>
					<th>PRODUCTO</th>
					<th>MONTO</th>
					<th>PROVEEDOR</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
                       
			<tbody id="BIngresos">
                            
     
        
				<?php foreach($ingresos as $ingreso){ ?>
				<tr>
					<td><?php echo $ingreso->id?></td>
                                        <td><?php echo $ingreso->fecha?></td>
                                        <td><?php echo $ingreso->producto?></td>
					<td><?php echo $ingreso->monto ?></td>
					<td><?php echo $ingreso->proveedor?></td>
					<td><a class="btn btn-warning" href="<?php echo "editarIngreso.php?id=" . $ingreso->id?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarIngreso.php?id=" . $ingreso->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
                         
		</table>
	</div>
<?php include_once "pie.php" ?>
