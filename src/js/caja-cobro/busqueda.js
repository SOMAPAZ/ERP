import { limpiarHTML } from "../helpers/index.js";
import GetDatos from "../classes/GetData.js"

(() => {  
  const inputBusqueda = document.querySelector("#busqueda");
  const listadoCoincidencias = document.querySelector("#listado-coincidencias ul");
  let coincidencias = [];
  
  let usuarios = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerUsuarios();
    inputBusqueda.addEventListener("input", buscarUsuario);
  });

  const obtenerUsuarios = async () => usuarios = await GetDatos.consultar(`${location.origin}/api/users`);

  const buscarUsuario = () => {
    limpiarHTML(listadoCoincidencias);
    const valor = inputBusqueda.value.trim();

    if(valor.length > 2) {
      coincidencias = [...usuarios].filter((usuario) => {
        const con = `${usuario.id} - ${usuario.nombre} - ${usuario.direccion}`;
        return con.toLowerCase().includes(valor.toLowerCase());
      });

      limpiarHTML(document.querySelector("#datos-usuario"));
      limpiarHTML(document.querySelector("#deuda-usuario"));
      limpiarHTML(document.querySelector("#boton"));

      coincidencias.map((coincidencia) => {
        const li = document.createElement("LI");
        li.className =
          "block bg-white shadow rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";
  
        li.textContent = `${coincidencia.id} - ${coincidencia.nombre} - ${coincidencia.direccion}`;
        li.onclick = () => autocompletar(coincidencia);
        listadoCoincidencias.appendChild(li);
      });
    }
    
  }

  const autocompletar = (usuario) => {
    inputBusqueda.value = `${usuario.id.trim()} - ${usuario.nombre.trim()}`;
    limpiarHTML(listadoCoincidencias);
  }
})();
