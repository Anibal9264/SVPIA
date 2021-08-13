<?php

include_once "../../base_de_datos.php";
$sql = "SELECT * FROM cliente ORDER BY cliente.id DESC;";
$sentencia = $base_de_datos->query($sql);
$clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
foreach ($clientes as $cliente) {
    $dato = json_encode($cliente);
    echo "<tr onclick='selecionarClientes($dato)'><th>$cliente->nombre</th><th>$cliente->telefono</th></tr>";
}
