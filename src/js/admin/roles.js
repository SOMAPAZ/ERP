import FetchDatos from "../classes/FetchDatos.js";
import Formulario from "../classes/Formulario.js";
import Modal from "../classes/Modal.js";
import PostDatos from "../classes/PostData.js";
import { limpiarHTML } from "../functions/funciones.js";

(() => {
  const tablaRoles = document.querySelector("#table-roles tbody");
  const btnAgregar = document.querySelector("#agregar-rol");
  let roles = [];
  let rolAct = {};

  document.addEventListener("DOMContentLoaded", () => {
    main();
    btnAgregar.addEventListener("click", () => {
      rolAct = {};
      mostrarFormulario(false);
    });
  });

  async function main() {
    roles = await FetchDatos.consultar("/api/roles");
    mostrarRoles();
  }

  function mostrarRoles() {
    limpiarHTML(tablaRoles);
    roles.forEach((role) => {
      const { id, name, description } = role;

      const row = document.createElement("TR");
      row.className =
        "whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";

      const tdID = document.createElement("TD");
      tdID.className =
        "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
      tdID.textContent = id;

      const tdName = document.createElement("TD");
      tdName.className = "px-6 py-4";
      tdName.textContent = name;

      const tdDescription = document.createElement("TD");
      tdDescription.className = "px-6 py-4";
      tdDescription.textContent = description;

      const tdActions = document.createElement("TD");
      tdActions.className = "py-2 px-6 flex flex-row items-center gap-2";

      const btnEdit = document.createElement("BUTTON");
      btnEdit.className =
        "flex items-center justify-center w-full uppercase text-xs py-1 px-3 rounded-md shadow-md bg-primary-base text-font-light hover:bg-primary-dark gap-2";

      btnEdit.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Editar</p>`;
      btnEdit.onclick = () => {
        rolAct = role;
        mostrarFormulario(true);
      };

      const btnDelete = document.createElement("BUTTON");
      btnDelete.className =
        "flex items-center justify-center w-full uppercase text-xs py-1 px-3 rounded-md shadow-md bg-red-600 text-font-light hover:bg-red-500 gap-2";

      btnDelete.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;

      btnDelete.onclick = () => {
        rolAct = role;
        confirmarEliminar();
      };

      tdActions.appendChild(btnEdit);
      tdActions.appendChild(btnDelete);

      row.appendChild(tdID);
      row.appendChild(tdName);
      row.appendChild(tdDescription);
      row.appendChild(tdActions);

      tablaRoles.appendChild(row);
    });
  }

  function mostrarFormulario(actualizar = false) {
    const formulario = document.createElement("FORM");
    formulario.className = "space-y-5 mb-5";
    const h3 = document.createElement("H3");
    h3.className = "text-lg font-medium text-gray-900 dark:text-white";
    h3.textContent = 'Ingrese los datos solicitados';
    const divAlerta = document.createElement('DIV');
    divAlerta.id = 'div-notif';
    
    formulario.appendChild(h3);
    formulario.appendChild(divAlerta);

    Formulario.crearInput(formulario,'Ingrese el rol', "text", "name", actualizar ? rolAct.name : null);
    Formulario.crearTextarea(formulario,'Descripción', "description", actualizar ? rolAct.description : null);

    actualizar ? Formulario.crearInput(formulario,'id', "hidden", "id", rolAct.id) : "";

    const btnSave = document.createElement('BUTTON');
    btnSave.className = 'text-white bg-orange-500 hover:bg-orange-900 font-medium rounded text-sm inline-flex items-center px-5 py-2 text-center';
    btnSave.textContent = 'Guardar';
    btnSave.onclick = (e) => {
      if(actualizar === false) {
        guardar(e);
      } else {
        update(e);
      }
    };

    Modal.renderModal(formulario, btnSave);
  }

  async function guardar(e) {
    const form = e.target.parentElement.parentElement.querySelector("form");
    const inputs = form.querySelectorAll(".input-form");
    const URL = '/api/rol';
    const resultado = await PostDatos.guardarDatos(URL, inputs);

    if (resultado.tipo === "Exito") {
      const modal = document.querySelector(".default-modal");
      if (modal) modal.remove();

      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      const rolObj = {
        id: resultado.rol.id,
        name: resultado.rol.name,
        description: resultado.rol.description,
      };

      roles = [...roles, rolObj];
      mostrarRoles();
    } else {
      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "error",
      });
    }
  }

  async function update(e) {
    const form = e.target.parentElement.parentElement.querySelector("form");
    const inputs = form.querySelectorAll(".input-form");
    const URL = '/api/rol-actualizar';
    const resultado = await PostDatos.guardarDatos(URL, inputs);

    if (resultado.tipo === "Exito") {
      const modal = document.querySelector(".default-modal");
      if (modal) modal.remove();
      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      roles = roles.map((rolMemoria) => {
        if (rolMemoria.id === rolAct.id) {
          rolMemoria.name = resultado.rol.name;
          rolMemoria.description = resultado.rol.description;
        }

        return rolMemoria;
      });

      mostrarRoles();
    } else {
      Swal.fire({
        title: "error",
        text: "Hubo un error al actualizar este rol",
        icon: "error",
      });
    }
  }

  async function eliminar() {
    const URL = '/api/rol-eliminar';
    const resultado = await PostDatos.eliminarDatos(URL, rolAct.id);
    
    if (resultado.tipo === "Exito") {
      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      roles = roles.filter((rolMemoria) => rolMemoria.id !== rolAct.id);

      mostrarRoles();
    }
  }

  function confirmarEliminar() {
    Swal.fire({
      title: `¿Estás seguro de eliminar el rol "${rolAct.name}"?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, continuar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminar();
      }
    });
  }
})();
