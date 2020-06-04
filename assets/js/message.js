var Message = {
  notification : function(title,text,type){ // Type warning, error, success, info, and question
    swal({
      title : title,
      html : text,
      type: type,
      confirmButtonText: 'Aceptar',
      width:'350px'
    });
  },
  loading : function(texto){
    swal({
        title: "<center><div class='loader'></div></center>",
        text: texto,
        width: 300,
        padding: 40,
        showCancelButton: false,
        showConfirmButton: false,
        allowEscapeKey:false,
        allowOutsideClick:false
      });
  }
};
