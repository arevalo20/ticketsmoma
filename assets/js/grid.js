var Grid = {
  get_gridpaginador : function(offset, controller, funcion, form, iddiv){
    var datos = $("#"+form).serializeArray();
    datos.push({"name":"offset","value":offset});

    $.ajax({
      url:base_url+controller+"/"+funcion,
      method:"POST",
      data: datos,
      beforeSend: function(xhr) {
          Message.loading("Cargando");
      },
    })
    .done(function( data ) {
      $("#"+iddiv).empty();
      $("#"+iddiv).append(data.str_grid);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 0) {
        alert('Not connect: Verify Network.');
      } else if (jqXHR.status == 404) {
        alert('Requested page not found [404]');
      } else if (jqXHR.status == 500) {
        alert('Internal Server Error [500].');
      } else if (textStatus === 'parsererror') {
        alert('Requested JSON parse failed.');
      } else if (textStatus === 'timeout') {
        alert('Time out error.');
      } else if (textStatus === 'abort') {
        alert('Ajax request aborted.');
      } else {
        alert('Uncaught Error: ' + jqXHR.responseText);
      }
    })
    .always(function() {
      swal.close();
    });

  }
};
