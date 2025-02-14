(() => {
  const inputNombre = document.querySelector("#nombre");
  const inputID = document.querySelector("#idUser");
  const inputDireccion = document.querySelector("#direccion");
  const inputTelefono = document.querySelector("#telefono");
  const inputBeneficiario = document.querySelector("#beneficiario");
  const inputDescripcion = document.querySelector("#descripcion");

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
  let incidencias = [];

  document.addEventListener("DOMContentLoaded", () => {
    consultarUsuarios();
    consultarCategorias();
    consultarPrioridades();

    inputNombre.addEventListener("input", coincidenciaNombre);
    inputID.addEventListener("input", coincidenciaID);
    selectCategoria.addEventListener("change", coincidenciaCategoria);

    btnResetear.addEventListener("click", resetear);
    formulario.addEventListener("submit", enviarReporte);
  });

  async function consultarUsuarios() {
    try {
      const URL = `${location.origin}/api/usuarios`;
      const response = await fetch(URL);
      const resultado = await response.json();

      usuarios = resultado;
    } catch (error) {
      console.log(error);
    }
  }

  async function consultarCategorias() {
    try {
      const URL = `${location.origin}/api/categorias`;
      const response = await fetch(URL);
      const resultado = await response.json();
      categorias = resultado;

      const emptyOption = document.createElement("OPTION");
      emptyOption.value = "";
      emptyOption.textContent = "- Seleccione una categoría -";
      selectCategoria.appendChild(emptyOption);

      resultado.forEach((categoria) => {
        const { id, name } = categoria;
        const option = document.createElement("OPTION");
        option.value = id;
        option.textContent = name;
        selectCategoria.appendChild(option);
      });
    } catch (error) {
      console.log(error);
    }
  }

  async function consultarIncidencias(id_categoria) {
    const datos = new FormData();
    datos.append("id_category", id_categoria);

    try {
      const URL = `${location.origin}/api/incidencias`;
      const response = await fetch(URL, {
        method: "POST",
        body: datos,
      });

      const resultado = await response.json();
      incidencias = resultado.datos;

      if (resultado.tipo === "error") {
        selectIncidencia.setAttribute("disabled", "disabled");
        return;
      }

      mostrarIncidencias(resultado.datos);
    } catch (error) {
      console.log(error);
    }
  }

  async function consultarPrioridades() {
    try {
      const URL = `${location.origin}/api/prioridades`;
      const response = await fetch(URL);
      const resultado = await response.json();
      prioridades = resultado;

      const emptyOption = document.createElement("OPTION");
      emptyOption.value = "";
      emptyOption.textContent = "- Seleccione una prioridad -";
      selectPrioridad.appendChild(emptyOption);

      resultado.forEach((prioridad) => {
        const { id, name } = prioridad;
        const option = document.createElement("OPTION");
        option.value = id;
        option.textContent = name;
        selectPrioridad.appendChild(option);
      });
    } catch (error) {
      console.log(error);
    }
  }

  async function enviarReporte(e) {
    e.preventDefault();

    const nombre = inputNombre.value.trim();
    const idUser = inputID.value.trim();
    const direccion = inputDireccion.value.trim();
    const telefono = inputTelefono.value.trim();
    const beneficiario = inputBeneficiario.value.trim();
    const categoria = selectCategoria.value.trim();
    const incidencia = selectIncidencia.value.trim();
    const prioridad = selectPrioridad.value.trim();
    const descripcion = inputDescripcion.value.trim();

    const reporteObj = {
      nombre,
      direccion,
      categoria,
      incidencia,
      prioridad,
      descripcion,
    };

    if (Object.values(reporteObj).some((v) => v === "")) {
      mostrarAlerta(
        "Los campos: Nombre, Dirección, Categoria, Incidencia, Prioridad y Descripción son requeridos"
      );
      return;
    }

    const datos = new FormData();

    datos.append("id_user", idUser);
    datos.append("name", nombre);
    datos.append("phone", telefono);
    datos.append("address", direccion);
    datos.append("id_beneficiary", beneficiario);
    datos.append("id_category", categoria);
    datos.append("id_incidence", incidencia);
    datos.append("id_priority", prioridad);
    datos.append("description", descripcion);

    try {
      const URL = `${location.origin}/api/reporte`;
      const response = await fetch(URL, {
        method: "POST",
        body: datos,
      });

      const resultado = await response.json();

      if (resultado.tipo === "Exito") {
        formulario.reset();

        Swal.fire({
          title: resultado.tipo,
          text: resultado.mensaje,
          icon: "success",
        });

        mostrarNuevo(resultado, reporteObj);
      }
    } catch (error) {
      console.log(error);
    }
  }

  function mostrarAlerta(mensaje) {
    const divAlerta = document.createElement("DIV");

    divAlerta.className =
      "rounded border-s-4 mt-6 border-red-500 bg-red-50 p-4 dark:border-red-600 dark:bg-red-900 alerta";
    divAlerta.innerHTML = `<strong class="block font-medium text-red-700 dark:text-red-200">${mensaje}</strong>`;

    document.querySelector(".alerta")?.remove();

    formulario.parentElement.insertBefore(divAlerta, formulario);

    setTimeout(() => {
      divAlerta.remove();
    }, 5000);
  }

  function coincidenciaNombre() {
    limpiarAnterior(divListado);
    usuarios.forEach((usuario) => {
      const { nombre } = usuario;
      const valor = nombre.toLowerCase();
      const coincidencia = inputNombre.value.trim().toLowerCase();

      if (coincidencia === "") return;

      if (valor.includes(coincidencia)) {
        const li = document.createElement("LI");
        li.classList.add(
          "block",
          "rounded-lg",
          "bg-gray-100",
          "px-4",
          "py-2",
          "text-sm",
          "font-medium",
          "text-gray-700",
          "dark:bg-gray-800",
          "dark:text-gray-200",
          "uppercase",
          "cursor-pointer"
        );
        li.onclick = function () {
          autocompletar(usuario, divListado);
        };

        li.textContent = nombre;

        divListado.appendChild(li);
      }
    });
  }

  function coincidenciaID() {
    limpiarAnterior(divListadoID);

    usuarios.forEach((usuario) => {
      const { id, nombre } = usuario;
      const valor = id;
      const coincidencia = inputID.value;

      if (coincidencia === "") return;

      if (valor.includes(coincidencia)) {
        const li = document.createElement("LI");
        li.classList.add(
          "block",
          "rounded-lg",
          "bg-gray-100",
          "px-4",
          "py-2",
          "text-sm",
          "font-medium",
          "text-gray-700",
          "dark:bg-gray-800",
          "dark:text-gray-200",
          "uppercase",
          "cursor-pointer"
        );
        li.onclick = function () {
          autocompletar(usuario, divListadoID);
        };

        li.textContent = `${id} - ${nombre}`;
        divListadoID.appendChild(li);
      }
    });
  }

  function coincidenciaCategoria(e) {
    const id_categoria = e.target.value;

    if (id_categoria === "") {
      selectIncidencia.setAttribute("disabled", "disabled");
      limpiarAnterior(selectIncidencia);
      return;
    }

    selectIncidencia.removeAttribute("disabled");

    consultarIncidencias(id_categoria);
  }

  function mostrarIncidencias(incidencias) {
    limpiarAnterior(selectIncidencia);

    const emptyOption = document.createElement("OPTION");
    emptyOption.value = "";
    emptyOption.textContent = "- Seleccione una incidencia -";
    selectIncidencia.appendChild(emptyOption);

    incidencias.forEach((incidencia) => {
      const { id, name } = incidencia;
      const option = document.createElement("OPTION");
      option.value = id;
      option.textContent = name;
      selectIncidencia.appendChild(option);
    });
  }

  function mostrarNuevo(res, obj) {
    limpiarAnterior(divNuevo);
    const divEncabezado = document.createElement("DIV");
    divEncabezado.className = "grid grid-cols-2 gap-4";

    const linkReporte = document.createElement("A");
    linkReporte.className =
      "text-xl font-extrabold text-gray-900 dark:text-white uppercase hover:underline";
    linkReporte.href = `/reporte?folio=${res.folio}`;
    linkReporte.innerHTML = `Folio: <span class="font-semibold ms-2">${res.folio}</span>`;

    const prioridad = prioridades.filter(
      (prioridadMem) => prioridadMem.id === res.prioridad
    );

    const categoria = categorias.filter(
      (categoriaMem) => categoriaMem.id === obj.categoria
    );

    const incidencia = incidencias.filter(
      (incidenciaMem) => incidenciaMem.id === obj.incidencia
    );

    const prior = [...prioridad].shift();
    const incs = [...incidencia].shift();
    const cat = [...categoria].shift();

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
            Usuario: <span class="font-normal text-gray-500 dark:text-gray-400">${obj.nombre}</span>
        </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
        <p class="block font-bold py-1">
            Dirección: <span class="font-normal text-gray-500 dark:text-gray-400">${obj.direccion}</span>
        </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
        <p class="block font-bold py-1"> Fecha emisión: 
          <span class="font-normal text-gray-500 dark:text-gray-400">${res.fecha}</span>
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
                  ${cat.name}
              </span>
          </p>
      </div>
      <div class="flex flex-col md:flex-row md:gap-2">
          <p class="block font-bold py-1">
              Incidencia:
              <span class="font-normal text-gray-500 dark:text-gray-400">
                ${incs.name}
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
    btnAcceder.href = `/reporte?folio=${res.folio}`;
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
    btnCopiar.onclick = () => {
      copiarTexto(res, obj, prior, incs, cat);
    };

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

  function copiarTexto(res, obj, prior, incs, cat) {
    const text = `Folio: ${res.folio}\nID Usuario: ${res.idUser}\nNombre: ${obj.nombre}\nDireccion: ${obj.direccion}\nEmision: ${res.fecha}\nCategoria: ${cat.name}\nIncidencia: ${incs.name}\nPrioridad: ${prior.name}`;

    const copiado = navigator.clipboard.writeText(text);

    if (copiado) {
      Swal.fire({
        title: "Exito",
        text: "Texto copiado al portapapeles",
        icon: "success",
      });
    }
  }

  function resetear() {
    inputNombre.value = "";
    inputID.value = "";
    inputDireccion.value = "";
    inputTelefono.value = "";
    inputBeneficiario.value = "";

    limpiarAnterior(divListado);
    limpiarAnterior(divListadoID);
  }

  function autocompletar(usuario, div) {
    inputNombre.value = usuario.nombre;
    inputID.value = usuario.id;
    inputDireccion.value = usuario.direccion;
    inputTelefono.value = usuario.telefono;
    inputBeneficiario.value = null;

    limpiarAnterior(div);
  }

  function limpiarAnterior(div) {
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
  }
})();
