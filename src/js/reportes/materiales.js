(() => {
  const btnAgregarMateriales = document.querySelector("#btn-add-material");
  const contenedorMateriales = document.querySelector("#render-materiales");
  let materiales = [];
  let unidades = [];
  let materialRep = [];
  let unidad;

  document.addEventListener("DOMContentLoaded", () => {
    obtenerMateriales();
    obtenerUnidades();
    obtenerMatRep();

    btnAgregarMateriales.addEventListener("click", () => {
      mostrarModal();
    });
  });

  async function obtenerMateriales() {
    try {
      const URL = `${location.origin}/api/materiales`;
      const response = await fetch(URL);
      const resultado = await response.json();
      materiales = resultado;
    } catch (error) {
      console.log(error);
    }
  }

  async function obtenerUnidades() {
    try {
      const URL = `${location.origin}/api/unidades`;
      const response = await fetch(URL);
      const resultado = await response.json();
      unidades = resultado;
    } catch (error) {
      console.log(error);
    }
  }

  async function obtenerMatRep() {
    const formData = new FormData();
    formData.append("id_report", obtenerFolio());

    try {
      const URL = `${location.origin}/api/materiales-reportes`;
      const response = await fetch(URL, {
        method: "POST",
        body: formData,
      });
      const resultado = await response.json();
      materialRep = resultado;

      renderizarMaterialesUtilizados();
    } catch (error) {
      console.log(error);
    }
  }

  function mostrarModal() {
    const bgModal = document.createElement("DIV");
    bgModal.className =
      "overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-800 bg-opacity-50 dark:bg-opacity-80 modal-form";

    const contenedorModal = document.createElement("DIV");
    contenedorModal.className =
      "relative p-4 w-full max-w-2xl mx-auto mt-20 max-h-full";

    const contenido = document.createElement("DIV");
    contenido.className =
      "relative bg-white rounded-lg shadow dark:bg-gray-700";

    const header = document.createElement("DIV");
    header.className =
      "flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600";
    const h3 = document.createElement("H3");
    h3.className = "text-xl font-semibold text-gray-900 dark:text-white";
    h3.textContent = "Añadir información";
    header.appendChild(h3);

    //Contenido
    const bodyModal = document.createElement("DIV");
    bodyModal.className = "p-4 md:p-5 space-y-4";

    const formulario = document.createElement("FORM");
    formulario.id = "formulario-add-material";
    formulario.setAttribute("autocomplete", "off");

    const divContainer = document.createElement("DIV");
    divContainer.className = "flex flex-col gap-6";

    //
    const materialDiv = document.createElement("DIV");

    const labelMaterial = document.createElement("LABEL");
    labelMaterial.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
    labelMaterial.for = "material";
    labelMaterial.textContent = "Ingrese el material";

    const inputMaterial = document.createElement("INPUT");
    inputMaterial.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase";
    inputMaterial.type = "text";
    inputMaterial.name = "material";
    inputMaterial.id = "material";
    inputMaterial.placeholder = "Ingrese el material";
    inputMaterial.oninput = coincidirMaterial;

    materialDiv.appendChild(labelMaterial);
    materialDiv.appendChild(inputMaterial);

    const divAdd = document.createElement("DIV");
    divAdd.id = "contenedorMateriales";

    materialDiv.appendChild(divAdd);

    divContainer.appendChild(materialDiv);
    //

    generarInputs(divContainer, "number", "cantidad");

    //
    const divUnidad = document.createElement("DIV");
    const labelUnidad = document.createElement("LABEL");
    labelUnidad.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelUnidad.for = "unidad";
    labelUnidad.textContent = "Ingrese la unidad";

    const inputUnidad = document.createElement("SELECT");
    inputUnidad.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase";
    inputUnidad.name = "unidad";
    inputUnidad.id = "unidad";

    const emptyOption = document.createElement("OPTION");
    emptyOption.value = "";
    emptyOption.textContent = "- Seleccione una unidad -";
    inputUnidad.appendChild(emptyOption);
    unidades.forEach((unidad) => {
      const { id, name } = unidad;
      const option = document.createElement("OPTION");
      option.value = id;
      option.textContent = name;
      inputUnidad.appendChild(option);
    });

    divUnidad.appendChild(labelUnidad);
    divUnidad.appendChild(inputUnidad);

    divContainer.appendChild(divUnidad);
    //

    formulario.appendChild(divContainer);

    const footer = document.createElement("DIV");
    footer.className =
      "flex items-center justify-end gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600";

    const btnAgregar = document.createElement("BUTTON");
    btnAgregar.className =
      "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";
    btnAgregar.textContent = "Agregar";

    btnAgregar.onclick = guardarMateriales;

    const btnCancelar = document.createElement("BUTTON");
    btnCancelar.className =
      "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800";

    btnCancelar.textContent = "Cancelar";
    btnCancelar.onclick = () => document.querySelector(".modal-form")?.remove();

    bodyModal.appendChild(formulario);

    footer.appendChild(btnCancelar);
    footer.appendChild(btnAgregar);

    contenido.appendChild(header);
    contenido.appendChild(bodyModal);
    contenido.appendChild(footer);

    contenedorModal.appendChild(contenido);
    bgModal.appendChild(contenedorModal);
    document.querySelector("main").appendChild(bgModal);
  }

  function coincidirMaterial(e) {
    const valorInput = e.target.value.trim();
    if (valorInput === "") {
      const divAdd = document.querySelector("#contenedorMateriales");
      limpiarAnterior(divAdd);
      return;
    }

    const coincidencias = [...materiales].filter((material) =>
      material.name.includes(valorInput)
    );

    renderizarCoincidencias(coincidencias);
  }

  function renderizarCoincidencias(coincidencias) {
    const divAdd = document.querySelector("#contenedorMateriales");

    limpiarAnterior(divAdd);
    const ul = document.createElement("UL");
    ul.classList.add("space-y-1", "z-40", "mt-2");
    if (coincidencias.length === 0) {
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
      li.textContent = "Sin coincidencias";
      li.onclick = () => {
        limpiarAnterior(divAdd);
      };
      ul.appendChild(li);

      divAdd.appendChild(ul);
      return;
    }
    coincidencias.forEach((coincidencia) => {
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
        autocompletar(coincidencia, divAdd);
        unidad = coincidencia.id;
      };

      li.textContent = coincidencia.name;
      ul.appendChild(li);

      divAdd.appendChild(ul);
    });
  }

  function renderizarMaterialesUtilizados() {
    limpiarAnterior(contenedorMateriales);
    if (materialRep.length === 0) {
      contenedorMateriales.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400 col-span-2">No hay materiales registrados</p>`;
      return;
    }
    materialRep.forEach((mat) => {
      const { cantidad, unidad, material } = mat;
      console.log(mat);

      const div = document.createElement("DIV");
      div.className =
        "bg-gray-100 dark:bg-gray-800 rounded flex p-4 h-full items-center text-xs";
      div.innerHTML = `                    
      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-400 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path><path d="M22 4L12 14.01l-3-3"></path></svg>
      `;

      const span = document.createElement("SPAN");
      span.className = "title-font font-medium text-gray-800 dark:text-white";
      span.textContent = `${cantidad} ${unidad} de ${material}`;

      div.appendChild(span);

      contenedorMateriales.appendChild(div);
    });
  }

  async function guardarMateriales(e) {
    const padre = e.target.parentElement.parentElement;
    const mat = padre.querySelector("#material").value.trim();
    const uni = padre.querySelector("#unidad").value.trim();
    const cant = padre.querySelector("#cantidad").value.trim();

    if (mat === "" || uni === "" || cant === "") {
      mostrarAlerta("Todos los campos son obligatorios");
      return;
    }

    const datos = new FormData();
    datos.append("id_report", obtenerFolio());
    datos.append("id_material", unidad);
    datos.append("id_unity", uni);
    datos.append("quantity", cant);

    try {
      const URL = `${location.origin}/api/material`;
      const response = await fetch(URL, {
        method: "POST",
        body: datos,
      });
      const resultado = await response.json();

      console.log(resultado);
      if (resultado.tipo === "Exito") {
        Swal.fire({
          title: resultado.tipo,
          text: resultado.mensaje,
          icon: "success",
        });

        const modal = document.querySelector(".modal-form");
        if (modal) modal.remove();

        const materialObj = {
          cantidad: cant,
          id_report: obtenerFolio(),
          unidad: resultado.unidad,
          material: resultado.material,
        };

        console.log(materialObj);

        materialRep = [...materialRep, materialObj];

        renderizarMaterialesUtilizados();
      }
    } catch (error) {
      console.log(error);
    }
  }

  function generarInputs(div, tipo, data) {
    const inputDiv = document.createElement("DIV");

    const label = document.createElement("LABEL");
    label.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
    label.for = data;
    label.textContent = data;

    const input = document.createElement("INPUT");
    input.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase";
    input.type = tipo;
    input.name = data;
    input.id = data;
    input.placeholder = `Ingrese ${data}`;

    inputDiv.appendChild(label);
    inputDiv.appendChild(input);

    div.appendChild(inputDiv);
  }

  function autocompletar(coincidencia, div) {
    limpiarAnterior(div);
    const input = div.parentElement.querySelector("INPUT");
    input.value = coincidencia.name;
  }

  function limpiarAnterior(div) {
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
  }

  function mostrarAlerta(mensaje) {
    const divAlerta = document.createElement("DIV");

    divAlerta.className =
      "rounded border-s-4 mt-3 border-red-500 bg-red-50 p-4 dark:border-red-600 dark:bg-red-900 alerta";
    divAlerta.innerHTML = `<strong class="block font-medium text-red-700 dark:text-red-200">${mensaje}</strong>`;

    document.querySelector(".alerta")?.remove();

    const formulario = document.querySelector("#formulario-add-material");

    formulario.parentElement.insertBefore(divAlerta, formulario);

    setTimeout(() => {
      divAlerta.remove();
    }, 5000);
  }

  function obtenerFolio() {
    const folioParams = new URLSearchParams(window.location.search);
    const report = Object.fromEntries(folioParams.entries());
    return report.folio;
  }
})();
