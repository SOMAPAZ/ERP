(() => {
  const dropdownButton = document.querySelector("#dropdownButton");
  const dropdownOptions = document.querySelector("#dropdownOptions");
  let dropdownMenu = document.querySelector("#dropdownMenu");
  const inputBusqueda = document.querySelector("#busqueda");
  const listadoCoincidencias = document.querySelector("#listado-coincidencias");
  let usuarios = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerUsuarios();
    inputBusqueda.addEventListener("input", buscarUsuario);
    dropdownButton.addEventListener("click", desplegarDropdown);
    dropdownOptions.addEventListener("click", setearTextoDropdown);
  });

  async function obtenerUsuarios() {
    try {
      const URL = `${location.origin}/api/usuarios`;
      const response = await fetch(URL);
      const data = await response.json();

      usuarios = data;
    } catch (error) {
      console.log(error);
    }
  }

  function desplegarDropdown() {
    if (dropdownMenu.classList.contains("hidden")) {
      dropdownMenu.classList.remove("hidden");
    } else {
      dropdownMenu.classList.add("hidden");
    }
  }

  function setearTextoDropdown(e) {
    if (e.target.tagName === "LI") {
      const dataValue = e.target.getAttribute("data-value");
      document.querySelector("#dropdownSpan").textContent = dataValue;
      document.querySelector("#dropdownMenu").classList.add("hidden");
    }
  }

  function ocultarDropdown(e) {
    let isClickInside =
      document.querySelector("#dropdownButton").contains(e.target) ||
      document.querySelector("#dropdownMenu").contains(e.target);
    let dropdownMenu = document.querySelector("#dropdownMenu");

    if (!isClickInside) {
      dropdownMenu.classList.add("hidden");
    }
  }

  function buscarUsuario() {
    limpiarAnterior();
    if (inputBusqueda.value === "") return;

    let coincidencias = [];

    if (parseInt(inputBusqueda.value)) {
      coincidencias = [...usuarios].filter((usuario) => {
        return usuario.id.includes(inputBusqueda.value.toLowerCase());
      });
    } else {
      coincidencias = [...usuarios].filter((usuario) => {
        return usuario.nombre
          .toLowerCase()
          .includes(inputBusqueda.value.toLowerCase());
      });
    }

    const ul = document.createElement("UL");
    ul.classList.add("space-y-2", "z-40", "mb-6");

    coincidencias.forEach((coincidencia) => {
      if (coincidencia === "") return;

      const li = document.createElement("LI");
      li.className =
        "block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-200 uppercase cursor-pointer";

      li.textContent = `${coincidencia.id} - ${coincidencia.nombre}`;
      li.onclick = function () {
        autocompletar(coincidencia);
      };
      ul.appendChild(li);
      listadoCoincidencias.appendChild(ul);
    });
  }

  function limpiarAnterior() {
    while (listadoCoincidencias.firstChild) {
      listadoCoincidencias.removeChild(listadoCoincidencias.firstChild);
    }
  }

  function autocompletar(usuario) {
    inputBusqueda.value = `${usuario.id.trim()} - ${usuario.nombre.trim()}`;
    limpiarAnterior();
  }
})();
