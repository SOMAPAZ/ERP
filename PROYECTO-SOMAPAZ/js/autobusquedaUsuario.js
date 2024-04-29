function buscar_usuario() {
  usuario = $("#usuario").val();

  var parametros = {
    buscar: "1",
    usuario: usuario,
  };
  $.ajax({
    data: parametros,
    dataType: "json",
    url: "/reports/queries/autoconsulta_usuario.php",
    type: "post",
    error: function () {
      alert("Error");
    },
    success: function (valores) {
      $("#sac").val(valores.sac);
      $("#domicilio").val(valores.calle);
      $("#telefono").val(valores.telefono);
      $("#beneficiario").val(valores.beneficiario_1);
    },
  });
}
