import Notificacion from "../classes/Notificacion.js";
import FetchDatos from "../classes/FetchDatos.js";
import { limpiarHTML } from "../functions/funciones.js";

(() => {
  const tablaEmpelados = document.querySelector("#table-employees tbody");
  const btnAgregar = document.querySelector("#agregar-empleado");
  let empleados = [];
  let roles = [];

  document.addEventListener("DOMContentLoaded", () => {
    main();
    obtenerRols();
    btnAgregar.addEventListener("click", () => {
      mostrarModal({}, true);
    });
  });

  async function main() {
    empleados = await FetchDatos.consultar(
      `${location.origin}/api/empleados`
    );
    mostrarEmpleados();
  }

  async function obtenerRols() {
    roles = await FetchDatos.consultar(`${location.origin}/api/roles`);
  }

  function mostrarEmpleados() {
    limpiarHTML(tablaEmpelados);
    empleados.forEach((empleado) => {
      const { id, nombre, apellido, correo, telefono, rol } = empleado;

      const row = document.createElement("TR");
      row.className =
        "whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";

      const tdID = document.createElement("TD");
      tdID.className =
        "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
      tdID.textContent = id;

      const tdName = document.createElement("TD");
      tdName.className = "px-6 py-4";
      tdName.textContent = `${nombre} ${apellido}`;

      const tdCorreo = document.createElement("TD");
      tdCorreo.className = "px-6 py-4";
      tdCorreo.textContent = correo;

      const tdTelefono = document.createElement("TD");
      tdTelefono.className = "px-6 py-4";
      tdTelefono.textContent = telefono;

      const tdRol = document.createElement("TD");
      tdRol.className = "px-6 py-4";
      tdRol.textContent = rol;

      const tdActions = document.createElement("TD");
      tdActions.className = "py-2 px-6 flex flex-row items-center gap-2";

      const btnEdit = document.createElement("BUTTON");
      btnEdit.className =
        "flex items-center justify-center w-full uppercase text-xs py-1 px-3 rounded-md shadow-md bg-primary-base text-font-light hover:bg-primary-dark gap-2";

      btnEdit.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="font-bold text-xs">Editar</p>
            `;
      btnEdit.onclick = () => {
        mostrarModal(empleado);
      };

      const btnDelete = document.createElement("BUTTON");
      btnDelete.className =
        "flex items-center justify-center w-full uppercase text-xs py-1 px-3 rounded-md shadow-md bg-red-600 text-font-light hover:bg-red-500 gap-2";

      btnDelete.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="font-bold text-xs">Eliminar</p>
            `;

      btnDelete.onclick = () => {
        confirmarEliminar(empleado);
      };

      tdActions.appendChild(btnEdit);
      tdActions.appendChild(btnDelete);

      row.appendChild(tdID);
      row.appendChild(tdName);
      row.appendChild(tdCorreo);
      row.appendChild(tdTelefono);
      row.appendChild(tdRol);
      row.appendChild(tdActions);

      tablaEmpelados.appendChild(row);
    });
  }

  function mostrarModal(empleado = {}, agregar = false) {
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
    h3.textContent = "Actualizar datos";
    header.appendChild(h3);

    const divNotificaciones = document.createElement("DIV");
    divNotificaciones.classList.add("errorVacio");

    //Contenido
    const bodyModal = document.createElement("DIV");
    bodyModal.className = "p-4 md:p-5 space-y-4";

    const formulario = document.createElement("FORM");
    formulario.className = "grid gap-6 mb-6 md:grid-cols-2 form-empleados";

    if (agregar) {
      crearInput(formulario, "text", "nombre");
      crearInput(formulario, "text", "apellido");
      crearInput(formulario, "email", "mail");
      crearInput(formulario, "tel", "telefono");
      crearInput(formulario, "password", "password");
    } else {
      crearInput(formulario, "text", "nombre", empleado.nombre);
      crearInput(formulario, "text", "apellido", empleado.apellido);
      crearInput(formulario, "email", "mail", empleado.correo);
      crearInput(formulario, "tel", "telefono", empleado.telefono);
    }

    const divSelect = document.createElement("DIV");

    const label = document.createElement("LABEL");
    label.for = "role";
    label.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
    label.textContent = "Seleccione un rol";

    const select = document.createElement("SELECT");
    select.name = "role";
    select.id = "role";
    select.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
    const optionVacio = document.createElement("OPTION");
    optionVacio.value = "";
    optionVacio.textContent = "- Seleccione un rol -";
    optionVacio.selected = true;
    select.appendChild(optionVacio);

    roles.forEach((rol) => {
      const option = document.createElement("OPTION");
      option.value = rol.id;
      option.textContent = rol.name;
      if (rol.name === empleado.rol) option.selected = true;
      select.appendChild(option);
    });

    divSelect.appendChild(label);
    divSelect.appendChild(select);
    formulario.appendChild(divSelect);
    //Contenido

    const footer = document.createElement("DIV");
    footer.className =
      "flex items-center justify-end gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600";

    const btnActualizar = document.createElement("BUTTON");
    btnActualizar.className =
      "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";

    agregar
      ? (btnActualizar.textContent = "Agregar")
      : (btnActualizar.textContent = "Actualizar");

    btnActualizar.onclick = () => {
      if (agregar) {
        guardar();
      } else {
        actualizar(empleado);
      }
    };

    const btnCancelar = document.createElement("BUTTON");
    btnCancelar.className =
      "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800";

    btnCancelar.textContent = "Cancelar";
    btnCancelar.onclick = () => document.querySelector(".modal-form")?.remove();

    bodyModal.appendChild(formulario);

    footer.appendChild(btnCancelar);
    footer.appendChild(btnActualizar);

    contenido.appendChild(header);
    contenido.appendChild(divNotificaciones);
    contenido.appendChild(bodyModal);
    contenido.appendChild(footer);

    contenedorModal.appendChild(contenido);
    bgModal.appendChild(contenedorModal);
    document.querySelector("main").appendChild(bgModal);
  }

  function crearInput(posicion, tipo, atributo, valor = "") {
    const div = document.createElement("DIV");

    const label = document.createElement("LABEL");
    label.for = atributo;
    label.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
    label.textContent = atributo;

    const input = document.createElement("INPUT");
    input.type = tipo;
    input.name = atributo;
    input.id = atributo;
    input.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white";
    if (valor === "") {
      input.placeholder = `Tu ${atributo}`;
    } else {
      input.value = valor;
    }

    div.appendChild(label);
    div.appendChild(input);
    posicion.appendChild(div);
  }

  async function guardar() {
    const nombre = document.querySelector("#nombre").value.trim();
    const apellido = document.querySelector("#apellido").value.trim();
    const correo = document.querySelector("#mail").value.trim();
    const telefono = document.querySelector("#telefono").value.trim();
    const password = document.querySelector("#password").value.trim();
    const rol = document.querySelector("#role").value.trim();

    if (
      nombre === "" ||
      apellido === "" ||
      correo === "" ||
      telefono === "" ||
      password === "" ||
      rol === ""
    ) {
      new Notificacion({
        msg: "Los campos no pueden estar vacíos",
        position: document.querySelector(".errorVacio"),
      });
      return;
    }

    const datos = new FormData();
    datos.append("name", nombre);
    datos.append("lastname", apellido);
    datos.append("mail", correo);
    datos.append("phone", telefono);
    datos.append("password", password);
    datos.append("id_rol", rol);

    try {
      const URL = `${location.origin}/api/empleado`;
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

        const empleadoObj = {
          id: String(resultado.id),
          nombre: nombre,
          apellido: apellido,
          correo: correo,
          telefono: telefono,
          rol: resultado.rol,
        };

        empleados = [...empleados, empleadoObj];
        mostrarEmpleados();
      } else {
        Swal.fire({
          title: resultado.tipo,
          text: resultado.mensaje,
          icon: "error",
        });
      }
    } catch (error) {
      console.log(error);
    }
  }

  async function actualizar(empleado) {
    const nombre = document.querySelector("#nombre").value.trim();
    const apellido = document.querySelector("#apellido").value.trim();
    const correo = document.querySelector("#mail").value.trim();
    const telefono = document.querySelector("#telefono").value.trim();
    const rol = document.querySelector("#role").value;

    if (
      nombre === "" ||
      apellido === "" ||
      correo === "" ||
      telefono === "" ||
      rol === ""
    ) {
      new Notificacion({
        msg: "Los campos no pueden estar vacíos",
        position: document.querySelector(".errorVacio"),
      });
      return;
    }

    const datos = new FormData();
    datos.append("id", empleado.id);
    datos.append("name", nombre);
    datos.append("lastname", apellido);
    datos.append("mail", correo);
    datos.append("phone", telefono);
    datos.append("id_rol", rol);

    try {
      const URL = `${location.origin}/api/empleado-actualizar`;
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

        const modal = document.querySelector(".modal-form");
        if (modal) modal.remove();

        empleados = empleados.map((empleadoMemoria) => {
          if (empleadoMemoria.id === empleado.id) {
            empleadoMemoria.nombre = nombre;
            empleadoMemoria.apellido = apellido;
            empleadoMemoria.correo = correo;
            empleadoMemoria.telefono = telefono;
            empleadoMemoria.rol = resultado.rol;
          }

          return empleadoMemoria;
        });

        mostrarEmpleados();
      } else {
        Swal.fire({
          title: "error",
          text: "Hubo un error al actualizar el empleado",
          icon: "error",
        });
      }
    } catch (error) {
      console.log(error);
    }
  }

  async function eliminar(empleado) {
    const id = empleado.id;
    const datos = new FormData();
    datos.append("id", id);

    try {
      const URL = `${location.origin}/api/empleado-eliminar`;
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

        const modal = document.querySelector(".modal-form");
        if (modal) modal.remove();

        empleados = empleados.filter(
          (empleadoMemoria) => empleadoMemoria.id !== id
        );

        mostrarEmpleados();
      }
    } catch (error) {
      console.log(error);
    }
  }

  function confirmarEliminar(empleado) {
    Swal.fire({
      title: `¿Estás seguro de eliminar a ${empleado.nombre} ${empleado.apellido}?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminar(empleado);
      }
    });
  }
})();
