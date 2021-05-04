<?php
$num = $_GET["num"];
$cliente = $_GET["C"];
$idcliente = $_GET["idC"];
$total = $_GET["T"];
$tPago = $_GET["TP"];
session_start();
$_SESSION["carritos"][$num][0]["cliente"] = $cliente;
$_SESSION["carritos"][$num][0]["idcliente"] = $idcliente;
$_SESSION["carritos"][$num][0]["tClientes"] = $total;
$_SESSION["carritos"][$num][0]["tPago"] = $tPago;


