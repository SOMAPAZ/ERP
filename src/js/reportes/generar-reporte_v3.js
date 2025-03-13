import Alerta from "../classes/Alerta_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import PostDatos from "../classes/PostData_v1.js";
import { formatDateText, limpiarHTML } from "../helpers/index_v1.js";

(() => {
  const inputNombre = document.querySelector("#nombre");
  const inputID = document.querySelector("#idUser");
  const inputDireccion = document.querySelector("#direccion");
  const inputTelefono = document.querySelector("#telefono");
  const inputBeneficiario = document.querySelector("#beneficiario");

  const selectCategoria = document.querySelector("#categoria");
  const selectIncidencia = document.querySelector("#incidencia");
  const selectPrioridad = document.querySelector("#prioridad");

  const btnResetear = document.querySelector("#resetear-formulario");
  const divListado = document.querySelector("#coincidencias-usuario");
  const divListadoID = document.querySelector("#coincidencias-ID");
  const formulario = document.querySelector("#formulario-reporte");
  const divNuevo = document.querySelector("#reporte-reciente");
  let usuarios = [];
  let prioridades = [];
  let categorias = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();

    inputNombre.addEventListener("input", coincidenciaNombre);
    inputID.addEventListener("input", coincidenciaID);
    selectCategoria.addEventListener("change", generarIncidencias);

    btnResetear.addEventListener("click", () => formulario.reset());
    formulario.addEventListener("submit", enviarReporte);
  });

  const obtenerDatos = async () => {
    [usuarios, prioridades, categorias] = await Promise.all([
      GetDatos.consultar(`${location.origin}/api/users`),
      GetDatos.consultar(`${location.origin}/api/prioridades`),
      GetDatos.consultar(`${location.origin}/api/categorias`)
    ])

    agregarOpciones(selectPrioridad, prioridades);
    agregarOpciones(selectCategoria, categorias);
  }

  const enviarReporte = async (e) => {
    e.preventDefault();

    const res = await PostDatos.guardarDatos(`${location.origin}/api/reporte`, formulario.querySelectorAll('.input-report'))
    
    if(res.tipo === 'Exito') {
      formulario.reset();

      Swal.fire({
        icon: 'success',
        title: 'Proceso exitoso',
        text: res.mensaje
      })

      mostrarNuevo(res.reporte)
    }
  }

  const coincidenciaNombre = () => {
    const inputCoincidencia = inputNombre.value.trim().toLowerCase();
    if(inputCoincidencia === '' || inputCoincidencia.length < 3) return;
    limpiarHTML(divListado);
    
    let coincidencias = [...usuarios].filter((usuario) => (usuario.nombre).toLowerCase().includes(inputCoincidencia.toLowerCase()));
    
    coincidencias.forEach((item) => {
      const li = document.createElement("LI");
      li.className = "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";
      li.onclick = () => autocompletar(item, divListado);
      li.textContent = item.nombre;

      divListado.appendChild(li);
    });
  }

  const coincidenciaID = () => {
    const inputCoincidencia = inputID.value.trim();
    if(inputCoincidencia === '' || inputCoincidencia == 0) return;
    limpiarHTML(divListadoID);

    let coincidencias = [...usuarios].filter(usuario => (usuario.id).includes(inputCoincidencia));

    coincidencias.forEach((item) => {
        const li = document.createElement("LI");
        li.className = "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";
        li.onclick = () => autocompletar(item, divListadoID);

        li.textContent = `${item.id} - ${item.nombre}`;
        divListadoID.appendChild(li);
    });
  }

  const generarIncidencias = async(e) => {
    const id_categoria = e.target.value;

    if (id_categoria === "") {
      selectIncidencia.setAttribute("disabled", "disabled");
      limpiarHTML(selectIncidencia);
      return;
    }

    selectIncidencia.removeAttribute("disabled");
    const res = await PostDatos.enviarArray(`${location.origin}/api/incidencias`, id_categoria);
    
    if (res.tipo === "error") {
      selectIncidencia.setAttribute("disabled", "disabled");
      return;
    }

    (res.datos).forEach( incidencia => {
      const option = document.createElement("OPTION");
      option.value = incidencia.id;
      option.textContent = incidencia.name;
      selectIncidencia.appendChild(option);
    });
  }

  const mostrarNuevo = (respuesta) => {
    limpiarHTML(divNuevo);

    const divEncabezado = document.createElement("DIV");
    divEncabezado.className = "grid grid-cols-2 gap-4";

    const linkReporte = document.createElement("A");
    linkReporte.className =
      "text-xl font-extrabold text-gray-900 dark:text-white uppercase hover:underline";
    linkReporte.href = `/reporte?folio=${respuesta.id}`;
    linkReporte.innerHTML = `Folio: <span class="font-semibold ms-2">${respuesta.id}</span>`;

    const prior = prioridades.filter( prioridadMem => prioridadMem.name === respuesta.id_priority).shift();

    const divPrioridad = document.createElement("DIV");
    const spanPrioridad = document.createElement("SPAN");
    spanPrioridad.className = `inline-block rounded bg-${prior.color}-100 px-2.5 py-0.5 text-xs font-extrabold text-${prior.color}-800 dark:bg-${prior.color}-900 dark:text-${prior.color}-300 md:mb-0 uppercase`;

    spanPrioridad.textContent = prior.name;
    divPrioridad.appendChild(spanPrioridad);

    divEncabezado.appendChild(linkReporte);
    divEncabezado.appendChild(divPrioridad);

    const divBody = document.createElement("DIV");
    divBody.className =
      "grid md:grid-cols-2 gap-2 md:gap-6 col-span-2 text-base text-gray-900 dark:text-white";

    const divDatos = document.createElement("DIV");
    divDatos.classList.add("space-y-2");
    divDatos.innerHTML = `
      <div class="flex flex-col md:flex-row md:gap-2 uppercase">
        <p class="block font-bold py-1">
            Usuario: <span class="font-normal text-gray-500 dark:text-gray-400">${respuesta.name}</span>
        </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
        <p class="block font-bold py-1">
            Dirección: <span class="font-normal text-gray-500 dark:text-gray-400">${respuesta.address}</span>
        </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
        <p class="block font-bold py-1"> Fecha emisión: 
          <span class="font-normal text-gray-500 dark:text-gray-400">${respuesta.created}</span>
        </p>
      </div>
    `;

    const divTipo = document.createElement("DIV");
    divTipo.classList.add("space-y-2");
    divTipo.innerHTML = `
      <div class="flex flex-col md:flex-row md:gap-2 uppercase">
          <p class="block font-bold py-1">
              Categoría:
              <span class="font-normal text-gray-500 dark:text-gray-400">
                  ${respuesta.id_category}
              </span>
          </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
          <p class="block font-bold py-1">
              Incidencia:
              <span class="font-normal text-gray-500 dark:text-gray-400">
                ${respuesta.id_incidence}
              </span>
          </p>
      </div>
    `;

    const divBotones = document.createElement("DIV");
    divBotones.className =
      "flex justify-center md:justify-end gap-1 col-span-2 md:col-span-1";

    const divBtnAcceder = document.createElement("DIV");
    const btnAcceder = document.createElement("A");
    btnAcceder.className =
      "flex items-center justify-center w-full uppercase bg-blue-600 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-blue-500 gap-2";
    btnAcceder.href = `/reporte?folio=${respuesta.id}`;
    btnAcceder.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <p class="font-bold text-xs">Acceder</p>
      `;
    const divBtnCopiar = document.createElement("DIV");
    const btnCopiar = document.createElement("BUTTON");
    btnCopiar.className =
      "flex items-center justify-center w-full uppercase bg-cyan-600 text-font-light text-xs py-2 px-6 rounded-md shadow-md hover:bg-cyan-500 gap-2";
    btnCopiar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" /></svg>
        <p class="font-bold text-xs">Copiar</p>
      `;
    btnCopiar.onclick = () => copiarTexto(respuesta);

    divBtnAcceder.appendChild(btnAcceder);
    divBtnCopiar.appendChild(btnCopiar);

    divBotones.appendChild(divBtnAcceder);
    divBotones.appendChild(divBtnCopiar);

    divTipo.appendChild(divBotones);

    divBody.appendChild(divDatos);
    divBody.appendChild(divTipo);
    divNuevo.appendChild(divEncabezado);
    divNuevo.appendChild(divBody);
  }

  const copiarTexto = (obj) => {
    const text = `*Folio:* ${obj.id}\n*ID Usuario:* ${obj.id_user}\n*Nombre:* ${obj.name}\n*Teléfono:* ${obj.phone}\n*Direccion:* ${obj.address}\n*Emision:* ${formatDateText(obj.created)}\n*Categoria:* ${obj.id_category}\n*Incidencia:* ${obj.id_incidence}\n*Prioridad:* ${obj.id_priority}\n*Descripción:* ${obj.description}`;

    const copiado = navigator.clipboard.writeText(text);

    if (copiado) {
      Alerta.Toast.fire({
        title: "Exito",
        text: "Texto copiado al portapapeles",
        icon: "success",
      });
    }
  }

  const autocompletar = async (obj, div) => {
    const usuario = await GetDatos.consultar(`${location.origin}/api/usuario?id=${obj.id}`)
    inputNombre.value = `${usuario.user} ${usuario.lastname}`;
    inputID.value = usuario.id;
    inputDireccion.value = usuario.address;
    inputTelefono.value = usuario.phone === '0' ? 's/#' : usuario.phone;
    inputBeneficiario.value = 's/n';

    limpiarHTML(div);
  }

  const agregarOpciones = (selector, datos) => {
    datos.forEach(dato => {
      const option = document.createElement('OPTION');
      option.value = dato.id;
      option.textContent = dato.name;
      selector.appendChild(option)
    })
  }
})();
