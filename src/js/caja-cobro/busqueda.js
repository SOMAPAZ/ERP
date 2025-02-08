import { limpiarHTML } from "../helpers/funciones.js";
import GetDatos from "../classes/GetData.js"
import Alerta from "../classes/Alerta.js";
import ListaCoincidencias from "../classes/ListaCoincidencias.js";

(() => {  
  const inputBusqueda = document.querySelector("#busqueda");
  const listadoCoincidencias = document.querySelector("#listado-coincidencias ul");
  const form = document.querySelector("#formulario-busqueda");
  const divError = document.querySelector("#error");
  let usuarios = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerUsuarios();
    inputBusqueda.addEventListener("input", buscarUsuario);
    form.addEventListener("submit", validarInput);
  });

  const obtenerUsuarios = async () => {
    usuarios = await GetDatos.consultar(`${location.origin}/api/users`);
  }

  const validarInput = (e) => {
    e.preventDefault();
    if(inputBusqueda.value === "") {
      new Alerta({ 
        msg: "Debe ingresar un ID, Nombre o Dirección Válido", 
        position: divError 
      });
    };
  }

  const buscarUsuario = () => {
    limpiarHTML(listadoCoincidencias);
    const valor = inputBusqueda.value.trim();
    if (valor === "" || valor.length < 3) return;

    const coincidencias = [...usuarios].filter((usuario) => {
      const con = `${usuario.id} - ${usuario.nombre} - ${usuario.direccion}`;
      return con.toLowerCase().includes(valor.toLowerCase());
    });

    coincidencias.forEach((coincidencia) => {
      const li = document.createElement("LI");
      li.className =
        "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";

      li.textContent = `${coincidencia.id} - ${coincidencia.nombre} - ${coincidencia.direccion}`;
      li.onclick = function () {
        autocompletar(coincidencia);
      };
      listadoCoincidencias.appendChild(li);
    });

  }

  function autocompletar(usuario) {
    inputBusqueda.value = `${usuario.id.trim()} - ${usuario.nombre.trim()} - ${usuario.direccion.trim()}`;
    limpiarHTML(listadoCoincidencias);
  }
})();
