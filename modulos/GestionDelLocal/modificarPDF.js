/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function modificarPDF() {
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                response = JSON.parse(objXMLHttpRequest.responseText);
                
for (var f = 0; f < response[0].length; f++) {
var factura = response[0][f];
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

doc.text(100, 77, 'Factura numero: '+factura.id, 'center');
doc.setFontSize(15);
doc.text(20, 95, 'Fecha: '+factura.fecha.substr(0,10));
doc.text(20, 102, 'Hora: '+factura.fecha.substr(11,17));
doc.text(20, 109, 'Cliente: '+factura.cliente);

doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(22, 125, '#');
doc.text(28, 125, 'PRODUCTOS');
doc.text(85, 125, 'CANTIDAD');
doc.text(145, 125, 'SUBTOTAL');
doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 128, 170, 128);

var y = -10;
var itens = 0;
var productos = response[2][f];
for (var i = 0; i < productos.length; i++) {
y += 10;
doc.setFontSize(13);
doc.setFont('', 'normal');
var num = (i+1).toString();
var descripcion = productos[i]["producto"]["descripcion"];
itens += productos[i]["cantidad"]["cantidad"];
var cantidad = productos[i]["cantidad"]["cantidad"].toString();
var sinImpuestos = (parseFloat(productos[i]["producto"]["precioNoImpuestos"]) * parseFloat(productos[i]["cantidad"]["cantidad"])) ;
doc.text(22, 135+y,num);//numero
doc.text(28, 135+y,descripcion);// producto
doc.text(95, 135+y,cantidad);// cantidad
doc.text(145, 135+y,sinImpuestos.toString());// Subtotal

if (190+y >= pageHeight)
{
  doc.addPage();
  y = -125; // Restart height position
}

}


doc.line(22, 140+y, 170, 140+y);
doc.text(22, 150+y,'ITEMS:');
doc.text(40, 150+y,itens.toString());// SUMA ITEMS
doc.text(85, 150+y,'SUB TOTAL');
doc.setFont('', 'bold');
doc.text(145, 150+y,factura.totalsinImpuestos); //total sin impuestos

doc.setFont('', 'normal');
doc.text(85, 160+y,'IVA');
doc.setFont('', 'bold');
doc.text(145, 160+y,factura.totalimpuestos); //total sin impuestos
doc.setLineWidth(0.5);
doc.setDrawColor(0,0,0);
doc.line(85, 163+y, 170, 163+y);


doc.setFontSize(15);
doc.text(22, 172+y,'TOTAL A PAGAR');
doc.text(145, 172+y,factura.total); //total completo
doc.setLineWidth(0.7);


doc.line(22, 182+y, 170, 182+y);

doc.setFontSize(13);
doc.setFont('', 'normal');
doc.text(100,220+y, 'GRACIAS POR TU COMPRA', 'center');
doc.text(100,228+y, 'VUELVA PRONTO', 'center');

var pdf = doc.output('blob');
var data = new FormData();
data.append('data' , pdf);
guardarPDF(data,factura.id);  
}

swal("Facturas Modificadas!", "Las fecturas se modificarion correctamente!", "success");
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDelLocal/traerFactura.php');
    objXMLHttpRequest.send();

};

function guardarPDF(srt,num){
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                
                 } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('POST','modulos/GestionDelLocal/upload.php?num='+num,true);
    objXMLHttpRequest.send(srt);
}