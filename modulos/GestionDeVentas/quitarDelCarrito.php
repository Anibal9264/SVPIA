<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];
$num = $_GET["num"];

session_start();
  $_SESSION["carritos"][$num][0]["granT"] -=  $_SESSION["carritos"][$num][$indice]["producto"]->precioVenta;
 if($_SESSION["carritos"][$num][$indice]["cantidad"]>1){
    $_SESSION["carritos"][$num][$indice]["cantidad"]--;
    echo $num; 
 }else{
    array_splice($_SESSION["carritos"][$num], $indice, 1);
   if(count($_SESSION["carritos"][$num]) == 1){
    array_splice($_SESSION["carritos"],$num, 1);
      echo '0';
   }else {
     echo $num;  
   } 
   
}
