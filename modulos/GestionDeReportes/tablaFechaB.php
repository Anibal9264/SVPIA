<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
$numero = "";
$fecha = "";
$numero = $_GET["numero"];
$fecha = $_GET["fecha"];
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM ventas "
        . "where fecha like '%$fecha%' and id like '%$numero%'"
        . "order by fecha desc limit 15");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);




foreach($ventas as $venta){
    echo "<tr>
                                    <td>$venta->id</td>
                                        <td>$venta->fecha</td>
					<td>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>";
    
$sentencia = $base_de_datos->query("SELECT * FROM productos where id in(select producto from productos_vendidos where factura = $venta->id)");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);    
 foreach($productos as $producto){					
                        echo "  <tr>
				   <td> $producto->descripcion</td>";
    $sentencia = $base_de_datos->prepare("select cantidad from productos_vendidos where producto = $producto->id and factura = $venta->id");
$sentencia->execute();
$cantidad = $sentencia->fetch(PDO::FETCH_OBJ);
                                echo "<td>$cantidad->cantidad</td>
				</tr> ";
} 
			echo "</tbody>
						</table>
					</td>
					<td>$venta->total</td>
					<td><a class='btn btn-light' data-toggle='modal' data-target='#myModal' onclick='crearPDF($venta->id);'><i class='fa fa-file-pdf'></i></a></td>
				        <td><a class='btn btn-light' onclick='eliminarVenta($venta->id);'><i class='fa fa-trash'></i></a></td>
</tr>";
				 } 
