<?php

$desde = $_GET["num"];
$hacia = $_GET["num2"];
session_start();
if (!isset($_SESSION["carritos"])) {
    $_SESSION["carritos"] = [];
}
 $array = array(
    "granT" => 0,
    "cliente" => "",
    "tClientes" => 1,
    "numDiario" => 0,
    "horaP" => "",
    );
if (count($_SESSION["carritos"]) == 1 || $hacia === "-1") {
    array_push($_SESSION["carritos"], []);
    $hacia = count($_SESSION["carritos"]) - 1;
     array_push($_SESSION["carritos"][$hacia],$array);
}
$cant = count($_SESSION["carritos"]) - 1;
if ((int) $hacia > $cant) {
    $hacia = $cant;
} elseif ((int) $desde > $cant) {
    $desde = $cant;
}
if ($hacia == (int) $desde) {
    $desde = 0;
}

include_once "../../base_de_datos.php";

$sentencia = $base_de_datos->query("SELECT * FROM tipoPago;");
$tiposP = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sentencia = $base_de_datos->query("SELECT tipoDeCambio FROM local;");
$tipoDC = $sentencia->fetchAll(PDO::FETCH_OBJ);


$car = $_SESSION["carritos"][$desde];
$granTotal = $car[0]["granT"];
$cliente = $car[0]["cliente"];
$tClientes = $car[0]["tClientes"];
echo "<div class='row'>
    <div class='col-5 card ml-5 mr-5'>
 <div class='btn-group btn-group-toggle' data-toggle='buttons'>";
for ($i = 0; $i < count($_SESSION["carritos"]); $i++) {
    if ($i != (int) $hacia) {
        $nummas = $i + 1;
        echo " <label class='btn btn-mod btn-secondary";
        if ($desde == $i) {
            echo " active";
        }
        echo "'>
      <input type='radio' name='car' value='$i' autocomplete='off' onchange='separar($i,$hacia)'";
        if ($desde == $i) {
            echo "checked";
        }
        echo "> $nummas </label>";
    }
}

echo "
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
               onclick='agregarDetalle($i,$desde);'>
                 $producto->descripcion 
              </button>
           
           <span class='badge badge-primary badge-pill'> $cantidad</span>
           
           <a class='btn btn-mod btn-primary p-1 mr-1'href='#' onclick='pasarDeCarrito($i,$id,$desde,$hacia,0);'>
               <i class='bi bi-arrow-right-circle-fill'></i>
           </a>
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
                          <select class='form-control col form-control-mod btn-mod' name='tipoPago' id='tipoPago'>";
     foreach ($tiposP as $tipo){
       echo " <option value='$tipo->id' ";
       if ($tipo->id == 1) { echo " selected ";}
       echo ">$tipo->descripcion</option>";
     }
    echo "</select>
                    </div>
                    <div class='form-row mt-1'>
                      <span class='input-group-text' >Cliente</span>
                     <input class='form-control col' id='cliente' name='cliente' type='text' placeholder='Cliente..' value='$cliente'>
                    </div>
                    <div class='form-row mt-1'>
                         <span class='input-group-text text-dark' >Cantidad de personas</span>
                         <input class='form-control col' id='tClientes' name='tClientes' type='number' min='1' value='$tClientes'>
                    </div>
                    
                    <div class='row justify-content-center mt-2'>
			<button type='submit' class='btn btn-mod btn-success' >Pagar</button>
                        <button type='button' class='btn btn-mod btn-secondary ml-1' >Enviar a Cola</button>
                        <a href='#' onclick='delCar($desde)' class='btn btn-mod btn-danger ml-1'>Borrar</a>
		    </div>
                    <input class='form-control hide' id='num' name='num' type='text'value='$desde'> 
                    <input class='form-control hide' id='total' name='total' type='text'value='$granTotal'> 
                </form> </div>";

