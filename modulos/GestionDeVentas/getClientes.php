<?php
include_once "../../base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM cliente;");
$clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
$data = [];
foreach ($clientes as $cliente) {
  $data += [ "$cliente->id" => $cliente->nombre ];
}
echo json_encode($data);