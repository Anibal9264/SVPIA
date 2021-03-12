<?php

if(!isset($_REQUEST["indice"])) return;
$indice = $_REQUEST["indice"];
$detalle = $_REQUEST["detalle"];
$num = $_REQUEST["num"];
session_start();
$_SESSION["carritos"][$num][$indice]["detalle"] = $detalle;
$paso = $detalle;
