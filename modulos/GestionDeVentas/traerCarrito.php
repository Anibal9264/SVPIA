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
    "idcliente" => "",
    "tClientes" => 1,
    "tPago" => 1,
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

$car = $_SESSION["carritos"][$desde];
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
      <input type='radio' name='car' value='$i' autocomplete='off' onchange='separarC($i,$hacia)'";
        if ($desde == $i) {
            echo "checked";
        }
        echo "> $nummas </label>";
    }
}

echo "
</div>

<ul class='list-group'>
        <div class='addScroll6'>";
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

echo " </div>                
    </ul> </div>";

// columna 2
$car2 = $_SESSION["carritos"][$hacia];

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
      <input type='radio' name='car' value='$i' autocomplete='off' onchange='separarC($desde,$i)'";
        if ($hacia == $i) {
            echo "checked";
        }
        echo "> $nummas </label>";
    }
}

echo "<label class='btn btn-mod btn-secondary'>
       <input type='radio' name='car' onchange='separarC($desde,-1)' autocomplete='off'> +
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

echo " </div> </ul> </div> </div>";

