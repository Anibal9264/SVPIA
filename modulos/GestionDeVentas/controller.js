function buscarProducto(srt){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("productos").innerHTML = objXMLHttpRequest.responseText;
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/buscarProducto.php?buscar='+srt);
    objXMLHttpRequest.send();
}

function agregarDetalle(indice,num){

Swal.fire({
  title: 'Detalle',
  input: 'textarea',
  inputValue: document.getElementById("detalle"+indice).value,
  inputPlaceholder: 'Escriba el detalle aquí..',
  showCancelButton: true,
  confirmButtonText: 'Guardar',
  showLoaderOnConfirm: true,
  preConfirm: (detalle) => {
      var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
               Swal.fire({
                icon: 'success',
                title: 'Guardado Correctamente!',
                text: 'Los datos se guardaron correctamente!'
                });
                traercarritos(num);
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('POST', 'modulos/GestionDeVentas/agregarDetalle.php?indice='+indice+'&detalle='+detalle+'&num='+num);
    objXMLHttpRequest.send();
  },
  allowOutsideClick: () => !Swal.isLoading()
});
}

function traercarritos(num){
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("carrito").innerHTML = "";
                document.getElementById("carrito").innerHTML = objXMLHttpRequest.responseText;
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/carrito.php?num='+num);
    objXMLHttpRequest.send(); 
}


function agregarAlCarrito(id){
 var num = $("input[name='car']:checked").val();
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                traercarritos(num);
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/agregarAlCarrito.php?codigo='+id+'&num='+num);
    objXMLHttpRequest.send(); 
}


function quitarDelCarrito(id){
 var num = $("input[name='car']:checked").val();
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                traercarritos(objXMLHttpRequest.responseText);
           } else {
                traercarritos(0);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/quitarDelCarrito.php?indice='+id+'&num='+num);
    objXMLHttpRequest.send(); 
}


function cancelarVenta(num){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                traercarritos(0);
                
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/cancelarVenta.php?&num='+num);
    objXMLHttpRequest.send(); 
}

function separar(num,num2){
   var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("mBody").innerHTML = "";
                document.getElementById("mBody").innerHTML = objXMLHttpRequest.responseText;
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/traerCarrito.php?num='+num+'&num2='+num2);
    objXMLHttpRequest.send(); 
}


function pasarDeCarrito(i,id,num,num2,d){
   var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                if(d == "1"){
                    separar(num2,objXMLHttpRequest.responseText);
                }else{
                    separar(objXMLHttpRequest.responseText,num2);
                }
                
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/pasarDeCarrito.php?indice='+i+'&id='+id+'&num='+num+'&num2='+num2);
    objXMLHttpRequest.send(); 
}

function delCar(num){
   cancelarVenta(num);
   separar(0,1);
}

function moverCola(num){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                traercarritos(0);
                
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeCola/moverCola.php?&num='+num);
    objXMLHttpRequest.send(); 
}
function guardarDatosCarrito(num){
    var cliente = $("#cliente").val();
    var tClientes = $("#tClientes").val();
    
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                traercarritos(num);
                
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/GuardarDatos.php?&num='+num+'&C='+cliente+'&T='+tClientes);
    objXMLHttpRequest.send(); 
}

function traerPoC(num){
   if(num === 1){
       buscarCategorias("");
   }else{
       establecerCategoria(1);
   }
}



function buscarCategorias(srt){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("productos").innerHTML = objXMLHttpRequest.responseText;
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/buscarCategorias.php?buscar='+srt);
    objXMLHttpRequest.send();
}

function establecerCategoria(id){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                 buscarProducto("");
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/establecerCategoria.php?id='+id);
    objXMLHttpRequest.send();
}