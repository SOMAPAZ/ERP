(() => {
  const tablaDatos = document.querySelector("#listado-usuarios tbody");
  const loader = document.querySelector("#loader");
  const btnAnterior = document.querySelector("#btn-anterior");
  const btnSiguiente = document.querySelector("#btn-siguiente");
  const infoPagina = document.querySelector("#info-pagina");
  const elementosPorPagina = 15;
  let paginaActual = 1;

  const idTable = document.querySelector("#id-table");
  const nombreTable = document.querySelector("#nombre-table");
  const direccTable = document.querySelector("#direcc-table");
  const zonaTable = document.querySelector("#zona-table");
  const telTable = document.querySelector("#tel-table");

  let users = [];

  document.addEventListener("DOMContentLoaded", () => {
    consultarAPIUsers();
    comprobarActual();
    btnAnterior.addEventListener("click", disminuirPaso);
    btnSiguiente.addEventListener("click", aumentarPaso);
  });

  async function consultarAPIUsers() {
    try {
      const URL = `${location.origin}/api/users`;
      const response = await fetch(URL);
      users = await response.json();

      mostrarUsuarios();
    } catch (error) {
      console.log(error);
    }
  }

  function aumentarPaso() {
    paginaActual++;

    consultarAPIUsers();
  }

  function disminuirPaso() {
    paginaActual--;

    consultarAPIUsers();
  }

  function seccionar(users) {
    const corteDeInicio = (paginaActual - 1) * elementosPorPagina;
    const corteDeFinal = corteDeInicio + elementosPorPagina;
    let usersSeccion = users.slice(corteDeInicio, corteDeFinal);

    return usersSeccion;
  }

  function obtenerTotales(users) {
    const totalPartes = Math.ceil(users.length / elementosPorPagina);

    return totalPartes;
  }

  function comprobarActual() {
    if (paginaActual === 1) {
      btnAnterior.classList.remove("flex");
      btnAnterior.classList.add("hidden");
    } else {
      btnAnterior.classList.add("flex");
      btnAnterior.classList.remove("hidden");
    }
  }

  function mostrarUsuarios() {
    limpiarAnterior();

    const usersSeccion = seccionar(users);

    comprobarActual();

    infoPagina.textContent = `${paginaActual} de ${obtenerTotales(users)}`;

    usersSeccion.forEach((user) => {
      const { id, nombre, direccion, zona, telefono } = user;

      const row = document.createElement("TR");
      row.className =
        "whitespace-nowrap cursor-pointer hover:bg-background-dark dark:hover:bg-dark-bg";
      tablaDatos.appendChild(row);

      const tdID = document.createElement("TD");
      tdID.className =
        "whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white";
      tdID.textContent = id;

      const tdName = document.createElement("TD");
      tdName.className =
        "whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white";
      tdName.textContent = nombre;

      const tdAddress = document.createElement("TD");
      tdAddress.className =
        "whitespace-wrap px-4 py-2 text-gray-700 dark:text-gray-200 font-normal";
      tdAddress.textContent = direccion;

      const tdZone = document.createElement("TD");
      tdZone.className =
        "whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 font-normal";
      tdZone.textContent = zona;

      const tPhone = document.createElement("TD");
      tPhone.className =
        "whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 font-normal";
      tPhone.textContent = telefono === 0 || "Sin telefono";

      const tdAction = document.createElement("TD");
      tdAction.className =
        "whitespace-nowrap px-4 py-2 text-gray-700 dark:text-gray-200 font-normal text-center";
      const btnVer = document.createElement("A");
      btnVer.className =
        "border border-primary-dark text-primary-dark py-1 px-4 rounded-full uppercase text-xs font-bold hover:bg-primary-dark hover:text-font-light dark:saturate-50 cursor-pointer";
      btnVer.textContent = "Ver más";
      btnVer.href = `/buscar-unico?id=${id}`;

      tdAction.appendChild(btnVer);

      tablaDatos.appendChild(tdID);
      tablaDatos.appendChild(tdName);
      tablaDatos.appendChild(tdAddress);
      tablaDatos.appendChild(tdZone);
      tablaDatos.appendChild(tPhone);
      tablaDatos.appendChild(tdAction);
    });

    loader.classList.add("hidden");
  }

  function limpiarAnterior() {
    while (tablaDatos.firstChild) {
      tablaDatos.removeChild(tablaDatos.firstChild);
    }
  }
})();
