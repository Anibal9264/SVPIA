<?php
$num = $_REQUEST["num"];
session_start();
array_splice($_SESSION["colas"],$num, 1);