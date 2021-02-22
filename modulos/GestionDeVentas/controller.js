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


