<?php
if (!isset($_REQUEST["car"])) {
    $numcar = 0;
} else {
    $numcar = $_REQUEST["car"];
}



if (!isset($_SESSION["CoP"])) {
    $_SESSION["CoP"] = 1;
}
?>
<script src="modulos/GestionDeVentas/controller.js" type="text/javascript"></script>
<script src="modulos/GestionDeVentas/CrearPDF.js" type="text/javascript"></script>
<div class="col-xs-12 col-md-12">
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3  col-lg-4 col-xl-3 card mt-1">
            <h1 class="h4 mb-1 text-gray-800 align-self-center">VENTAS</h1>
            <div id="carrito">

            </div>

        </div>

        <div class="col-xs-9 col-sm-9 col-md-9  col-lg-8 col-xl-9 card">
            <br>
            <div class="row">
                <div class="col">
                    <input class="form-control border-info" id="buscar" type="text" placeholder="Buscar.."
                           onkeyup="buscarProducto(this.value);">
                </div>
                <div class="col">

                    <button class="btn btn-mod btn-primary" name='poc' onclick='traerPoC(0);'> Productos</button>
                    <button class="btn btn-mod btn-primary " name='poc' onclick='traerPoC(1);'> Categorias</button>


                </div>    


            </div>

            <div class="addScroll3" id="productos">

            </div>     
        </div>

    </div>



    <script>
        $(document).ready(function () {
            buscarProducto("");
            traercarritos(<?php echo $numcar; ?>);
        });
    </script>

    <?php
    if (isset($_REQUEST["factura"])) {
        $factura = $_REQUEST["factura"];
        echo "<script  type='text/javascript'> crearPDF($factura); </script> ";
    }
    ?>		
</div>

<!-- The Modal -->
<div class="modal w-0" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content w-75 ml-mod1">

            <!-- Modal Header -->
            <div class="modal-header mb-n3">
                <h4 class="modal-title">Separar Cuentas</h4>
                <button type="button" class="close" onclick="traercarritos(0);" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="mBody">

            </div>

        </div>
    </div>
</div>  

<div id="myModal2"  name="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content w-75 fixCenter">
            <div class="modal-body" id="bModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="cerrarModal();" >Close</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal3"  name="myModal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="cModal">
                <h2>Clientes</h2>
                <div class="row">
                    <div class="col ml-5">
                        <div class="row">
                            <label>Agregar nuevo clientes</label>
                        </div>
                        <form class="form" action="#">
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="NombreC" class="form-control" placeholder="Nombre" required>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" placeholder="Telefono" id="Telefono" min="10000000" max="99999999"required>
                                </div>
                                <div class="col">
                                    <button class="btn btn-default" onclick="newCliente();">Crear</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon">Buscar</span>
                        <input id="filtrar" type="text" class="form-control" placeholder="Ingresa la canción de este Disco que deseas Buscar...">
                    </div>
                    <div class="addScroll w-100">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody class="buscar" id="clientesList">
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="cerrarModal3();" >Close</button>
            </div>
        </div>
    </div>
</div>