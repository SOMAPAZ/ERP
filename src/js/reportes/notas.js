(() => {
  const contenedorNotas = document.querySelector("#render-notas");
  const btnAgregarNota = document.querySelector("#btn-add-note");
  let notas = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerNotas();

    btnAgregarNota.addEventListener("click", () => {
      mostrarModal();
    });
  });

  async function obtenerNotas() {
    const formData = new FormData();
    formData.append("id_report", obtenerFolio());

    try {
      const URL = `${location.origin}/api/notas-reportes`;
      const response = await fetch(URL, {
        method: "POST",
        body: formData,
      });
      const resultado = await response.json();
      notas = resultado;
      console.log(notas);

      renderizarNotas();
    } catch (error) {
      console.log(error);
    }
  }

  function obtenerFolio() {
    const folioParams = new URLSearchParams(window.location.search);
    const report = Object.fromEntries(folioParams.entries());
    return report.folio;
  }

  function mostrarModal() {
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
    h3.textContent = "Añadir información";
    header.appendChild(h3);

    //Contenido
    const bodyModal = document.createElement("DIV");
    bodyModal.className = "p-4 md:p-5 space-y-4";

    const formulario = document.createElement("FORM");
    formulario.id = "formulario-add-informacion";
    formulario.setAttribute("autocomplete", "off");
    formulario.setAttribute("enctype", "multipart/form-data");

    const divContainer = document.createElement("DIV");
    divContainer.className = "flex flex-col gap-6";

    const divNota = document.createElement("DIV");
    const labelNota = document.createElement("LABEL");
    labelNota.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelNota.textContent = "Agregue una nota";
    const textareaNota = document.createElement("TEXTAREA");
    textareaNota.className =
      "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase";
    textareaNota.name = "nota";
    textareaNota.id = "nota";
    textareaNota.placeholder = "Nota del Reporte";
    divNota.appendChild(labelNota);
    divNota.appendChild(textareaNota);

    const divImagen = document.createElement("DIV");
    const labelImagen = document.createElement("LABEL");
    labelImagen.className =
      "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelImagen.textContent = "Tu evidencia";
    labelImagen.for = "evidencia";
    const inputImagen = document.createElement("INPUT");
    inputImagen.className =
      "block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:bg-gray-200 file:text-gray-600 dark:file:bg-gray-900 dark:file:text-white file:border-0 file:p-2.5 file:cursor-pointer";
    inputImagen.id = "evidencia";
    inputImagen.type = "file";
    inputImagen.name = "evidencia";
    inputImagen.accept = ".jpg,.png,.jpeg";

    divImagen.appendChild(labelImagen);
    divImagen.appendChild(inputImagen);

    divContainer.appendChild(divNota);
    divContainer.appendChild(divImagen);

    formulario.appendChild(divContainer);

    const footer = document.createElement("DIV");
    footer.className =
      "flex items-center justify-end gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600";

    const btnAgregar = document.createElement("BUTTON");
    btnAgregar.className =
      "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";
    btnAgregar.textContent = "Agregar";

    btnAgregar.onclick = guardarNotas;

    const btnCancelar = document.createElement("BUTTON");
    btnCancelar.className =
      "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800";

    btnCancelar.textContent = "Cancelar";
    btnCancelar.onclick = () => document.querySelector(".modal-form")?.remove();

    bodyModal.appendChild(formulario);

    footer.appendChild(btnCancelar);
    footer.appendChild(btnAgregar);

    contenido.appendChild(header);
    contenido.appendChild(bodyModal);
    contenido.appendChild(footer);

    contenedorModal.appendChild(contenido);
    bgModal.appendChild(contenedorModal);
    document.querySelector("main").appendChild(bgModal);
  }

  async function guardarNotas(e) {
    const divPadre = e.target.parentElement.parentElement;
    const nota = divPadre.querySelector("#nota").value.trim();
    const imagen = divPadre.querySelector("#evidencia").files[0];

    if (nota === "" && imagen === undefined) {
      mostrarAlerta("No puedes dejar ambos campos en blanco");
      return;
    }

    const datos = new FormData();
    datos.append("id_report", obtenerFolio());
    datos.append("note", nota);
    datos.append("image", imagen);

    try {
      const URL = `${location.origin}/api/nota-reporte`;
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

        const notaObj = {
          id: resultado.id,
          created: resultado.created,
          note: nota,
          image: resultado.imagen,
        };

        notas = [...notas, notaObj];

        renderizarNotas();
      }
    } catch (error) {
      console.log(error);
    }
  }

  function mostrarAlerta(mensaje) {
    const divAlerta = document.createElement("DIV");

    divAlerta.className =
      "rounded border-s-4 mt-6 border-red-500 bg-red-50 p-4 dark:border-red-600 dark:bg-red-900 alerta";
    divAlerta.innerHTML = `<strong class="block font-medium text-red-700 dark:text-red-200">${mensaje}</strong>`;

    document.querySelector(".alerta")?.remove();

    const formulario = document.querySelector("#formulario-add-informacion");

    formulario.parentElement.insertBefore(divAlerta, formulario);

    setTimeout(() => {
      divAlerta.remove();
    }, 5000);
  }

  function renderizarNotas() {
    let numNota = 1;
    limpiarHTML();

    if (notas.length === 0) {
      contenedorNotas.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400 col-span-2">No hay notas registradas</p>`;
      return;
    }

    notas.forEach((nota) => {
      const { note, image, created } = nota;

      const contenedorNota = document.createElement("DIV");
      contenedorNota.className =
        "items-center bg-gray-50 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700";

      const divImg = document.createElement("DIV");
      divImg.className = "px-3";
      if (image === "") {
        divImg.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32 mx-auto md:mx-0"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            `;
      } else {
        const imagen = document.createElement("IMG");
        imagen.src = `images/${image}`;
        imagen.alt = "Nota-imagen";
        imagen.className =
          "w-full max-w-32 aspect-square rounded-lg mx-auto mt-3";

        divImg.appendChild(imagen);
      }

      contenedorNota.appendChild(divImg);

      const divTexto = document.createElement("DIV");
      divTexto.className = "p-3";

      const h3 = document.createElement("H3");
      h3.className =
        "text-lg font-bold tracking-tight text-gray-900 dark:text-white";
      h3.textContent = `Nota ${numNota++}`;

      const span = document.createElement("SPAN");
      span.className = "text-base text-gray-500 dark:text-gray-400";
      span.textContent = created;

      const p = document.createElement("P");
      p.className =
        "mt-3 mb-4 font-light text-base text-gray-500 dark:text-gray-400";
      if (note === "") {
        p.textContent = "No se registró texto de nota";
      } else {
        p.textContent = note;
      }

      const btnEliminar = document.createElement("BUTTON");
      btnEliminar.className =
        "flex mx-auto md:mx-0 items-center justify-center uppercase bg-red-600 text-font-light text-xs py-1 px-3 rounded-md shadow-md hover:bg-red-500 gap-2";
      btnEliminar.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <p class="font-bold text-xs">Eliminar</p>
      `;
      btnEliminar.onclick = () => {
        confirmarEliminar(nota);
      };

      divTexto.appendChild(h3);
      divTexto.appendChild(span);
      divTexto.appendChild(p);
      divTexto.appendChild(btnEliminar);

      contenedorNota.appendChild(divTexto);

      contenedorNotas.appendChild(contenedorNota);
    });
  }

  function limpiarHTML() {
    while (contenedorNotas.firstChild) {
      contenedorNotas.removeChild(contenedorNotas.firstChild);
    }
  }

  function confirmarEliminar(nota) {
    Swal.fire({
      title: `¿Estás seguro de eliminar la nota?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarNota(nota);
      }
    });
  }

  async function eliminarNota(nota) {
    const datos = new FormData();
    datos.append("id", nota.id);

    try {
      const URL = `${location.origin}/api/nota-reporte/eliminar`;
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

        notas = [...notas].filter((nota) => nota.id !== resultado.id);

        renderizarNotas();
      }
    } catch (error) {
      console.log(error);
    }
  }
})();
