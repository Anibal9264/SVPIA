<?php
if (!$_SESSION['Logeado']){
header ("Location: index.php?p=login");
exit;
}
include_once "base_de_datos.php";
if (isset($_REQUEST["correcto"])) {
    switch ($_REQUEST["correcto"]) {
        case "new":
            
            echo "<script>Swal.fire({ icon: 'success', title: 'Guardado Correctamente!', text: 'Los datos se guardaron correctamente!'});</script>";
            break;
        case "del":
            echo "<script>Swal.fire({ icon: 'success', title: 'Eliminado Correctamente!', text: 'Los datos se eliminaron correctamente!'});</script>";
            break;
        case "mod":
            echo "<script>Swal.fire({ icon: 'success', title: 'Modificado Correctamente!', text: 'Los datos se modificaron correctamente!'});</script>";
            break;
        case "error":
            echo "<script>Swal.fire({ icon: 'error', title: 'Error!', text: 'Ocurrio un error al guardar el cambio'});</script>";
            break;
    }
}
$sentencia = $base_de_datos->query("SELECT * FROM productos where productos.activo = 1");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
$sentencia2 = $base_de_datos->query("SELECT * FROM categoria where id != 1;"); //where id != 1
$categorias = $sentencia2->fetchAll(PDO::FETCH_OBJ);
?>
<script src="modulos/GestionDeProductos/controller.js" type="text/javascript"></script>
<div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-12">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-6 col-xl-6 card m-3">
            <h1 class="h3 mb-0 text-gray-800">Productos</h1>
            <br>
            <div>
                <a class="btn btn-success" href="#" onclick="NuevoProducto();" data-toggle='modal' data-target='#myModal'>Nuevo <i class="fa fa-plus"></i></a>
            </div> 
            
    <br>
    <input class="form-control" id="myInputP" type="text" placeholder="Search..">
    <br>
    <div class="addScroll7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><small>Imagen</small></th>
                <th><small>Descripción</small></th>
                <th><small>Precio de venta</small></th>
                <th><small>Editar</small></th>
                <th><small>Eliminar</small></th>
            </tr>
        </thead>

        <tbody id="Bproductos">



            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><img src="<?php echo $producto->img ?>" class="rounded mx-auto d-block"  width="100" height="100"></td>
                    <td><small><?php echo $producto->descripcion ?></small></td>
                    <td><small><?php echo $producto->precioVenta ?></small></td>
                    <td><a class="btn btn-warning" onclick="editarProducto(<?php echo $producto->id ?>);" 
                         data-toggle='modal' data-target='#myModal'><i class="fa fa-edit"></i></a></td>
                    <td><a class="btn btn-danger" href="<?php echo "index.php?p=delProduct&id=" . $producto->id ?>"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>

    </table> 
         </div>   
        </div>
        
        
        <div class="col card m-3">
            <h1 class="h3 mb-0 text-gray-800">Categorias</h1>
            <br>
            <div>
                <a class="btn btn-success" href="#" onclick="NuevaCategoria();" data-toggle='modal' data-target='#myModal'>Nuevo <i class="fa fa-plus"></i></a>
            </div>
             <br>
    <input class="form-control" id="myInputC" type="text" placeholder="Search..">
    <br>
     <div class="addScroll7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><small>Imagen</small></th>
                <th><small>Descripción</small></th>
                <th><small>Editar</small></th>
                <th><small>Eliminar</small></th>
            </tr>
        </thead>

        <tbody id="Bcategorias">
            <?php foreach ($categorias as $categoria) { ?>
                <tr>
                    <td><img src="<?php echo $categoria->img ?>" class="rounded mx-auto d-block" width="100" height="100"></td>
                    <td><small><?php echo $categoria->descripcion ?></small></td>
                    <td> <a class='btn btn-warning btn-mod' 
                         onclick="editarCategoria(<?php echo $categoria->id ?>);" 
                         data-toggle='modal' data-target='#myModal' >
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                      
                    <td><a class="btn btn-danger" onclick="eliminarCategoria(<?php echo $categoria->id ?>);" href="#"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>

    </table> 
        </div>
  </div>
    </div>

<!-- The Modal for Categorias -->
<div class="modal w-0" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content w-50 ml-mod2">
      <!-- Modal body -->
      <div class="modal-body" id="mBody">
       
      </div>

    </div>
  </div>
</div>   
    
</div>