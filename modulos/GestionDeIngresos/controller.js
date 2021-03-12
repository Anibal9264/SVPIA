function cargarFechas(){
    $( "#fecha" ).datepicker({
      dateFormat: 'yy-mm-dd'
});
}

function NuevoGasto(){
     var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("mBody").innerHTML = "";
                document.getElementById("mBody").innerHTML = objXMLHttpRequest.responseText;
                cargarFechas(); 
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeIngresos/formularioIngreso.php');
    objXMLHttpRequest.send(); 
}

function cambiarChech(){
    if( $('#cambiar').prop('checked') ) {
    $('#cargarimg').html("<br> <input type='file' name='archivo' required >");
     }else{
          $('#cargarimg').html("");
     }
}


function editarGasto(id){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeIngresos/editarIngreso.php?id='+id);
    objXMLHttpRequest.send(); 
}


