function buscar_sac() {
  sac = $("#sac").val();

  var parametros = {
    buscar: "1",
    sac: sac,
  };
  $.ajax({
    data: parametros,
    dataType: "json",
    url: "/reports/queries/autoconsulta_sac.php",
    type: "post",
    error: function () {
      alert("Error");
    },
    success: function (valores) {
      $("#usuario").val(valores.usuario);
      $("#domicilio").val(valores.calle);
      $("#telefono").val(valores.telefono);
      $("#beneficiario").val(valores.beneficiario_1);
    },
  });
}
