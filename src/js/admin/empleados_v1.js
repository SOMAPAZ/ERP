import Formulario from "../classes/Formulario_v1.js";
import Modal from "../classes/Modal_v1.js";
import PostDatos from "../classes/PostData_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import { limpiarHTML } from "../helpers/index_v1.js";

(() => {
  const tablaEmpleados = document.querySelector("#table-employees tbody");
  const btnAgregar = document.querySelector("#agregar-empleado");
  let empleados = [];
  let empleadoAct = {};
  let roles = [];

  document.addEventListener("DOMContentLoaded", () => {
    main();
    obtenerRols();
    btnAgregar.addEventListener("click", () =>{
      empleadoAct = {};
      renderFormulario(false);
    });
  });

  async function main() {
    empleados = await GetDatos.consultar("/api/empleados");
    mostrarEmpleados();
  }

  async function obtenerRols() {
    roles = await GetDatos.consultar("/api/roles");
  }

  function mostrarEmpleados() {
    limpiarHTML(tablaEmpleados);
    empleados.forEach((empleado) => {
      const { id, nombre, apellido, correo, telefono, rol } = empleado;

      if(id === '0') return;

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

      btnEdit.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Editar</p>`;

      btnEdit.onclick = () => {
        empleadoAct = empleado;
        renderFormulario(true);
      };

      const btnDelete = document.createElement("BUTTON");
      btnDelete.className =
        "flex items-center justify-center w-full uppercase text-xs py-1 px-3 rounded-md shadow-md bg-red-600 text-font-light hover:bg-red-500 gap-2";

      btnDelete.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;

      btnDelete.onclick = () => {
        empleadoAct = empleado;
        confirmarEliminar();
      };

      tdActions.appendChild(btnEdit);
      tdActions.appendChild(btnDelete);

      row.appendChild(tdID);
      row.appendChild(tdName);
      row.appendChild(tdCorreo);
      row.appendChild(tdTelefono);
      row.appendChild(tdRol);
      row.appendChild(tdActions);

      tablaEmpleados.appendChild(row);
    });
  }

  function renderFormulario(actualizar = false) {
    const formulario = document.createElement("FORM");
    formulario.autocomplete = "off";
    formulario.className = "space-y-5 mb-5";
    const h3 = document.createElement("H3");
    h3.className = "text-lg font-medium text-gray-900 dark:text-white";
    h3.textContent = 'Ingrese los datos solicitados';
    const divAlerta = document.createElement('DIV');
    divAlerta.id = 'div-notif';
    
    formulario.appendChild(h3);
    formulario.appendChild(divAlerta);

    Formulario.crearInput(formulario,'Ingrese el nombre', "text", "name", actualizar ? empleadoAct.nombre : null);
    Formulario.crearInput(formulario,'Ingrese el apellido', "text", "lastname", actualizar ? empleadoAct.apellido : null);
    Formulario.crearInput(formulario,'Ingrese el email', "email", "mail", actualizar ? empleadoAct.correo : null);
    Formulario.crearInput(formulario,'Ingrese el teléfono', "tel", "phone", actualizar ? empleadoAct.telefono : null);

    actualizar ? 
      Formulario.crearInput(formulario,'id', "hidden", "id", empleadoAct.id) :
        Formulario.crearInput(formulario,'Ingrese el password', "password", "password");

    Formulario.crearSelect(formulario,'Seleccione un rol', "id_rol", roles, actualizar ? empleadoAct.rol : null);

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
    const URL = '/api/empleado';
    const resultado = await PostDatos.guardarDatos(URL, inputs);
    
    if(resultado.tipo === 'Exito') {
      const modal = document.querySelector(".default-modal");
      if (modal) modal.remove();

      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      const empleadoObj = {
        id: resultado.usuario.id,
        nombre: resultado.usuario.name,
        apellido: resultado.usuario.lastname,
        correo: resultado.usuario.mail,
        telefono: resultado.usuario.phone,
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
  }

  async function update(e) {
    const form = e.target.parentElement.parentElement.querySelector("form");
    const inputs = form.querySelectorAll(".input-form");

    const URL = '/api/empleado-actualizar';
    const resultado = await PostDatos.guardarDatos(URL, inputs);

    if (resultado.tipo === "Exito") {
      const modal = document.querySelector(".default-modal");
      if (modal) modal.remove();
      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      empleados = empleados.map((empleadoMemoria) => {
        if (empleadoMemoria.id === empleadoAct.id) {
          empleadoMemoria.nombre = resultado.usuario.name;
          empleadoMemoria.apellido = resultado.usuario.lastname;
          empleadoMemoria.correo = resultado.usuario.mail;
          empleadoMemoria.telefono = resultado.usuario.phone;
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
  }

  async function eliminar() {
    const URL = '/api/empleado-eliminar';
    const resultado = await PostDatos.eliminarDatos(URL, empleadoAct.id);

    if (resultado.tipo === "Exito") {
      Swal.fire({
        title: resultado.tipo,
        text: resultado.mensaje,
        icon: "success",
      });

      empleados = empleados.filter(empleadoMemoria => empleadoMemoria.id !== empleadoAct.id);

      mostrarEmpleados();
    }
  }

  function confirmarEliminar() {
    Swal.fire({
      title: `¿Estás seguro de eliminar a ${empleadoAct.nombre} ${empleadoAct.apellido}?`,
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
