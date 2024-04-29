$(document).ready(function () {
  $("#responsive").DataTable({
    responsive: true,
    pageLength: 100,
  });
});

// Función para cargar y actualizar la tabla
function actualizarTabla() {
  $.ajax({
    url: "/reports/reports_table.php", // Archivo PHP que devolverá la tabla actualizada
    type: "GET",
    success: function (data) {
      $("#tabla-container").html(data); // Actualiza el contenido del contenedor con la nueva tabla
    },
  });
}

function toggleButton() {
  var button = document.getElementById("new-report");
  if (window.innerWidth < 1200) {
    button.disabled = true;
  } else {
    button.disabled = false;
  }
}
window.onload = toggleButton;
window.onresize = toggleButton;