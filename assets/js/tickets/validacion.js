$(document).ready(function () {
  $("#form_ticket_createup").validate({
          onclick:false, onfocusout: false, onkeypress:false, onkeydown:false, onkeyup:false,
          rules: {
              itxt_ticket_titulo: {required: true},
              itxt_ticket_descripcion: {required: true}
          },
          messages: {
              itxt_ticket_titulo: {required: " *Ingrese un título para la ticket"},
              itxt_ticket_descripcion: {required: " *Ingrese la descripción"}
          }
      });
});

$("#btn_ticket_guardar").click(function(e){
   e.preventDefault();
   $("#form_ticket_createup").submit();
});

$('#ifile_ticket_img').on("change", function(){
  $("#ifile_ticket_img_aux").val(this.files.length);
  // console.info(this.files.length);
  // uploadFile();
});
