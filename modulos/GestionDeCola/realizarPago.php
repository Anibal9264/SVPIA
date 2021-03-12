<?php
$num = $_REQUEST["num"];
session_start();
if (!isset($_SESSION["colas"])) {
    exit;
}
$cuenta = $_SESSION["colas"][$num];
array_push($_SESSION["carritos"],$cuenta);
array_splice($_SESSION["colas"],$num, 1);

echo count($_SESSION["carritos"])-1;

