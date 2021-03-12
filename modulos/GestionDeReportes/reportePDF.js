/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function reportePDF() {
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
    var tipo = $("input[name='tipo']:checked").val();
 var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                response = JSON.parse(objXMLHttpRequest.responseText);
                
                
var jsPDF = window.jspdf.jsPDF;
    pageHeight= 280;
var doc = new jsPDF();

var imgData = response[0].logotipo;
doc.addImage(imgData, 'JPEG',20,20, 42, 42);

doc.setFont('', 'bold');
doc.setFontSize(20);
doc.text(100, 15,response[0].nombre, 'center');
doc.setFont('', 'normal');
doc.setFontSize(12);
doc.text(100, 22, '"'+response[0].subNombre+'"', 'center');
doc.setFontSize(15);
doc.text(100, 28,response[0].propietario, 'center');
doc.text(100, 34,"Cédula: "+response[0].cedula, 'center');
doc.setFontSize(13);
doc.text(100, 40, response[0].direccionExacta, 'center');
doc.text(100, 45, response[0].distrito, 'center');
doc.text(100, 50, response[0].canton+', '+response[0].provincia , 'center');
doc.text(100, 56, 'Telefono: '+response[0].telefono, 'center');
doc.text(100,62, 'Correo: '+response[0].correo, 'center');

doc.setFontSize(15);
doc.text(20, 72, 'Desde: '+desde);
doc.text(70, 72, 'Hasta: '+hasta);


// reporte de ventas *******************************************************

doc.setFontSize(18);
doc.text(100,80, 'Reporte de Ventas', 'center');
doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(30, 90, 'FECHA');
doc.text(80, 90, 'VENTAS');
doc.text(130, 90, 'TOTAL');
doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 92, 170, 92);

var y = -5;
var itens = 0;
var Total = 0;

var ventas = response[1];

var efectivo = ventas[ventas.length-1][0];
var tarjeta = ventas[ventas.length-1][1];
var Sinpe = ventas[ventas.length-1][2];

for (var i = 0; i < ventas.length-1; i++) {
y += 5;
doc.setFontSize(13);
doc.setFont('', 'normal');
var vFecha = ventas[i]["fecha"];
itens += ventas[i]["cantidad"];
var cantidad = ventas[i]["cantidad"].toString();
var tem3 = parseFloat(ventas[i]["total"]);
Total += tem3;


doc.text(30, 98+y,vFecha);// fecha
doc.text(80, 98+y,cantidad);// cantidad
doc.text(130, 98+y,'¢'+tem3.toFixed(2).toString());// total

if (190+y >= pageHeight)
{
  doc.addPage();
  y = -85; // Restart height position
}
}


doc.line(22, 101+y, 170, 101+y);
doc.text(30, 107+y,'Total Ventas');
doc.text(80, 107+y,itens.toString());// SUMA ITEMS

doc.setFontSize(15);
doc.setFont('', 'bold');
doc.setLineWidth(0.7);

doc.text(80, 115+y,'Total Efectivo');
doc.text(130, 115+y,'¢'+efectivo);//

doc.text(80, 122+y,'Total Tarjeta');
doc.text(130, 122+y,'¢'+tarjeta);// 

doc.text(80, 129+y,'Total SINPE');
doc.text(130, 129+y,'¢'+Sinpe);// 

doc.text(80, 136+y,'TOTAL');
doc.text(130, 136+y,'¢'+Total.toFixed(2).toString());//  TOTAL completo




doc.setDrawColor(0,0,0);
doc.line(22, 109+y, 170, 109+y);




y+=30;

// reporte de ingresos *******************************************************

doc.setFontSize(18);
doc.setFont('', 'normal');
doc.text(100,117+y, 'Reporte de Gastos', 'center');
doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(28, 127+y, 'FECHA');
doc.text(55, 127+y, 'PROVEEDOR');
doc.text(97, 127+y, 'PRODUCTO');
doc.text(137,127+y, 'MONTO');
doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 130+y, 170, 130+y);

var y2 = -5;
var montoTotal = 0;
var ingresos = response[2];
for (var i = 0; i < ingresos.length; i++) {
y2 += 5;
doc.setFontSize(13);
doc.setFont('', 'normal');
var iFecha = ingresos[i]["fecha"];
var proveedor = ingresos[i]["proveedor"];
var producto = ingresos[i]["producto"];
var monto = ingresos[i]["monto"];

montoTotal += parseFloat(monto);
        
doc.text(28, 136+y+y2,iFecha);// fecha


var tam = proveedor.length;
if(tam>19){
    var sub = proveedor.substring(0,19);
    var sobro = proveedor.substring(19);
    while(sub.length>0){
        doc.text(97, 136+y+y2,sub);// producto
        y2 += 5;
        if(sobro.length<=19){
           doc.text(97, 136+y+y2,sobro);// producto
           sub='';
        }else{
            sub = sobro.substring(0,19);
            sobro = sobro.substring(19);
        }
    }
}else{
    doc.text(55, 136+y+y2,proveedor);// proveedor
}



var tam = producto.length;
if(tam>19){
    var sub = producto.substring(0,19);
    var sobro = producto.substring(19);
    while(sub.length>0){
        doc.text(97, 136+y+y2,sub);// producto
        y2 += 5;
        if(sobro.length<=19){
           doc.text(97, 136+y+y2,sobro);// producto
           sub='';
        }else{
            sub = sobro.substring(0,19);
            sobro = sobro.substring(19);
        }
    }
}else{
    doc.text(97, 136+y+y2,producto);// producto
}

doc.text(137, 136+y+y2,'¢'+monto);// monto

if (190+y+y2 >= pageHeight)
{
  doc.addPage();
  y = -139;
  y2 = 15; // Restart height position
}


}


doc.line(22, 139+y+y2, 170, 139+y+y2);
doc.text(110, 150+y+y2,'TOTAL');

doc.setFontSize(15);
doc.setFont('', 'bold');
doc.text(137, 150+y+y2,'¢'+montoTotal.toFixed(2).toString()); //total completo
doc.setLineWidth(0.7);
doc.setDrawColor(0, 0, 0);
doc.line(110, 152+y+y2, 170, 152+y+y2);


doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 160+y+y2, 170, 160+y+y2);

doc.text(22, 167+y+y2,'VENTAS');
doc.text(137, 167+y+y2,'¢'+Total.toFixed(2).toString()); //total completo
doc.setLineWidth(0.7);

doc.text(22, 173+y+y2,'GASTOS');
doc.text(137, 173+y+y2,'¢'+montoTotal.toFixed(2).toString()); //total completo
doc.setLineWidth(0.7);

doc.text(22, 179+y+y2,'GANANCIAS');
doc.text(137, 179+y+y2,'¢'+(Total-montoTotal).toFixed(2).toString()); //total completo



doc.setFontSize(13);
doc.setFont('', 'normal');
var fecha = new Date();
var hoy = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate()+'  '+
          fecha.getHours()+':'+fecha.getMinutes()+':'+fecha.getSeconds();
doc.text(100,190+y+y2, 'GENERADO EL: '+hoy, 'center');


$('#info').attr('src', doc.output("datauristring"));


                
                
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
            }
        }
    };
    objXMLHttpRequest.open('GET', 'modulos/GestionDeReportes/getReporte.php?desde='+desde+'&hasta='+hasta+'&tipo='+tipo);
    objXMLHttpRequest.send();

};



function cargarFechas(){
    $( "#desde" ).datepicker({
      dateFormat: 'yy-mm-dd'
});
    $( "#hasta" ).datepicker({
      dateFormat: 'yy-mm-dd'
});
}