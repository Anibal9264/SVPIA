
//busqueda tabla productos
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Bproductos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
});

function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL();
  return dataURL;
}

function cambiarChech(){
    if( $('#cambiar').prop('checked') ) {
    $('#cargarimg').html("<br> <input type='file' name='archivo' required >");
     }else{
          $('#cargarimg').html("");
     }
}

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
    objXMLHttpRequest.open('GET', 'buscarProducto.php?buscar='+srt);
    objXMLHttpRequest.send();
}

 function buscarFactura() {
    var num = $("#numeroB").val().toLowerCase();
    var fech = $("#fechaB").val().toLowerCase();
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("tFacturas").innerHTML = "";
                document.getElementById("tFacturas").innerHTML = objXMLHttpRequest.responseText;
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'tablaFechaB.php?fecha='+fech+'&numero='+num);
    objXMLHttpRequest.send();

  };

function borra(){
    $("#fechaB").val("");
    buscarFactura();
};

function verpdf(id){
    $('#bModal').html("");
    $('#bModal').html("<embed src='pdfs/"+id+".pdf' id='info' name='info' frameborder='0' width='100%' height='450px'>");
   
}