function delOfDebe(num){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDebe/eliminar.php?num='+num);
    objXMLHttpRequest.send();
}

function terminarVenta(num){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDebe/realizarPago.php?num='+num);
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

