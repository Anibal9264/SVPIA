function cambiarChech(){
    if( $('#cambiar').prop('checked') ) {
    $('#cargarimg').html("<br> <input type='file' name='archivo' required >");
     }else{
          $('#cargarimg').html("");
     }
}

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Bproductos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
});