// columna 2
$car2 = $_SESSION["carritos"][$hacia];
$granTotal2 = $car2[0]["granT"];
$cliente2= $car2[0]["cliente"];
$tCliente2 = $car2[0]["tClientes"];
echo "<div class='col-5 card ml-5'>
 <div class='btn-group btn-group-toggle' data-toggle='buttons'>";
for ($i = 0; $i < count($_SESSION["carritos"]); $i++) {
    if ($i != (int) $desde) {
        $nummas = $i + 1;
        echo " <label class='btn btn-mod btn-secondary";
        if ($hacia == $i) {
            echo " active";
        }
        echo "'>
      <input type='radio' name='car' value='$i' autocomplete='off' onchange='separar($desde,$i)'";
        if ($hacia == $i) {
            echo "checked";
        }
        echo "> $nummas </label>";
    }
}

echo "<label class='btn btn-mod btn-secondary'>
       <input type='radio' name='car' onchange='separar($desde,-1)' autocomplete='off'> +
       </label>
</div>

<ul class='list-group'>
        <div class='addScroll5'>";
for ($i = 1; $i < count($car2); $i++) {
        $producto = $car2[$i]["producto"];
        $precioVenta = $producto->precioVenta;
        $cantidad = $car2[$i]["cantidad"];
        $detalle = $car2[$i]["detalle"];
        $totalP = $precioVenta * $cantidad;
        $id = $producto->id;

        echo "  <li class='list-group-item d-flex justify-content-between align-items-center'>
             <a class='btn btn-mod btn-primary p-1 mr-1'href='#' onclick='pasarDeCarrito($i,$id,$hacia,$desde,1);'>
               <i class='bi bi-arrow-left-circle-fill'></i>
           </a> 
           <span class='badge badge-primary badge-pill'> $cantidad</span>
            <button type='button' class='btn btn-xs w-75 text-left text-truncate btn-light'
               onclick='agregarDetalle($i,$desde);'>
                 $producto->descripcion 
              </button>
           
           
           
           </li> 
           <input id='detalle$i' type='hidden' value='$detalle'>";
    }

$tipoC = (float)$tipoDC[0]->tipoDeCambio;
$us = $granTotal2/$tipoC;
$us = bcdiv($us,'1',2);
echo " </div>                
    </ul>       
     <h3>Total: $granTotal2 | $$us</h3>
    <form action='./index.php?p=terminarVenta' method='POST'>
      <div class='form-row mt-1'>
                         <span class='input-group-text text-dark' >Tipo de pago</span>
                          <select class='form-control col form-control-mod btn-mod' name='tipoPago' id='tipoPago'>";
     foreach ($tiposP as $tipo){
       echo " <option value='$tipo->id' ";
       if ($tipo->id == 1) { echo " selected ";}
       echo ">$tipo->descripcion</option>";
     }
    echo "</select>
                    </div>
                    <div class='form-row mt-1'>
                      <span class='input-group-text' >Cliente</span>
                     <input class='form-control col' id='cliente' name='cliente' type='text' placeholder='Cliente..' value='$cliente2'>
                    </div>
                    <div class='form-row mt-1'>
                         <span class='input-group-text text-dark' >Cantidad de personas</span>
                         <input class='form-control col' id='tClientes' name='tClientes' type='number' min='1' value='$tCliente2'>
                    </div>
                    
                    <div class='row justify-content-center mt-2'>
			<button type='submit' class='btn btn-mod btn-success' >Pagar</button>
                        <button type='button' class='btn btn-mod btn-secondary ml-1' >Enviar a Cola</button>
                        <a href='#' onclick='delCar($hacia)' class='btn btn-mod btn-danger ml-1'>Borra</a>
		    </div>
                    <input class='form-control hide' id='num' name='num' type='text'value='$hacia'> 
                    <input class='form-control hide' id='total' name='total' type='text'value='$granTotal2'> 
                </form> 
                </div>
                </div>";

