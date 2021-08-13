<?php
$num = $_GET["num"];
$is = false;
session_start();
//unset($_SESSION["carritos"]);
if(!isset($_SESSION["carritos"])){
    $_SESSION["carritos"] = [];
}
 $array = array(
    "granT" => 0,
    "cliente" => "",
    "tClientes" => 1,
    "numDiario" => 0,
    "horaP" => "",
    "idCliente"=>"null",
    "tipoPago"=>1,
    );
if(count($_SESSION["carritos"])<1){ 
   array_push($_SESSION["carritos"],[]);
   array_push($_SESSION["carritos"][0],$array);
}
if($num === "-1"){
    array_push($_SESSION["carritos"],[]);
    $num = count($_SESSION["carritos"])-1;
    array_push($_SESSION["carritos"][$num],$array);
    $is = true;
}
$num2 = 1;
if((int)$num>0){
    $num2 = 0;
}
include_once "../../base_de_datos.php";

$sentencia = $base_de_datos->query("SELECT * FROM tipoPago;");
$tiposP = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->query("SELECT tipoDeCambio FROM local;");
$tipoDC = $sentencia->fetchAll(PDO::FETCH_OBJ);

$car = $_SESSION["carritos"][$num];
$granTotal = $car[0]["granT"];
$cliente = $car[0]["cliente"];
$idC = $car[0]["idCliente"];
$tClientes = $car[0]["tClientes"];
$tipoPago = $car[0]["tipoPago"];
echo "<div class='row ml-1'>
 <button type='button' class='btn btn-xs btn-mod btn-success w-100 mb-1 mr-3' 
 onclick='separarC($num,$num2);' data-toggle='modal' data-target='#myModal' >Separa Cuentas</button>
 </div>
 <div class='btn-group btn-group-toggle' data-toggle='buttons'>";
 for ($i = 0; $i < count($_SESSION["carritos"]); $i++) {
    
     $nummas =  $i+1;
     echo " <label class='btn btn-mod btn-secondary";
     if($num == $i){echo " active";}
     echo "'>
      <input type='radio' name='car' value='$i' autocomplete='off' onchange='traercarritos($i)'";
      if($num == $i){echo "checked";}
      echo "> $nummas </label>";
 }
 echo "<label class='btn btn-mod btn-secondary'>
       <input type='radio' name='car' onchange='traercarritos(-1)' autocomplete='off'> +
       </label>
</div>

<ul class='list-group'>
        <div class='addScroll5'>";
for ($i = 1; $i < count($car); $i++) {

                                      $producto = $car[$i]["producto"];
                                      $precioVenta = $producto->precioVenta;
                                      $cantidad = $car[$i]["cantidad"];
                                      $detalle = $car[$i]["detalle"];
                                      $totalP = $precioVenta * $cantidad;
                                      $id = $producto->id;

    echo "  <li class='list-group-item d-flex justify-content-between align-items-center'>
              <button type='button' class='btn btn-xs w-75 text-left text-truncate btn-light'
               onclick='agregarDetalle($i,$num);'>
                 $producto->descripcion 
              </button>
           <a class='btn btn-light p-1 mr-1'href='#' onclick='quitarDelCarrito($i);'>-</a>
           <span class='badge badge-primary badge-pill'> $cantidad</span>
           <a class='btn btn-light p-1 ml-1 mr-1'href='#' onclick='agregarAlCarrito($producto->id);' >+</a>
           <span class='badge badge-primary badge-pill'> ¢$totalP</span>
           </li> 
           <input id='detalle$i' type='hidden' value='$detalle'>";
}
$tipoC = (float)$tipoDC[0]->tipoDeCambio;
$us = $granTotal/$tipoC;
$us = bcdiv($us,'1',2);
 echo " </div>                
    </ul>       
    <h3>Total: ¢$granTotal | $$us</h3>
    <form action='./index.php?p=terminarVenta' method='POST'>
    <div class='form-row mt-1'>
                         <span class='input-group-text text-dark' >Tipo de pago</span>
                          <select class='form-control col form-control-mod btn-mod' onchange='guardarDatosCarrito($num);' name='tipoPago' id='tipoPago'>";
     foreach ($tiposP as $tipo){
       echo " <option value='$tipo->id' ";
       if ($tipo->id == $tipoPago) { echo " selected ";}
       echo ">$tipo->descripcion</option>";
     }
    echo "</select>
                    </div>
                    <div class='form-row mt-1 md-form'>
                    
                     <span class='input-group-text text-dark' >Cliente</span>
                     <input class='form-control' id='clienteID' name='clienteID' hidden value='$idC' ></input>
                     <input class='form-control col btn-mod'id='clienteN' onclick='cargarClientes()' name='clienteN' type='text'data-toggle='modal' data-target='#myModal3' readonly value='$cliente'>
                    
</div>
                    <div class='form-row mt-1'>
                         <span class='input-group-text text-dark' >Cantidad de personas</span>
                         <input class='form-control col btn-mod' onchange='guardarDatosCarrito($num);' id='tClientes' name='tClientes' type='number' min='1' value='$tClientes'>
                    </div>
                    <div class='row justify-content-center mt-2'>
			<button type='submit' class='btn btn-mod btn-success' >Pagar</button>
                        <button type='button' class='btn btn-mod btn-secondary ml-1' onclick='moverCola($num)' >Enviar a Cola</button>
                        <a href='#' onclick='cancelarVenta($num)' class='btn btn-mod btn-danger ml-1'>Borrar</a>
		    </div>
                    <input class='form-control hide' id='num' name='num' type='text'value='$num'> 
                    <input class='form-control hide' id='total' name='total' type='text'value='$granTotal'> 
                </form> ";
