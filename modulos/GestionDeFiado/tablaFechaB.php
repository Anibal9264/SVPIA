<?php
session_start();
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
$buscar = $_GET["Cliente"]?:"null";
include_once "../../base_de_datos.php";

$sentencia1 = $base_de_datos->query("SELECT * FROM cliente WHERE id = '$buscar';");
$cliente = $sentencia1->fetch(PDO::FETCH_OBJ);
$dato = json_encode($cliente);
$sentencia = $base_de_datos->query("SELECT * FROM ventas "
        . "where tipoPago = 4 and cliente='$buscar'");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);




foreach($ventas as $venta){
    echo "<tr>
                                    <td>$venta->id</td>
                                        <td>$venta->fecha</td>
                                      <td>$venta->total</td>
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
					<td><a class='btn btn-light' data-toggle='modal' data-target='#myModal' onclick='crearPDF($venta->id);'><i class='fa fa-file-pdf'></i></a></td>
				        <td><a class='btn btn-light' onclick='pagarUno($venta->id,$dato);'><i class='fa fa-check-square'></i></a></td>
</tr>";
				 } 
