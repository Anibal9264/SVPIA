<?php ?>
<div class="container">
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" id="bModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <h1 class="h3 mb-0 text-gray-800">FIADOS</h1>
    <br>


    <div class="row mt-2">

        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-4 col-xl-4 mr-5">
            <div class="row"> 
                <div class="input-group">
                    <span class="input-group-addon">Buscar</span>
                    <input id="filtrar" type="text" class="form-control" placeholder="Ingresa la canción de este Disco que deseas Buscar...">
                </div>
                <div class="addScroll4 w-100 mt-4 card">
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
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-7 col-xl-7"> 
            <div class="row">
                <div class="input-group">

                </div>
                <div class="card">
                    <h4 class="card-header" id="NombreC"></h4>
                    <div class="addScroll card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Productos vendidos</th>
                                    <th>Ver</th>
                                    <th>Pagar</th>
                                </tr>
                            </thead>
                            <tbody id="tFacturas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="modulos/GestionDeFiado/controller.js" type="text/javascript"></script>
<script src="modulos/GestionDeFiado/CrearPDF.js" type="text/javascript"></script>