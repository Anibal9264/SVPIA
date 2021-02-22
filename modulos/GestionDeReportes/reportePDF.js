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
doc.setFont('', 'bold');
doc.setFontSize(20);
doc.text(100, 15,response[0].nombre, 'center');
doc.setFont('', 'normal');
doc.setFontSize(12);
doc.text(100, 22, '"'+response[0].subNombre+'"', 'center');
doc.setFontSize(15);
doc.text(100, 30, response[0].distrito, 'center');
doc.setFontSize(15);
doc.text(100, 36, response[0].canton+', '+response[0].provincia , 'center');
doc.setFontSize(13);
doc.text(100, 43, 'Telefono: '+response[0].telefono, 'center');
doc.setFontSize(13);
doc.text(100, 49, 'Correo: '+response[0].correo, 'center');

doc.setFontSize(15);
doc.text(20, 60, 'Desde: '+desde);
doc.text(70, 60, 'Hasta: '+hasta);


// reporte de ventas *******************************************************

doc.setFontSize(18);
doc.text(100,80, 'Reporte de ventas', 'center');
doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(22, 90, '#');
doc.text(28, 90, 'FECHA');
doc.text(55, 90, 'VENTAS');
doc.text(82, 90, 'SUB TOTAL');
doc.text(120, 90, 'IVA');
doc.text(145, 90, 'TOTAL');
doc.setLineWidth(1);
doc.setDrawColor(200, 200, 200);
doc.line(22, 92, 170, 92);

var y = -5;
var itens = 0;
var subtotal = 0.0;
var ivaT = 0;
var Total = 0;
var ventas = response[1];
for (var i = 0; i < ventas.length; i++) {
y += 5;
doc.setFontSize(13);
doc.setFont('', 'normal');
var num = (i+1).toString();
var vFecha = ventas[i]["fecha"];
itens += ventas[i]["cantidad"];
var cantidad = ventas[i]["cantidad"].toString();
var sinImpuestos = ventas[i]["totalsinImpuestos"].toString();
var tem = parseFloat(ventas[i]["totalsinImpuestos"]);
subtotal += tem;
var tem2 = parseFloat(ventas[i]["totalimpuestos"]);
ivaT += tem2;
var tem3 = parseFloat(ventas[i]["total"]);
Total += tem3;

doc.text(22, 98+y,num);//numero
doc.text(28, 98+y,vFecha);// fecha
doc.text(64, 98+y,cantidad);// cantidad
doc.text(82, 98+y,'¢'+sinImpuestos);// totalsinImpuestos
doc.text(120, 98+y,'¢'+tem2.toString());// iva
doc.text(145, 98+y,'¢'+tem3.toString());// total

if (190+y >= pageHeight)
{
  doc.addPage();
  y = -85; // Restart height position
}
}


doc.line(22, 101+y, 170, 101+y);
doc.text(22, 107+y,'TOTAL');
doc.text(64, 107+y,itens.toString());// SUMA ITEMS

doc.setFontSize(15);
doc.setFont('', 'bold');
doc.text(82, 107+y,'¢'+subtotal.toString());
doc.text(120, 107+y,'¢'+ivaT.toString()); 
doc.text(145, 107+y,'¢'+Total.toString()); //total completo
doc.setLineWidth(0.7);

doc.setDrawColor(0,0,0);
doc.line(22, 109+y, 170, 109+y);

// reporte de ingresos *******************************************************

doc.setFontSize(18);
doc.setFont('', 'normal');
doc.text(100,117+y, 'Reporte de ingresos', 'center');
doc.setFontSize(13);
doc.setFont('', 'bold');
doc.text(22, 127+y, '#');
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
var num = (i+1).toString();
var iFecha = ingresos[i]["fecha"];
var proveedor = ingresos[i]["proveedor"];
var producto = ingresos[i]["producto"];
var monto = ingresos[i]["monto"];

montoTotal += parseFloat(monto);
        
doc.text(22, 136+y+y2,num);//numero
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
doc.text(22, 144+y+y2,'TOTAL');

doc.setFontSize(15);
doc.setFont('', 'bold');
doc.text(137, 144+y+y2,'¢'+montoTotal.toString()); //total completo
doc.setLineWidth(0.7);


doc.setLineWidth(1);
doc.setDrawColor(0, 0, 0);
doc.line(22, 146+y+y2, 170, 146+y+y2);

doc.text(22, 155+y+y2,'VENTAS ANTES DE IMPUESTOS');
doc.text(137, 155+y+y2,'¢'+Total.toString()); 

doc.text(22, 161+y+y2,'IMPUESTOS');
doc.text(137, 161+y+y2,'¢ -'+ivaT.toString()); 

doc.text(22, 167+y+y2,'VENTAS NETAS');
doc.text(137, 167+y+y2,'¢'+subtotal.toString()); //total completo
doc.setLineWidth(0.7);

doc.text(22, 173+y+y2,'GASTOS');
doc.text(137, 173+y+y2,'¢'+montoTotal.toString()); //total completo
doc.setLineWidth(0.7);

doc.text(22, 179+y+y2,'GANANCIAS');
doc.text(137, 179+y+y2,'¢'+(subtotal-montoTotal).toString()); //total completo
doc.setLineWidth(0.7);


doc.setDrawColor(0,0,0);
doc.line(22, 185+y+y2, 170, 185+y+y2);


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

