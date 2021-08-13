<?php
$num = $_GET["num"];
$cliente = $_GET["C"];
$total = $_GET["T"];
$id = $_GET["id"];
$tp = $_GET["tp"];
session_start();
$_SESSION["carritos"][$num][0]["cliente"] = $cliente;
$_SESSION["carritos"][$num][0]["tClientes"] = $total;
$_SESSION["carritos"][$num][0]["idCliente"] = $id;
$_SESSION["carritos"][$num][0]["tipoPago"] = $tp;


