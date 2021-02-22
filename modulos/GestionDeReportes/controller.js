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
  
function verpdf(id){
    $('#bModal').html("");
    $('#bModal').html("<embed src='pdfs/"+id+".pdf' id='info' name='info' frameborder='0' width='100%' height='450px'>");
   
};

function borra(){
    $("#fechaB").val("");
    buscarFactura();
};


