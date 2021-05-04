function tiempo(){
var cant =  $("#cantC").val();
var momentoActual = new Date();
var hora = momentoActual.getHours();
var minuto = momentoActual.getMinutes();
var segundo = momentoActual.getSeconds();
var hora_final = hora + ":" + minuto + ":" + segundo;
 for (var i = 1; i <= cant; i++) {
  var hora_inicio =  $("#relojP"+i).val();
 // Calcula los minutos de cada hora
  var minutos_inicio = hora_inicio.split(':')
    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
  var minutos_final = hora_final.split(':')
    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));

// Obtener la diferencia en milisegundos
var interval = minutos_final - minutos_inicio;
var segundos = interval%60;
var min = (interval)/60;
var horas = Math.floor(min/60);
var minutos = parseInt(min % 60);

    var horaImprimible = horas + " : " + minutos + " : "+segundos.toFixed();

    $("#reloj"+i).val(horaImprimible);
    
 }

  setTimeout("tiempo()",1000);  
  
    
}

function delOfCola(num){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeCola/eliminarCola.php?num='+num);
    objXMLHttpRequest.send();
}

function realizarPago(num){
   var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
               location.href = "http://localhost/PVPIA2/index.php?car="+objXMLHttpRequest.responseText; 
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeCola/realizarPago.php?num='+num);
    objXMLHttpRequest.send();
}

function buscarEn(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
}