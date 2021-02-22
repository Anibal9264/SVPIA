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
doc.setFont('', 'bold');
doc.setFontSize(20);
doc.text(100, 20,response[1].nombre, 'center');
doc.setFont('', 'normal');
doc.setFontSize(12);
doc.text(100, 27, response[1].subNombre, 'center');
doc.setFontSize(15);
doc.text(100, 37, response[1].distrito, 'center');
doc.setFontSize(15);
doc.text(100, 47, response[1].canton+', '+response[1].provincia , 'center');
doc.setFontSize(13);
doc.text(100, 57, 'Telefono: '+response[1].telefono, 'center');
doc.setFontSize(13);
doc.text(100, 67, 'Correo: '+response[1].correo, 'center');
doc.setFontSize(15);
doc.text(100, 77, 'Factura numero: '+response[0].id, 'center');
doc.setFontSize(15);
doc.text(20, 95, 'Fecha: '+response[0].fecha.substr(0,10));
doc.text(20, 102, 'Hora: '+response[0].fecha.substr(11,17));
doc.text(20, 109, 'Cliente: '+response[0].cliente);

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
for (var i = 2; i < response.length; i++) {
y += 10;
doc.setFontSize(13);
doc.setFont('', 'normal');
var num = (i-1).toString();
var descripcion = response[i]["producto"]["descripcion"];
itens += response[i]["cantidad"]["cantidad"];
var cantidad = response[i]["cantidad"]["cantidad"].toString();
var sinImpuestos = (parseFloat(response[i]["producto"]["precioNoImpuestos"]) * parseFloat(response[i]["cantidad"]["cantidad"])) ;
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
doc.text(145, 150+y,response[0].totalsinImpuestos); //total sin impuestos

doc.setFont('', 'normal');
doc.text(85, 160+y,'IVA');
doc.setFont('', 'bold');
doc.text(145, 160+y,response[0].totalimpuestos); //total sin impuestos
doc.setLineWidth(0.5);
doc.setDrawColor(0,0,0);
doc.line(85, 163+y, 170, 163+y);


doc.setFontSize(15);
doc.text(22, 172+y,'TOTAL A PAGAR');
doc.text(145, 172+y,response[0].total); //total completo
//doc.text(22, 182+y,'PAGADO (EFECTIVO)');
//doc.text(145, 182+y,'4000');//total completo
//doc.text(22, 192+y,'VUELTO');
//doc.text(145, 192+y,'0'); //total completo
doc.setLineWidth(0.7);


doc.line(22, 182+y, 170, 182+y);

doc.setFontSize(13);
doc.setFont('', 'normal');
doc.text(100,220+y, 'GRACIAS POR TU COMPRA', 'center');
doc.text(100,228+y, 'VUELVA PRONTO', 'center');

var pdf = doc.output('blob');
var data = new FormData();
data.append('data' , pdf);
guardarPDF(data,response[0].id);  
  


           
$('#info').attr('src', doc.output("datauristring"));


                
                
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeVentas/traerFactura.php?buscar='+srt);
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
    objXMLHttpRequest.open('POST','modulos/GestionDeVentas/upload.php?num='+num,true);
    objXMLHttpRequest.send(srt);
}