(() => {
  const listadoReportes = document.querySelector("#listado-reportes");
  const radiosEstadoRep = document.querySelectorAll(
    "input[name='estado-reporte']"
  );
  const totalSpan = document.querySelector("#total-reportes");
  const tituloSpan = document.querySelector("#titulo-estado");
  const inputCategoria = document.querySelector("#categoria-select");
  const inputIncidencia = document.querySelector("#incidencia-select");
  const inputPrioridad = document.querySelector("#prioridad-select");
  const filtrosSelect = document.querySelector("#filtros-select");
  let reportes = [];
  let reportesFiltrados = [];
  let totalReportes = 0;
  let categorias = [];
  let prioridades = [];
  let incidencias = [];
  let estadoGlobal = "1";

  class obtenerOpciones {
    constructor({ url, arreglo, input }) {
      this.url = url;
      this.arreglo = arreglo;
      this.input = input;

      this.obtenerDatos();
    }

    async obtenerDatos() {
      try {
        const response = await fetch(this.url);
        const resultado = await response.json();

        this.arreglo = resultado;
        this.renderizarDatos();
      } catch (error) {
        console.log(error);
      }
    }

    renderizarDatos() {
      this.arreglo.forEach((dato) => {
        const option = document.createElement("OPTION");
        option.value = dato.id;
        option.textContent = dato.name;

        this.input.appendChild(option);
      });
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    loader();
    obtenerReportes();

    new obtenerOpciones({
      url: "http://localhost:3000/api/categorias",
      arreglo: categorias,
      input: inputCategoria,
    });

    new obtenerOpciones({
      url: "http://localhost:3000/api/incidencias",
      arreglo: incidencias,
      input: inputIncidencia,
    });

    new obtenerOpciones({
      url: "http://localhost:3000/api/prioridades",
      arreglo: prioridades,
      input: inputPrioridad,
    });

    radiosEstadoRep.forEach((estado) => {
      estado.addEventListener("click", filtrarReportes);
    });
  });

  inputCategoria.addEventListener("change", (e) => {
    reiniciarObj();
    const tipo = e.target.value;
    reportesFiltrados = [...reportesFiltrados].filter(
      (reporte) => reporte.categoryID === tipo
    );

    renderizarReportes();
  });
  inputIncidencia.addEventListener("change", (e) => {
    reiniciarObj();
    const tipo = e.target.value;
    reportesFiltrados = [...reportesFiltrados].filter(
      (reporte) => reporte.incidenceID === tipo
    );

    renderizarReportes();
  });
  inputPrioridad.addEventListener("change", (e) => {
    reiniciarObj();
    const tipo = e.target.value;
    reportesFiltrados = [...reportesFiltrados].filter(
      (reporte) => reporte.priorityID === tipo
    );

    renderizarReportes();
  });

  async function obtenerReportes() {
    try {
      const URL = "http://localhost:3000/api-reportes";
      const response = await fetch(URL);
      const resultado = await response.json();

      reportes = resultado;
      reportesFiltrados = [...reportes].filter(
        (reporte) => reporte.statusID === estadoGlobal
      );

      renderizarReportes();
    } catch (error) {
      console.log(error);
    }
  }

  function renderizarReportes() {
    loader();
    limpiarAnterior();

    totalReportes = reportesFiltrados.length;
    totalSpan.textContent = `(${totalReportes})`;

    reportesFiltrados.forEach((reporte) => {
      const {
        folio,
        usuario,
        direccion,
        emision,
        categoria,
        incidencia,
        prioridad,
        priorityColor,
      } = reporte;

      const contenedorDiv = document.createElement("DIV");
      contenedorDiv.className = "space-y-4 py-2 md:py-4";

      const datosHeader = document.createElement("DIV");
      datosHeader.className = "grid grid-cols-1 md:grid-cols-2 gap-4";

      const folioLink = document.createElement("A");
      folioLink.className =
        "text-xl font-extrabold text-gray-900 dark:text-white uppercase hover:underline";
      folioLink.href = `/reporte?folio=${folio}`;
      folioLink.innerHTML = `Folio: <span class="font-semibold ms-2">${folio}</span>`;

      const divPrioridad = document.createElement("DIV");
      const span = document.createElement("SPAN");
      span.className = `inline-block rounded bg-${priorityColor}-100 px-2.5 py-0.5 text-xs font-extrabold text-${priorityColor}-800 dark:bg-${priorityColor}-900 dark:text-${priorityColor}-300 md:mb-0 uppercase`;
      span.textContent = prioridad;
      divPrioridad.appendChild(span);

      datosHeader.appendChild(folioLink);
      datosHeader.appendChild(divPrioridad);

      const datosBody = document.createElement("DIV");
      datosBody.className =
        "grid md:grid-cols-2 gap-2 md:gap-6 col-span-2 text-base text-gray-900 dark:text-white";

      //   Parte 1 de datos
      const div1 = document.createElement("DIV");
      div1.className = "space-y-2";
      const divUsuario = document.createElement("DIV");
      divUsuario.className = "flex flex-col md:flex-row md:gap-2";
      const parrUsuario = document.createElement("P");
      parrUsuario.className = "block font-bold py-1";
      parrUsuario.innerHTML = `Usuario: <span class="font-normal text-gray-500 dark:text-gray-400"> ${usuario} </span>`;
      divUsuario.appendChild(parrUsuario);
      div1.appendChild(divUsuario);

      const divDireccion = document.createElement("DIV");
      divDireccion.className = "flex flex-col md:flex-row md:gap-2";
      const parrDireccion = document.createElement("P");
      parrDireccion.className = "block font-bold py-1";
      parrDireccion.innerHTML = `Dirección: <span class="font-normal text-gray-500 dark:text-gray-400"> ${direccion} </span>`;
      divDireccion.appendChild(parrDireccion);
      div1.appendChild(divDireccion);

      const divEmision = document.createElement("DIV");
      divEmision.className = "flex flex-col md:flex-row md:gap-2";
      const parrEmision = document.createElement("P");
      parrEmision.className = "block font-bold py-1";
      parrEmision.innerHTML = `Emisión: <span class="font-normal text-gray-500 dark:text-gray-400"> ${emision} </span>`;
      divEmision.appendChild(parrEmision);
      div1.appendChild(divEmision);

      //   Parte 2 de datos
      const div2 = document.createElement("DIV");
      div2.className = "space-y-2";
      const divCategoria = document.createElement("DIV");
      divCategoria.className = "flex flex-col md:flex-row md:gap-2";
      const parrCategoria = document.createElement("P");
      parrCategoria.className = "block font-bold py-1";
      parrCategoria.innerHTML = `Categoría: <span class="font-normal text-gray-500 dark:text-gray-400"> ${categoria} </span>`;
      divCategoria.appendChild(parrCategoria);
      div2.appendChild(divCategoria);

      const divIncidencia = document.createElement("DIV");
      divIncidencia.className = "flex flex-col md:flex-row md:gap-2";
      const parrIncidencia = document.createElement("P");
      parrIncidencia.className = "block font-bold py-1";
      parrIncidencia.innerHTML = `Incidencia: <span class="font-normal text-gray-500 dark:text-gray-400"> ${incidencia} </span>`;
      divIncidencia.appendChild(parrIncidencia);
      div2.appendChild(divIncidencia);

      const divBotones = document.createElement("DIV");
      divBotones.className =
        "flex justify-center md:justify-end gap-1 col-span-2 md:col-span-1";

      const divBtnAcceder = document.createElement("DIV");
      const btnAcceder = document.createElement("A");
      btnAcceder.className =
        "flex items-center justify-center w-full uppercase bg-blue-600 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-blue-500 gap-2";
      btnAcceder.href = `/reporte?folio=${folio}`;
      btnAcceder.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <p class="font-bold text-xs">Acceder</p>
      `;
      const divBtnEliminar = document.createElement("DIV");
      const btnEliminar = document.createElement("BUTTON");
      btnEliminar.className =
        "flex items-center justify-center w-full uppercase bg-red-600 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-red-500 gap-2";
      btnEliminar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <p class="font-bold text-xs">Eliminar</p>
      `;
      btnEliminar.onclick = () => {
        confirmarEliminar(reporte.folio);
      };

      divBtnAcceder.appendChild(btnAcceder);
      divBtnEliminar.appendChild(btnEliminar);

      divBotones.appendChild(divBtnAcceder);
      divBotones.appendChild(divBtnEliminar);
      div2.appendChild(divBotones);

      datosBody.appendChild(div1);
      datosBody.appendChild(div2);

      //Renderizar todos
      contenedorDiv.appendChild(datosHeader);
      contenedorDiv.appendChild(datosBody);
      listadoReportes.appendChild(contenedorDiv);
    });
  }

  function filtrarReportes(e) {
    estadoGlobal = e.target.value;
    const nombre = e.target.id;

    tituloSpan.innerHTML = `Reportes ${nombre}`;

    reportesFiltrados = [...reportes].filter(
      (reporte) => reporte.statusID === estadoGlobal
    );

    filtrosSelect.reset();
    renderizarReportes();
  }

  function limpiarAnterior() {
    while (listadoReportes.firstChild) {
      listadoReportes.removeChild(listadoReportes.firstChild);
    }
  }

  function loader() {
    limpiarAnterior();
    const loader = document.createElement("DIV");
    loader.id = "loader";
    loader.innerHTML = `
    <div id="loader" class="mt-6">
        <div class="animate-pulse mt-10">
            <div class="py-2.5 rounded bg-gray-300 dark:bg-gray-400 w-48"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div>
                    <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                </div>
                <div class="flex justify-end gap-4">
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                </div>
            </div>
        </div>
        <div class="animate-pulse mt-10">
            <div class="py-2.5 rounded bg-gray-300 dark:bg-gray-400 w-48"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div>
                    <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                </div>
                <div class="flex justify-end gap-4">
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                </div>
            </div>
        </div>
        <div class="animate-pulse mt-10">
            <div class="py-2.5 rounded bg-gray-300 dark:bg-gray-400 w-48"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                <div>
                    <div class="py-2 bg-gray-300 dark:bg-gray-400 rounded"></div>
                </div>
                <div class="flex justify-end gap-4">
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                    <span class="py-4 bg-gray-300 dark:bg-gray-400 rounded w-32"></span>
                </div>
            </div>
        </div>
    </div>
    `;

    listadoReportes.appendChild(loader);
  }

  function reiniciarObj() {
    reportesFiltrados = [...reportes].filter(
      (reporte) => reporte.statusID === estadoGlobal
    );
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
      const URL = "http://localhost:3000/api/reporte/eliminar";
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
        });

        reportesFiltrados = [...reportesFiltrados].filter(
          (reporte) => reporte.folio !== resultado.folio
        );

        renderizarReportes();
      }
    } catch (error) {
      console.log(error);
    }
  }
})();
