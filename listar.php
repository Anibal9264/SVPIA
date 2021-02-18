<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		 <h1 class="h3 mb-0 text-gray-800">PRODUCTOS</h1>
    <br>
		<div>
			<a class="btn btn-success" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>
		<br>
                 <input class="form-control" id="myInput" type="text" placeholder="Search..">
                 <br>
                 <table class="table table-bordered" id="Tproductos">
			<thead>
				<tr>
					<th>ID</th>
                                        <th>Imagen</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Precio sin Impuesto</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
                       
			<tbody id="Bproductos">
                            
     
        
				<?php foreach($productos as $producto){ ?>
				<tr>
					<td><?php echo $producto->id ?></td>
                                        <td><img src="<?php echo $producto->img?>" class="rounded mx-auto d-block" width="100" height="100"></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->precioNoImpuestos?></td>
					<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $producto->id?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $producto->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
                         
		</table>
	</div>
<?php include_once "pie.php" ?>