function cambiarChech(){
    if( $('#cambiar').prop('checked') ) {
    $('#cargarimg').html("<br> <input type='file' name='archivo' required >");
     }else{
          $('#cargarimg').html("");
     }
}

$(document).ready(function(){
  $("#myInputP").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Bproductos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  $("#myInputC").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Bcategorias tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  
});


function NuevaCategoria(){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeProductos/FormularioCategoria.php?tipo=0');
    objXMLHttpRequest.send(); 
}

function editarCategoria(id){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeProductos/FormularioCategoria.php?id='+id+'&tipo=1');
    objXMLHttpRequest.send(); 
}



function eliminarCategoria(id){
   var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                 location.reload();
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeProductos/eliminarCategoria.php?id='+id);
    objXMLHttpRequest.send();   
}


function NuevoProducto(){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeProductos/formulario.php');
    objXMLHttpRequest.send(); 
}


function editarProducto(id){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeProductos/editar.php?id='+id);
    objXMLHttpRequest.send(); 
}

