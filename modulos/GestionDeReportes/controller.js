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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeReportes/tablaFechaB.php?fecha='+fech+'&numero='+num);
    objXMLHttpRequest.send();

  };

function borra(){
    $("#fechaB").val("");
    buscarFactura();
};


function ventasTop() {
    var fecha = $("#fechaTop").val();
    var tipo = $("input[name='tipo']:checked").val();
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                document.getElementById("top").innerHTML = "";
                document.getElementById("top").innerHTML = objXMLHttpRequest.responseText;
           } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeReportes/getTop.php?cod='+tipo+"&fecha="+fecha);
    objXMLHttpRequest.send();

}; 


function cargarFechas(){
    $( "#fechaTop" ).datepicker({
      dateFormat: 'yy-mm-dd'
});
    $( "#fechaB" ).datepicker({
      dateFormat: 'yy-mm-dd'
});
}


function eliminarVenta(id) {
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
    objXMLHttpRequest.open('GET', 'modulos/GestionDeReportes/eliminarVenta.php?id='+id);
    objXMLHttpRequest.send();

}; 