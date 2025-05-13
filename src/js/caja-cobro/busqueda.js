import { limpiarHTML } from "../helpers/index.js";
import GetDatos from "../classes/GetData.js"
import Modal from "../classes/Modal.js";
import Alerta from "../classes/Alerta.js";

(() => {  
  const btnConsultar = document.querySelector("#btn-search-user");

  if(btnConsultar){
    const ancoreConsulta = document.querySelector("#a-search-user");
    btnConsultar.addEventListener("click", modal);
    ancoreConsulta.addEventListener("click", modal);
    let usuarios = [];
    let usuariosFiltrados = [];

    obtenerUsuarios();
    async function obtenerUsuarios() {
      const usuariosFetch = await GetDatos.consultar(`${location.origin}/api/users`);
      formatearUsuarios(usuariosFetch);
    }

    function modal() {
      const formulario = document.createElement('FORM');
      formulario.className = 'w-full mx-auto my-5';
      formulario.setAttribute('autocomplete', 'off');
      formulario.onsubmit = (e) => {
        e.preventDefault();
      }
      const label = document.createElement('LABEL');
      label.className = 'block text-sm font-bold text-gray-700 dark:text-gray-200 uppercase mb-3';
      label.textContent = 'Nombre, Dirección o ID del usuario: (5 caracteres mínimo)';
      label.setAttribute('for', 'busqueda');
      const inputBusqueda = document.createElement('INPUT');
      inputBusqueda.setAttribute('id', 'busqueda');
      inputBusqueda.className = 'w-full px-4 py-2 bg-gray-200 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white outline-none';
      inputBusqueda.setAttribute('placeholder', 'Nombre, Dirección o ID. Ej. 1234 - Juan Pérez');
      inputBusqueda.oninput = obtenerValorInput;
      
      const listadoCoincidencias = document.createElement('DIV');
      listadoCoincidencias.className = "my-2";
      listadoCoincidencias.setAttribute('id', 'listado-coincidencias');
      const listadoCoincidenciasUl = document.createElement('UL');
      listadoCoincidenciasUl.className = "space-y-2";
      listadoCoincidencias.appendChild(listadoCoincidenciasUl);

      const btnBuscar = document.createElement('BUTTON');
      btnBuscar.className = 'text-sm font-bold px-4 py-2 bg-indigo-600 rounded text-white hover:bg-indigo-700';
      btnBuscar.textContent = 'Consultar';
      btnBuscar.setAttribute('type', 'button');
      btnBuscar.onclick = buscarDeuda;

      formulario.appendChild(label);
      formulario.appendChild(inputBusqueda);
      formulario.appendChild(listadoCoincidencias);
      Modal.renderModal(formulario, btnBuscar);
    }

    function obtenerValorInput(e) {
      const value = e.target.value.trim();

      if(value.length > 5) {
        const expresion = new RegExp(value, 'i');
        usuariosFiltrados = usuarios.filter( usuario => {
            if(usuario.data.search(expresion) != -1){
                return usuario
            }
        });
      } else {
        usuariosFiltrados = [];
      }

      renderList(usuariosFiltrados);
    }

    function formatearUsuarios(usuariosFetch) {
      usuarios = usuariosFetch.map(usuario => {
        return{
          data: `${usuario.nombre.trim()} - ${usuario.direccion.trim()}`, 
          id: usuario.id
        }
      })
    }

    function renderList(usuariosFiltrados) {
      const listadoCoincidencias = document.querySelector("#listado-coincidencias ul");
      limpiarHTML(listadoCoincidencias);
      usuariosFiltrados.forEach(usuario => {
        const li = document.createElement("li");
        li.className = "block shadow rounded-lg bg-gray-100 hover:bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 uppercase cursor-pointer";
  
        li.textContent = `${usuario.data}`;
        li.onclick = () => autocompletar(usuario);
        listadoCoincidencias.appendChild(li);
      });
    }

    const autocompletar = (usuario) => {
      const inputBusqueda = document.querySelector("#busqueda");
      inputBusqueda.value = `${usuario.id} - ${usuario.data}`;
      limpiarHTML(document.querySelector("#listado-coincidencias ul"));
    }

    async function buscarDeuda(e) {
      e.preventDefault();
      const inputBusqueda = document.querySelector("#busqueda").value.trim();
      if(!inputBusqueda) {
        Alerta.ToastifyError("Por favor, ingrese un ID o nombre de usuario válido.");
        return;
      }

      const contenido = inputBusqueda.split(" - ");
      const idUsuario = contenido[0].trim();
    
      const response = await GetDatos.consultar(`${location.origin}/api/user?id=${idUsuario}`);
      if(response.tipo === 'Error') {
        Alerta.ToastifyError(response.msg);
        return;
      }

      window.location.href = `${location.origin}/caja-cobro?usuario=${idUsuario}`;
    }
  }
})();
