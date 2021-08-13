$(document).ready(function () {
 cargarClientes();
 buscarFactura("");
    (function ($) {
 
        $('#filtrar').keyup(function () {
 
             var rex = new RegExp($(this).val(), 'i');
 
             $('.buscar tr').hide();
 
             $('.buscar tr').filter(function () {
               return rex.test($(this).text());
             }).show();
 
        })
 
    }(jQuery));
 
});

function cargarClientes(){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("clientesList").innerHTML ="";
                document.getElementById("clientesList").innerHTML = objXMLHttpRequest.responseText;
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeFiado/getClientes.php');
    objXMLHttpRequest.send();
}


 function buscarFactura(client) {
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("tFacturas").innerHTML = "";
                document.getElementById("tFacturas").innerHTML = objXMLHttpRequest.responseText;
                var name = "";
                if(client){name = client.nombre; }
                $("#NombreC").html(name+" <br><br><b> Total: "+sumaTotal()+"</b>"
                +"<button type='button' class='btn btn-primary btn-mod ml-5' onclick='PagarTodo("+client.id+");'>Pagar Todo</button>");
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeFiado/tablaFechaB.php?Cliente='+client.id);
    objXMLHttpRequest.send();

  };
  
  function sumaTotal(){
      var totalSaldo = 0;

  $("#tFacturas tr").each(function(){
     var is = $(this).find("td").eq(2);
     var val = parseFloat(is.html());
     if(val)totalSaldo =  val+ totalSaldo;
     
  });
  return totalSaldo;
  }
  
  function PagarTodo(client){
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeFiado/pagarTodo.php?id='+client);
    objXMLHttpRequest.send();
  }
  
  
  function pagarUno(id,client) {
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                buscarFactura(client);
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeFiado/pagarUno.php?id='+id);
    objXMLHttpRequest.send();

}; 