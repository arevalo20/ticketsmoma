$(function() {
  $('.datepicker').datepicker({
     todayHighlight: true, // Resaltar la fecha actual
     autoclose: true,
     todayBtn:  'linked',
     // minViewMode : 'days',
     minViewMode: 1,//  “days” or 0, “months” or 1, and “years” or 2
     endDate: 'now',
     language: 'es',
     orientation:'auto top'
  });

  $('#div_reporte_xmes').datepicker().on('changeDate', function(e) {
    var fecha = $("#div_reporte_xmes").data('datepicker').getFormattedDate('yyyy-mm');
    $("#itxt_reporte_mes").val(fecha);
  });

  $("#form_reporte_xmes").validate({
    ignore: [],
    onclick:false, onfocusout: false, onkeypress:false, onkeydown:false, onkeyup:false,
    rules: {
      itxt_reporte_mes: {required: true}
    },
    messages: {
      itxt_reporte_mes: {required: "Seleccione mes"}
    }
  });

  $("#btn_reporte_mes").click(function(e){
    e.preventDefault();
    $("#form_reporte_xmes").submit();
  });
});
