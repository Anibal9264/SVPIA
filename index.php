
<html lang="es">
    <head>
         <?php include_once 'head.php';?>
    </head>
   
    <body>
    <header>
        <?php include_once 'header.php';?>
    </header>
        <?php
       if(!isset($_REQUEST["p"])){
           include_once 'modulos/GestionDeVentas/vender.php';
       }else{
        switch($_GET["p"]){
            //Gestion de productos
            case'productos':include_once 'modulos/GestionDeProductos/listar.php';break;
            case'formProduct':include_once 'modulos/GestionDeProductos/formulario.php';break;
            case'editProduct':include_once 'modulos/GestionDeProductos/editar.php';break;
            case'delProduct':include_once 'modulos/GestionDeProductos/eliminar.php';break;
            case'newProduct':include_once 'modulos/GestionDeProductos/nuevo.php';break;
            case'changeProduct':include_once 'modulos/GestionDeProductos/guardarDatosEditados.php';break;
            //Gestion de Ingresos
            case'ingresos':include_once 'modulos/GestionDeIngresos/ingresos.php';break;
            case'editIngreso':include_once 'modulos/GestionDeIngresos/editarIngreso.php';break;
            case'delIngreso':include_once 'modulos/GestionDeIngresos/eliminarIngreso.php';break;
            case'newIngreso':include_once 'modulos/GestionDeIngresos/nuevoIngreso.php';break;
            case'changeIngresos':include_once 'modulos/GestionDeIngresos/guardarCambiosIngresos.php';break;
            //Gestion de ventas
//            case'quitarDelCarrito':include_once 'modulos/GestionDeVentas/quitarDelCarrito.php';break; 
//            case'agregarAlCarrito':include_once 'modulos/GestionDeVentas/agregarAlCarrito.php';break; 
//            case'cancelVenta':include_once 'modulos/GestionDeVentas/cancelarVenta.php';break; 
            case'terminarVenta':include_once 'modulos/GestionDeVentas/terminarVenta.php';break;
            case'modalPDF':include_once 'modulos/GestionDeVentas/modalPDF.php';break;
            //Gestion de ventas
            case'ventas':include_once 'modulos/GestionDeReportes/ventas.php';break;
            //Gestion del local
            case'local':include_once 'modulos/GestionDelLocal/formularioLocal.php';break;
            case'changeLocal':include_once 'modulos/GestionDelLocal/guardarLocal.php';break;
            //Gestion de reportes
            case'reportes':include_once 'modulos/GestionDeReportes/reportes.php';break;
             //Gestion de cola
            case'cola':include_once 'modulos/GestionDeCola/view.php';break;
            //Gestion de Categoria
            case'newCategoria':include_once 'modulos/GestionDeProductos/newCategoria.php';break;
            case'editarCategoria':include_once 'modulos/GestionDeProductos/editarCategoria.php';break;
            // login
            case'login':include_once 'modulos/Login/view.php';break;
            case'logear':include_once 'modulos/Login/logear.php';break;
            case'salir':include_once 'modulos/Login/salir.php';break;
       }
       
        }
        
        ;?>
    </body>
</html>
