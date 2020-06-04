$("#btn_ticket_mensaje").click(function(e){
   e.preventDefault();
   var mensaje = $("#itxt_ticket_mensaje").val();
   if((mensaje.trim()).length == 0){
     Message.notification("","Escriba una respuesta","info");
   }else{
     Ticket_mensajes.crear();
   }

});

var Ticket_mensajes = {
  crear : function(idticket){
    var idticket = $("#itxt_ticket_idticket").val();
    var mensaje = $("#itxt_ticket_mensaje").val();

    var form = document.createElement("form");
    var element1 = document.createElement("input");
    var element2 = document.createElement("input");

    form.name="form_ticket_mensaje";
    form.id="form_ticket_mensaje";
    form.method = "POST";
    form.target = "_self";

    element1.type="hidden";
    element1.value = idticket;
    element1.name="idticket";
    form.appendChild(element1);

    element2.type="hidden";
    element2.value = mensaje;
    element2.name="mensaje";
    form.appendChild(element2);

    form.action = base_url+"ticket/guardar_mensaje";
    document.body.appendChild(form);

    form.submit();
  }
};
