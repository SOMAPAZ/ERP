import { getSearch, limpiarHTML } from "../helpers/index.js";
import Alerta from "../classes/Alerta.js";

(()=> {
  const inputNombre = document.querySelector("#input-nombre");
  const inputID = document.querySelector("#id_user-input");
  const btnCopiar = document.querySelector("#copy-report");
  const olStatus = document.querySelector("#ol-status");
  
  if(inputNombre && inputID) {
    const categoriaSelect = document.querySelector("#categoria");
    const incidenciaSelect = document.querySelector("#incidencia");
    const listadoCoincidencias = document.querySelector("#coincidencias-usuario");
    const inputDireccion = document.querySelector("#direccion");
    const inputTelefono = document.querySelector("#telefono");
    const incidenciaActual = document.querySelector("#incidencia_actual").value ?? "";
    
    let usuarios = [];
    let usuariosFiltrados = [];
    let valorCoincidencia = "";

    document.addEventListener("DOMContentLoaded", () => {
        valorCoincidencia = categoriaSelect.value;
        getIncidencias();
    });
    inputNombre.addEventListener("input", coincidenciaNombre);
    inputID.addEventListener("input", coincidenciaID);
    categoriaSelect.addEventListener("change", () => {
      valorCoincidencia = categoriaSelect.value;
      getIncidencias();
    });

    getUsers();
    
    async function getUsers() {
      const URL = `${location.origin}/api/users`;
      const res = await fetch(URL);
      usuarios = await res.json();
    }

    function coincidenciaNombre(e) {
      const valor = e.target.value.trim();
      
      if (valor.length >= 4) {
        const expresion = new RegExp(valor, 'i');
        usuariosFiltrados = usuarios.filter(usuario => {
            if (usuario.nombre.toLowerCase().search(expresion) != -1) {
                return usuario;
            }
        })
      } else {
        usuariosFiltrados = []
      }

      mostrarUsuarios();
    }

    function coincidenciaID(e) {
      const valor = e.target.value;
      let usuarioFiltrado = [];

      if (valor.length >= 1) {
        usuarioFiltrado = usuarios.filter(usuario => usuario.id === valor);
      } else {
        usuarioFiltrado = []
      }

      completarInputs(usuarioFiltrado);
    }
    
    async function getIncidencias() {
      const URL = `${location.origin}/api/incidencias?id=${valorCoincidencia}`;
      const res = await fetch(URL);
      const data = await res.json();
      
      limpiarHTML(incidenciaSelect);
      data.forEach(incidencia => {
        const incidenciaOption = document.createElement("option");
        incidenciaOption.value = incidencia.id;
        incidenciaActual === incidencia.id ? incidenciaOption.selected = true : incidenciaOption.selected = false;
        incidenciaOption.textContent = incidencia.name;
        incidenciaSelect.appendChild(incidenciaOption);
      });
    }


    function mostrarUsuarios() {
      limpiarHTML(listadoCoincidencias);
      
      if(usuariosFiltrados.length > 0) {
        usuariosFiltrados.forEach(usuario => {
          const { id: userID, nombre, direccion } = usuario;

          const li = document.createElement("LI");
          li.className = "flex items-center gap-2 py-2 px-6 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 dark:hover:bg-gray-700 dark:bg-gray-600 dark:text-white rounded-lg uppercase font-bold cursor-pointer";
          li.onclick = () =>seleccionarUsuario(usuario);
          li.textContent = `${userID} - ${nombre}`;
          listadoCoincidencias.appendChild(li);
        })
      } else {
        limpiarHTML(listadoCoincidencias);
        const parr = document.createElement("P");
        parr.className = "flex items-center gap-2 py-2 px-6 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 dark:hover:bg-gray-700 dark:bg-gray-600 dark:text-white rounded-lg uppercase font-bold";
        parr.onclick = () => limpiarHTML(listadoCoincidencias);
        parr.textContent = "No hay coincidencias";
        listadoCoincidencias.appendChild(parr);
      }
    }

    function completarInputs(user) {
      if (user.length === 0) {
        inputNombre.value = "";
        inputID.value = "";
        inputDireccion.value = "";
        inputTelefono.value = "";
        return;
      }

      inputNombre.value = user[0].nombre;
      inputID.value = user[0].id;
      inputDireccion.value = user[0].direccion;
      inputTelefono.value = user[0].telefono;
    }

    function seleccionarUsuario(usuario) {
      limpiarHTML(listadoCoincidencias);
      
      inputNombre.value = usuario.nombre;
      inputID.value = usuario.id;
      inputDireccion.value = usuario.direccion;
      inputTelefono.value = usuario.telefono;
    }
  }

  if(btnCopiar) {
    btnCopiar.addEventListener("click", copiarReporte);
    obtenerReporte();
    let reporte = {};
    
    async function obtenerReporte() {
      const folioID = getSearch().folio;
      const URL = `${location.origin}/api/reporte?folio=${folioID}`;
      const res = await fetch(URL);
      reporte = await res.json();
    }

    function copiarReporte() {
      const textoFormateado = formatearReporte();
      const resultado = navigator.clipboard.writeText(textoFormateado);

      if (resultado) {
        Alerta.Toast.fire({
          icon: "success",
          title: "Copiado",
        })
      }
    }

    function formatearReporte() {
      const textoFormateado = `*Folio:* ${reporte.id}\n*Nombre:* ${reporte.name}\n*ID Usuario:* ${reporte.id_user}\n*Teléfono:* ${reporte.phone}\n*Dirección:* ${reporte.address}\n*Beneficiario:* ${reporte.beneficiary}\n*Categoria:* ${reporte.categoria}\n*Incidencia:* ${reporte.incidencia}\n*Prioridad:* ${reporte.prioridad}\n*Estado:* ${reporte.estado}\n*Descripción:* ${reporte.description}\n*Creado:* ${reporte.fechaFormateada}\n*Creado por:* ${reporte.created_by}`;

      return textoFormateado;
    }

  }

  if(olStatus) {
    const lisStatus = olStatus.querySelectorAll("li");
    lisStatus.forEach(li => li.addEventListener("click", cambiarEstado));

    async function cambiarEstado(e) {
      const li = e.target.dataset.status;
      if(!isNaN(li)) {
        const URL = `${location.origin}/api/cambiar-estado_reporte`;
        const data = new FormData();
        data.append("folio", getSearch().folio);
        data.append("estado", li);
        try {
          const response = await fetch(URL, {
            method: "POST",
            body: data
          });
          const result = await response.json();
          
  
          if(!result) {
            Alerta.Toast.fire({
              icon: "error",
              title: "Error al cambiar el estado",
            })
  
            return;
          }
  
          mostrarCambioEstado(li);
        } catch (error) {
          console.error(error);
        }
      }
    }

    async function mostrarCambioEstado(li) {

      Swal.fire({
        title: "Actualizado correctamente",
        text: "Estado actualizado correctamente",
        icon: "success",
        confirmButtonText: "Ok",
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false, 
      }).then((result) => {
          if (result.isConfirmed) {
              location.reload();
          }
      });

    }
  }


})();