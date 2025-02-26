import GetDatos from "../classes/GetData.js"
import PostDatos from "../classes/PostData.js"
import Alerta from "../classes/Alerta.js";
import { formatDateText, getSearch, limpiarHTML } from "../helpers/index.js"
import Generador from "../classes/Generador.js";

(() => {
  const listadoReportes = document.querySelector("#listado-reportes");
  const totalSpan = document.querySelector("#total-reportes");
  const titulo = document.querySelector('#titulo-estado');
  const btnAnterior = document.querySelector('#btn-anterior');
  const btnSiguiente = document.querySelector('#btn-siguiente');
  
  const totalPag = document.querySelector("#total-rep");
  const inicioMostrado = document.querySelector('#inicio-mostrado')
  const finMostrado = document.querySelector('#fin-mostrado')

  const totalPagSM = document.querySelector("#total-rep-sm");
  const inicioMostradoSM = document.querySelector('#inicio-mostrado-sm')
  const finMostradoSM = document.querySelector('#fin-mostrado-sm')

  let reportes = [];
  let arrConsulta = []
  
  const estados = [ "Reportes Abiertos", "Reportes en Proceso", "Reportes Cerrados", "Reportes Terminados"]
  let totalReportes = 0;
  const limit = 10;
  let offset = 1;
  let actual = 1;
  const status = getSearch().s ?? 1;

  document.addEventListener("DOMContentLoaded", () => {
    obtenerReportes();
    btnAnterior.addEventListener('click', disminuirPaso)
    btnSiguiente.addEventListener('click', aumentarPaso)
  });

  const obtenerReportes = async () => {
    titulo.textContent = estados[Number(status) - 1]
    arrConsulta = [
      {s: status},
      {limit},
      {offset: obtenerOffset()}
    ];

    const url = Generador.getDatos('api-reportes', arrConsulta)
    const res = await GetDatos.consultar(url);

    reportes = res.reportes;
    totalReportes = res.total;

    renderizarReportes();
  }

  const renderizarReportes = () => {

    limpiarHTML(listadoReportes);

    totalSpan.textContent = `(${totalReportes})`;
    totalPag.textContent = `${totalReportes}`;
    totalPagSM.textContent = `${totalReportes}`;

    inicioMostrado.textContent = `${obtenerOffset() + 1}`
    inicioMostradoSM.textContent = `${obtenerOffset() + 1}`

    const finTotal = obtenerOffset() + 100 >= totalReportes ? totalReportes : obtenerOffset() + 100;
    finMostrado.textContent = `${finTotal}`
    finMostradoSM.textContent = `${finTotal}`
    
    reportes.forEach( reporte => {
      const contenedorDiv = document.createElement("DIV");
      contenedorDiv.className = "space-y-4 py-2 md:py-4";

      const datosHeader = document.createElement("DIV");
      datosHeader.className = "grid grid-cols-1 md:grid-cols-2 gap-4";

      const folioLink = document.createElement("A");
      folioLink.className =
        "text-xl font-extrabold text-gray-900 dark:text-white uppercase hover:underline";
      folioLink.href = `/reporte?folio=${reporte.id}`;
      folioLink.innerHTML = `Folio: <span class="font-semibold ms-2">${reporte.id}</span>`;

      const divPrioridad = document.createElement("DIV");
      const span = document.createElement("SPAN");
      span.className = `inline-block rounded bg-${reporte.id_priority.color}-100 px-2.5 py-0.5 text-xs font-extrabold text-${reporte.id_priority.color}-800 dark:bg-${reporte.id_priority.color}-900 dark:text-${reporte.id_priority.color}-300 md:mb-0 uppercase`;
      span.textContent = reporte.id_priority.name;
      divPrioridad.appendChild(span);

      datosHeader.appendChild(folioLink);
      datosHeader.appendChild(divPrioridad);

      const datosBody = document.createElement("DIV");
      datosBody.className =
        "grid md:grid-cols-2 gap-2 md:gap-6 col-span-2 text-base text-gray-900 dark:text-white";

      const div1 = document.createElement("DIV");
      div1.className = "space-y-2";
      const divUsuario = document.createElement("DIV");
      divUsuario.className = "flex flex-col md:flex-row md:gap-2";
      const parrUsuario = document.createElement("P");
      parrUsuario.className = "block font-bold py-1";
      parrUsuario.innerHTML = `Usuario: <span class="font-normal text-gray-500 dark:text-gray-400"> ${reporte.name} </span>`;
      divUsuario.appendChild(parrUsuario);
      div1.appendChild(divUsuario);

      const divDireccion = document.createElement("DIV");
      divDireccion.className = "flex flex-col md:flex-row md:gap-2";
      const parrDireccion = document.createElement("P");
      parrDireccion.className = "block font-bold py-1";
      parrDireccion.innerHTML = `Dirección: <span class="font-normal text-gray-500 dark:text-gray-400"> ${reporte.address} </span>`;
      divDireccion.appendChild(parrDireccion);
      div1.appendChild(divDireccion);

      const divEmision = document.createElement("DIV");
      divEmision.className = "flex flex-col md:flex-row md:gap-2";
      const parrEmision = document.createElement("P");
      parrEmision.className = "block font-bold py-1";
      parrEmision.innerHTML = `Emisión: <span class="font-normal text-gray-500 dark:text-gray-400"> ${formatDateText(reporte.created)} </span>`;
      divEmision.appendChild(parrEmision);
      div1.appendChild(divEmision);

      //   Parte 2 de datos
      const div2 = document.createElement("DIV");
      div2.className = "space-y-2";
      const divCategoria = document.createElement("DIV");
      divCategoria.className = "flex flex-col md:flex-row md:gap-2";
      const parrCategoria = document.createElement("P");
      parrCategoria.className = "block font-bold py-1";
      parrCategoria.innerHTML = `Categoría: <span class="font-normal text-gray-500 dark:text-gray-400"> ${reporte.id_category} </span>`;
      divCategoria.appendChild(parrCategoria);
      div2.appendChild(divCategoria);

      const divIncidencia = document.createElement("DIV");
      divIncidencia.className = "flex flex-col md:flex-row md:gap-2";
      const parrIncidencia = document.createElement("P");
      parrIncidencia.className = "block font-bold py-1";
      parrIncidencia.innerHTML = `Incidencia: <span class="font-normal rounded px-2 py-1 
      ${reporte.id_incidence.id === '5' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : reporte.id_incidence.id === '10' || reporte.id_incidence.id === '20' ? 'bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'}"> ${reporte.id_incidence.name} </span>`;
      divIncidencia.appendChild(parrIncidencia);
      div2.appendChild(divIncidencia);

      const divBotones = document.createElement("DIV");
      divBotones.className = "flex justify-center md:justify-end gap-1 col-span-2 md:col-span-1";

      const divBtnAcceder = document.createElement("DIV");
      const btnAcceder = document.createElement("A");
      btnAcceder.className ="flex items-center justify-center w-full uppercase bg-blue-600 text-font-light text-xs py-1 px-3 rounded-md shadow-md hover:bg-blue-500 gap-2";

      btnAcceder.href = `/reporte?folio=${reporte.id}`;
      btnAcceder.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Acceder</p>`;
      const divBtnEliminar = document.createElement("DIV");
      const btnEliminar = document.createElement("BUTTON");
      btnEliminar.className =
        "flex items-center justify-center w-full uppercase bg-red-600 text-font-light text-xs py-1 px-3 rounded-md shadow-md hover:bg-red-500 gap-2";
      btnEliminar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;
      btnEliminar.onclick = () => confirmarEliminar(reporte.id);

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

  const confirmarEliminar = (folio) => {
    Swal.fire({
      title: `¿Estás seguro de eliminar el reporte ${folio}?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) eliminarReporte(folio);
    });
  }

  const eliminarReporte = async (folio) => {
    const URL = `${location.origin}/api/reporte/eliminar`;
    const res = await PostDatos.eliminarDatos(URL, folio, 'folio')
    if (res.tipo === "Exito") {
      Alerta.Toast.fire({
        title: res.tipo,
        text: res.mensaje,
        icon: "success",
      });

      reportes = [...reportes].filter( reporte => reporte.id !== res.folio);

      renderizarReportes();
    }
  }

  const disminuirPaso = () => {
    actual--;

    if(actual === 1) {
      obtenerReportes();
      btnAnterior.classList.add('hidden');
      return;
    };
    
    if(actual <= Math.ceil(totalReportes/limit)) {
      btnSiguiente.classList.remove('hidden');
    }

    arrConsulta = [
      {s: status},
      {limit},
      {offset: obtenerOffset()}
    ];
    
    obtenerReportes()
  }

  const aumentarPaso = () => {
    if (actual === Math.floor(totalReportes/limit))  {
      actual = Math.ceil(totalReportes/limit)
      obtenerReportes();
      btnSiguiente.classList.add('hidden');
      return;
    };

    
    actual++

    if(actual > 1) {
      btnAnterior.classList.remove('hidden');
    }

    arrConsulta = [
      {s: status},
      {limit},
      {offset: obtenerOffset()}
    ];

    obtenerReportes()
  }

  const obtenerOffset = () => {
    if (actual - 1 === 0) return 0;
    return (actual - 1) * limit;
  }
})();
