<?php
$num = $_GET["num"];
$cliente = $_GET["C"];
$total = $_GET["T"];
session_start();
$_SESSION["carritos"][$num][0]["cliente"] = $cliente;
$_SESSION["carritos"][$num][0]["tClientes"] = $total;


