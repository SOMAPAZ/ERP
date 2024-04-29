$(document).ready(function () {
  var initialState = "<?php echo $rows[0]['estado']; ?>";

  // Muestra el toast cuando cambia el estado
  function showToast(newStatus) {
    $("#toast .toast-body").text(
      "El estado ha sido actualizado a: " + newStatus
    );
    var toast = new bootstrap.Toast(document.getElementById("toast"));
    toast.show();
  }

  // Compara el estado inicial con el nuevo estado
  // y muestra el toast si son diferentes
  $('select[name="campo_estado"]').change(function () {
    var newStatus = $(this).val();
    if (initialState !== newStatus) {
      showToast(newStatus);
    }
  });
});
