/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function crearPDF(srt) {

 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                response = JSON.parse(objXMLHttpRequest.responseText);
                
                
var jsPDF = window.jspdf.jsPDF;
pageHeight= 280;
var doc = new jsPDF();
var imgData = response[1].logotipo;
doc.addImage(imgData, 'JPEG',20,20, 42, 42);

doc.setFont('', 'bold');
doc.setFontSize(20);
doc.text(100, 15,response[1].nombre, 'center');
doc.setFont('', 'normal');
doc.setFontSize(12);
doc.text(100, 22, '"'+response[1].subNombre+'"', 'center');
doc.setFontSize(15);
doc.text(100, 28,response[1].propietario, 'center');
doc.text(100, 34,"Cédula: "+response[1].cedula, 'center');
doc.setFontSize(13);
doc.text(100, 40, response[1].direccionExacta, 'center');
doc.text(100, 45, response[1].distrito, 'center');
doc.text(100, 50, response[1].canton+', '+response[1].provincia , 'center');
doc.text(100, 56, 'Telefono: '+response[1].telefono, 'center');
doc.text(100,62, 'Correo: '+response[1].correo, 'center');

doc.text(100, 77, 'Factura numero: '+response[0].id, 'center');
doc.setFontSize(15);
doc.text(20, 95, 'Fecha: '+response[0].fecha.substr(0,10));
doc.text(20, 102, 'Hora: '+response[0].fecha.substr(11,17));
doc.text(20, 109, 'Cliente: '+response[0].cliente);
doc.text(20, 116, 'Cantidad de personas: '+response[0].cantidadPersonas);
doc.text(20, 122, 'Tipo de pago: '+response[2].descripcion);

doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(28, 131, 'PRODUCTOS');
doc.text(85, 131, 'CANTIDAD');
doc.text(145, 131, 'TOTAL');
doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 134, 170, 134);

var y = -7;
var itens = 0;
for (var i = 3; i < response.length; i++) {
y += 7;
doc.setFontSize(13);
doc.setFont('', 'normal');
var descripcion = response[i]["producto"]["descripcion"];
itens += response[i]["cantidad"]["cantidad"];
var cantidad = response[i]["cantidad"]["cantidad"].toString();
var totalP = (parseFloat(response[i]["producto"]["precioVenta"]) * parseFloat(response[i]["cantidad"]["cantidad"])) ;

var Sp = descripcion.split(' ');
var text = "";
for (var t of Sp) {
if ((text.length+t.length)>24){
   doc.text(28, 140+y,text);// producto
   y += 5;
   text = "";
}
text +=t+" ";
}
doc.text(28, 140+y,text);// producto
doc.text(95, 140+y,cantidad);// cantidad
doc.text(145, 140+y,separar(totalP.toString()));// totalP

if (190+y >= pageHeight)
{
  doc.addPage();
  y = -125; // Restart height position
}

}


doc.line(22, 143+y, 170, 143+y);

doc.setFontSize(15);
doc.setFont('', 'bold');
doc.text(28, 150+y,'TOTAL');
doc.text(95, 150+y,itens.toString());// SUMA ITEMS
var us = parseFloat(response[0].total) / parseFloat(response[1].tipoDeCambio);
doc.text(145, 150+y,separar(response[0].total)); //total completo
doc.setLineWidth(0.7);

doc.text(139, 157+y,'$');
doc.text(145, 157+y,us.toFixed(2).toString()); 

doc.setLineWidth(0.5);
doc.setDrawColor(0,0,0);
doc.line(22, 162+y, 170, 162+y);

doc.setFontSize(13);
doc.setFont('', 'normal');
doc.text(100,170+y, 'GRACIAS POR SU COMPRA', 'center');
doc.text(100,178+y, 'VUELVA PRONTO', 'center');

$('#bModal').html("");
$('#bModal').html("<embed src='"+doc.output("datauristring")+"' id='info' name='info' frameborder='0' width='100%' height='450px'>");
   
$('#myModal2').removeClass("fade");
$('#myModal2').addClass("show");
                
                
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/traerFactura.php?buscar='+srt);
    objXMLHttpRequest.send();

};


function cerrarModal(){
   $('#myModal2').removeClass("show");
    window.location.assign("http://localhost/PVPIA2/index.php")
}

function separar(valor){
 if(valor.length < 3)return valor;
 return  valor.split("").reverse().join().replace(/,/g,"").match(/.{1,3}/g).join().split("").reverse().join("").replace(/,/g," ");
}