import GetDatos from "../classes/GetData.js"
import Modal from "../classes/Modal.js"
import PostDatos from "../classes/PostData.js"
import Alerta from "../classes/Alerta.js"
import { getSearch, limpiarHTML } from "../helpers/index.js"

(() => {
  const btnAgregarMateriales = document.querySelector("#btn-add-material");
  const contenedorMateriales = document.querySelector("#render-materiales");
  let materiales = [];
  let unidades = [];
  let materialRep = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();
    btnAgregarMateriales.addEventListener("click", () => mostrarModal());
  });

  const obtenerDatos = async () => {
    [materiales, unidades, materialRep] = await Promise.all([
      GetDatos.consultar(`${location.origin}/api/materiales`),
      GetDatos.consultar(`${location.origin}/api/unidades`),
      GetDatos.consultar(`${location.origin}/api/materiales-reportes?id_report=${getSearch().folio}`)
    ])

    renderizarMaterialesUtilizados();
  }

  const mostrarModal = () => {
    //Contenido
    const bodyModal = document.createElement("DIV");
    bodyModal.className = "p-4 md:p-5 space-y-4";

    const formulario = document.createElement("FORM");
    formulario.id = "formulario-add-material";
    formulario.setAttribute("autocomplete", "off");

    const divContainer = document.createElement("DIV");
    divContainer.className = "flex flex-col gap-6";

    const h3 = document.createElement("H3");
    h3.className = "text-lg font-medium text-gray-900 dark:text-white mb-5";
    h3.textContent = 'Ingrese los datos solicitados';
    const divAlerta = document.createElement('DIV');
    divAlerta.id = 'div-notif';
    
    formulario.appendChild(h3);
    formulario.appendChild(divAlerta);
    
    const inputFolio = document.createElement('INPUT')
    inputFolio.value = getSearch().folio;
    inputFolio.classList.add('hidden', 'input-form')
    inputFolio.name = 'id_report'

    //
    const materialDiv = document.createElement("DIV");

    const labelMaterial = document.createElement("LABEL");
    labelMaterial.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
    labelMaterial.for = "material";
    labelMaterial.textContent = "Ingrese el material";

    const inputMaterial = document.createElement("INPUT");
    inputMaterial.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-form";
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

    generarInputs(divContainer, "number", "quantity");

    //
    const divUnidad = document.createElement("DIV");
    const labelUnidad = document.createElement("LABEL");
    labelUnidad.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelUnidad.for = "unidad";
    labelUnidad.textContent = "Ingrese la unidad";

    const inputUnidad = document.createElement("SELECT");
    inputUnidad.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-form";
    inputUnidad.name = "id_unity";
    inputUnidad.id = "unidad";

    const emptyOption = document.createElement("OPTION");
    emptyOption.value = "";
    emptyOption.textContent = "- Seleccione una unidad -";
    inputUnidad.appendChild(emptyOption);
    unidades.forEach((u) => {
      const { id, name } = u;
      const option = document.createElement("OPTION");
      option.value = id;
      option.textContent = name;
      inputUnidad.appendChild(option);
    });

    divUnidad.appendChild(labelUnidad);
    divUnidad.appendChild(inputUnidad);

    divContainer.appendChild(divUnidad);
    //
    formulario.appendChild(inputFolio);
    formulario.appendChild(divContainer);

    const btnAgregar = document.createElement("BUTTON");
    btnAgregar.className = "text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ";
    btnAgregar.textContent = "Agregar";

    btnAgregar.onclick = guardarMateriales;

    bodyModal.appendChild(formulario);
    Modal.renderModal(bodyModal, btnAgregar)
  }

  const coincidirMaterial = (e) => {
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

  const renderizarCoincidencias = (coincidencias) => {
    const divAdd = document.querySelector("#contenedorMateriales");
    limpiarHTML(divAdd);

    const ul = document.createElement("UL");
    ul.classList.add("space-y-1", "z-40", "mt-2");
    if (coincidencias.length === 0) {
      const li = document.createElement("LI");
      li.className = "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer"
      li.textContent = "Sin coincidencias";
      li.onclick = () => limpiarHTML(divAdd);
      ul.appendChild(li);

      divAdd.appendChild(ul);
      return;
    }

    coincidencias.forEach((coincidencia) => {
      const li = document.createElement("LI");
      li.className = "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";
      li.onclick = function () {
        autocompletar(coincidencia, divAdd);
      };

      li.textContent = coincidencia.name;
      ul.appendChild(li);

      divAdd.appendChild(ul);
    });
  }

  const renderizarMaterialesUtilizados = () => {
    limpiarHTML(contenedorMateriales);


    if (materialRep.length === 0) {
      contenedorMateriales.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400 mt-5">No hay materiales registrados</p>`;
      return;
    }

    materialRep.forEach((mat) => {
      const { quantity, id_unity, material } = mat;
      const contenedorMat = document.createElement("DIV");
      contenedorMat.className = "w-full flex flex-col sm:flex-row sm:justify-betweenn gap-4 p-2 sm:items-center bg-white dark:bg-gray-800 dark:border-gray-700";

      const div = document.createElement("DIV");
      div.className = "sm:w-3/4 md:w-4/6 lg:w-3/4 bg-white dark:bg-gray-800 flex p-4 items-center";
      const paragraph = document.createElement("P");
      paragraph.className = "font-medium text-gray-800 dark:text-white";
      paragraph.textContent = `${quantity} ${id_unity} de ${material}`;

      div.appendChild(paragraph);

      const divBtns = document.createElement('DIV');
      divBtns.className = "sm:w-1/4 md:w-2/6 lg:w-1/4 flex flex-col gap-2 lg:flex-row justify-end"

      const btnEliminar = document.createElement("BUTTON");
      btnEliminar.className = "w-full lg:w-auto px-2 py-2 md:py-1 text-xs leadindg-5 font-semibold rounded cursor-pointer bg-red-200 text-red-800 flex flew-row flex-nowrap items-center justify-center gap-2 uppercase hover:bg-red-300";
      btnEliminar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;
      btnEliminar.onclick = () => confirmarEliminar(mat);

      divBtns.appendChild(btnEliminar)

      contenedorMat.appendChild(div);
      contenedorMat.appendChild(divBtns);
      contenedorMateriales.appendChild(contenedorMat);
    });
  }

  const guardarMateriales = async () => {
    const URL = `${location.origin}/api/material`;
    const inputs = document.querySelectorAll('.input-form');

    const res = await PostDatos.guardarDatos(URL, inputs);

    if (res.tipo === "Exito") {
      Alerta.Toast.fire({
        title: res.tipo,
        text: res.mensaje,
        icon: "success",
      });

      const modal = document.querySelector(".default-modal");
      if (modal) modal.remove();

      const materialObj = {
        id: res.id,
        quantity: res.cantidad,
        id_report: getSearch().folio,
        id_unity: res.unidad,
        material: res.material,
      };

      materialRep = [...materialRep, materialObj];
      renderizarMaterialesUtilizados();
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
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-form";
    input.type = tipo;
    input.name = data;
    input.id = data;
    input.placeholder = `Ingrese ${data}`;

    inputDiv.appendChild(label);
    inputDiv.appendChild(input);

    div.appendChild(inputDiv);
  }

  const autocompletar = (coincidencia, div) => {
    limpiarHTML(div);
    const input = div.parentElement.querySelector("INPUT");
    input.value = coincidencia.name;
  }

  const confirmarEliminar = (mat) => {
    Swal.fire({
      title: `¿Estás seguro de eliminar el material?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarMaterial(mat);
      }
    });
  }

  const eliminarMaterial = async (mat) => {
    const URL = `${location.origin}/api/material/eliminar`;
    const res = await PostDatos.eliminarDatos(URL, mat.id);

    if(res.tipo === 'Exito') {
      Alerta.Toast.fire({
        icon: 'success',
        title: 'Proceso exitoso',
        text: res.mensaje
      })
      materialRep = [...materialRep].filter( m => (m.id).toString() !== (res.id).toString())
      renderizarMaterialesUtilizados();
    } else {
      Alerta.Toast.fire({
        icon: 'error',
        title: 'Upss!',
        text: 'Ocurrio un error'
      })
    }
  }
})();
