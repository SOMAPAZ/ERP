(() => {
  const btnEliminar = document.querySelector("#btn-remove-reporte");

  document.addEventListener("DOMContentLoaded", () => {
    btnEliminar.addEventListener("click", () => {
      confirmarEliminar(obtenerFolio());
    });
  });

  function obtenerFolio() {
    const folioParams = new URLSearchParams(window.location.search);
    const report = Object.fromEntries(folioParams.entries());
    return report.folio;
  }

  function confirmarEliminar(folio) {
    Swal.fire({
      title: `¿Estás seguro de eliminar el reporte ${folio}?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarReporte(folio);
      }
    });
  }

  async function eliminarReporte(folio) {
    const datos = new FormData();
    datos.append("folio", folio);

    try {
      const URL = `${location.origin}/api/reporte/eliminar`;
      const response = await fetch(URL, {
        method: "POST",
        body: datos,
      });
      const resultado = await response.json();

      if (resultado.tipo === "Exito") {
        Swal.fire({
          title: resultado.tipo,
          text: resultado.mensaje,
          icon: "success",
          timer: 3000,
        }).then(() => {
          window.location.href = `${location.origin}/reportes`;
        });
      }
    } catch (error) {
      console.log(error);
    }
  }
})();
