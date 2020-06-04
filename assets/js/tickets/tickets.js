function autorizar_ticket(idticket){
  swal({
    title : "",
    html : "¿Autorizar ticket para que lo resuelva el equipo de soporte?",
    type : "question",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    buttonsStyling: true,
    reverseButtons:true, // primero pone cancelar y luego confirmar
    allowOutsideClick:false,
    allowEscapeKey:false
  }).then(function () {
    Ticket.autorizar_ticket(idticket);
  }, function (dismiss) { });
}// autorizar_ticket()

function solucionar_ticket(idticket){
  swal({
    title : "",
    html : "¿Actualizar estatus de ticket a RESUELTO?",
    type : "question",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    buttonsStyling: true,
    reverseButtons:true, // primero pone cancelar y luego confirmar
    allowOutsideClick:false,
    allowEscapeKey:false
  }).then(function () {
    Ticket.solucionar_ticket(idticket);
  }, function (dismiss) { });
}// solucionar_ticket()


var Ticket = {

  autorizar_ticket : function(idticket){
    $.ajax({
      url:base_url+"Ticket/autorizar",
      method:"POST",
      data: {'idticket':idticket},
      beforeSend: function(xhr) {
        Message.loading("Cargando");
      },
    })
    .done(function( data ) {
      swal.close();
      if(data.result){
        var offset = $("#itxt_ticket_offsset").val();
        Grid.get_gridpaginador(offset, "Ticket", "get_gridpaginador", "form_tickets", 'grid_tickets');
      }else{
        var mensaje = 'Ocurrió un error, reintente por favor y si el problema persiste por favor contacte a su administrador de sistemas';
        if(data.tipo_error == 'estatus_resuelto'){
          mensaje = 'No puede autorizar tickets que ya fueron resueltos';
        }
        Message.notification("",mensaje,"error");
      }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      swal.close();
      console.console.error('Uncaught Error: ' + jqXHR.responseText);
    })
    .always(function() {

    });
  },

  solucionar_ticket : function(idticket){
    $.ajax({
      url:base_url+"Ticket/solucionar",
      method:"POST",
      data: {'idticket':idticket},
      beforeSend: function(xhr) {
        Message.loading("Cargando");
      },
    })
    .done(function( data ) {
      swal.close();
      if(data.result){
        var offset = $("#itxt_ticket_offsset").val();
        Grid.get_gridpaginador(offset, "Ticket", "get_gridpaginador", "form_tickets", 'grid_tickets');
      }else{
        var mensaje = 'Ocurrió un error, reintente por favor y si el problema persiste por favor contacte a su administrador de sistemas';
        if(data.tipo_error == 'estatus_pendiente'){
          mensaje = 'No puede resolver tickets que no han sido autorizados';
        }
        Message.notification("",mensaje,"error");
      }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      swal.close();
      console.console.error('Uncaught Error: ' + jqXHR.responseText);
    })
    .always(function() {

    });
  }

};

function get_gridpaginador(offset){
  $("#itxt_ticket_offsset").val(offset);

  Grid.get_gridpaginador(offset, "Ticket", "get_gridpaginador", "form_tickets", 'grid_tickets');
}
