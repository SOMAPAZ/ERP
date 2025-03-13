import GetDatos from "../classes/GetData_v1.js"
import Modal from "../classes/Modal_v1.js"
import PostDatos from "../classes/PostData_v1.js"
import Alerta from "../classes/Alerta_v1.js"
import {getSearch, limpiarHTML } from "../helpers/index_v1.js"

(() => {
  const contenedorNotas = document.querySelector("#render-notas");
  const btnAgregarNota = document.querySelector("#btn-add-note");
  const btnAddBag = document.querySelector('#btn-bag-img')
  let notas = [];
  let imagenes = [];
  let guardadasEv = [];

  document.addEventListener("DOMContentLoaded", () => {
    obtenerNotas();
    verificarExisteEv();
    btnAgregarNota.addEventListener("click", mostrarModal);
    btnAddBag.addEventListener('click', modalImagenes);
  });

  const obtenerNotas = async () => {
    const URL = `${location.origin}/notas-reportes?id_report=${getSearch().folio}`;
    notas = await GetDatos.consultar(URL)
    renderizarNotas();
  }

  const mostrarModal = () => {
    const bodyModal = document.createElement("DIV");
    bodyModal.className = "p-4 space-y-4 mb-4";

    const formulario = document.createElement("FORM");
    formulario.id = "formulario-add-nota";
    formulario.setAttribute("autocomplete", "off");
    formulario.setAttribute("enctype", "multipart/form-data");

    const divContainer = document.createElement("DIV");
    divContainer.className = "flex flex-col gap-6";

    const h3 = document.createElement("H3");
    h3.className = "text-lg font-medium text-gray-900 dark:text-white mb-5";
    h3.textContent = 'Ingrese los datos solicitados';
    const divAlerta = document.createElement('DIV');
    divAlerta.id = 'div-notif';
    
    formulario.appendChild(h3);
    formulario.appendChild(divAlerta);

    const divNota = document.createElement("DIV");
    const labelNota = document.createElement("LABEL");
    labelNota.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelNota.textContent = "Agregue una nota";
    const textareaNota = document.createElement("TEXTAREA");
    textareaNota.className = "inputs-form bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase";
    textareaNota.name = "note";
    textareaNota.id = "nota";
    textareaNota.placeholder = "Nota del Reporte";
    divNota.appendChild(labelNota);
    divNota.appendChild(textareaNota);

    const divImagen = document.createElement("DIV");
    const labelImagen = document.createElement("LABEL");
    labelImagen.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
    labelImagen.textContent = "Tu evidencia";
    labelImagen.for = "image";
    const inputImagen = document.createElement("INPUT");
    inputImagen.className = "inputs-form block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:bg-gray-200 file:text-gray-600 dark:file:bg-gray-900 dark:file:text-white file:border-0 file:p-2.5 file:cursor-pointer";
    inputImagen.id = "image";
    inputImagen.type = "file";
    inputImagen.name = "image";
    inputImagen.accept = ".jpg,.png,.jpeg";

    divImagen.appendChild(labelImagen);
    divImagen.appendChild(inputImagen);

    divContainer.appendChild(divNota);
    divContainer.appendChild(divImagen);

    formulario.appendChild(divContainer);
    bodyModal.appendChild(formulario)

    const btnAgregar = document.createElement("BUTTON");
    btnAgregar.className = "text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700";
    btnAgregar.textContent = "Agregar";

    btnAgregar.onclick = guardarNotas;
    Modal.renderModal(bodyModal, btnAgregar )
  }

  const guardarNotas = async () => {
    const inputNota = document.querySelector('#nota').value.trim();
    const inputImage = document.querySelector('#image').files[0]

    if (inputNota === "" && inputImage === undefined) {
      new Alerta({ 
        msg: 'No puede dejar ambos campos vacíos', 
        position: document.querySelector("#div-notif"),
      })
      return;
    }

    const datos = new FormData();
    datos.append("id_report", getSearch().folio);
    datos.append("note", inputNota);
    datos.append("image", inputImage);

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

        const modal = document.querySelector(".default-modal");
        if (modal) modal.remove();

        const notaObj = {
          id: resultado.id,
          created: resultado.created,
          note: inputNota,
          image: resultado.imagen,
        };

        notas = [...notas, notaObj];

        renderizarNotas();
      }
    } catch (error) {
      console.log(error);
    }
  }

  const renderizarNotas = () => {
    let numNota = 1;
    limpiarHTML(contenedorNotas);

    if (notas.length === 0) {
      contenedorNotas.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400 col-span-2">No hay notas registradas</p>`;
      return;
    }

    notas.forEach((nota) => {
      const { note, image, created } = nota;

      const contenedorNota = document.createElement("DIV");
      contenedorNota.className = "w-full flex flex-col sm:flex-row sm:justify-betweenn space-y-8 gap-4 p-4 sm:items-center bg-white dark:bg-gray-800 dark:border-gray-700";

      const divImg = document.createElement("DIV");
      divImg.className = "sm:w-1/4 md:w-1/6";
      if (!image) {
        divImg.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32 mx-auto md:mx-0"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>`;
      } else {
        const imagen = document.createElement("IMG");
        imagen.src = `images/${image}`;
        imagen.alt = "Nota-imagen";
        imagen.className ="w-full block";
        divImg.appendChild(imagen);
      }

      contenedorNota.appendChild(divImg);

      const divTexto = document.createElement("DIV");
      divTexto.className = "sm:w-2/4 md:w-3/6 lg:w-4/6";

      const h3 = document.createElement("H3");
      h3.className = "text-lg font-bold tracking-tight text-gray-900 dark:text-white";
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

      const divBtns = document.createElement('DIV');
      divBtns.className = "sm:w-1/4 md:w-2/6 lg:flex-1 flex flex-col gap-2 lg:flex-row"

      const existe = imagenes.find( im => im.image === nota.image);
      const btnEliminar = document.createElement("BUTTON");
      btnEliminar.className = "w-full px-2 py-2 md:py-1 text-xs leadindg-5 font-semibold rounded cursor-pointer bg-red-200 text-red-800 flex flew-row flex-nowrap items-center justify-center gap-2 uppercase hover:bg-red-300 disabled:opacity-10 disabled:cursor-not-allowed";
      btnEliminar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;


      if(existe || guardadasEv.length === 3){
        btnEliminar.setAttribute('disabled', true)
      } else {
        btnEliminar.removeAttribute('disabled')
      }

      btnEliminar.onclick = () => confirmarEliminar(nota);

      const btnAgregarReporte = document.createElement("BUTTON");
      btnAgregarReporte.className = "w-full px-2 py-2 md:py-1 text-xs leadindg-5 font-semibold rounded cursor-pointer bg-green-200 text-green-800 flex flew-row flex-nowrap items-center justify-center gap-2 uppercase hover:bg-green-300 disabled:opacity-10 disabled:cursor-not-allowed";
      btnAgregarReporte.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Agregar</p>`;
      
      
      if(existe || guardadasEv.length === 3) {
        btnAgregarReporte.setAttribute('disabled', true)
      } else {
        btnAgregarReporte.removeAttribute('disabled');
      }
      
      (!image) ? btnAgregarReporte.setAttribute('disabled', true) : '';
      
      btnAgregarReporte.onclick = () => agregarBag(nota);

      if (image !== "" || guardadasEv.length !== 3) divBtns.appendChild(btnAgregarReporte);
      divBtns.appendChild(btnEliminar)
      
      divTexto.appendChild(h3);
      divTexto.appendChild(span);
      divTexto.appendChild(p);

      contenedorNota.appendChild(divTexto);
      contenedorNota.appendChild(divBtns);

      contenedorNotas.appendChild(contenedorNota);
    });
  }

  const confirmarEliminar = (nota) => {
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

  const eliminarNota = async (nota) => {
    const URL = `${location.origin}/api/nota-reporte/eliminar`;
    const res = await PostDatos.eliminarDatos(URL, nota.id)
    if (res.tipo === "Exito") {
      Alerta.Toast.fire({
        title: res.tipo,
        text: res.mensaje,
        icon: "success",
      });

      notas = [...notas].filter((nota) => nota.id !== res.id);

      renderizarNotas();
    }
  }

  const agregarBag = (nota) => {
    const existe = imagenes.find( imag => imag.id === nota.id)
    
    if(imagenes.length === 3) {
      Alerta.Toast.fire({
        icon: 'error',
        text: 'Solo se permiten 3 evidencias por reporte'
      });
      return;
    }

    if(!existe && imagenes.length < 3) {
      Alerta.Toast.fire({
        icon: 'success',
        text: 'Evidencia agregada'
      });
      
      imagenes = [...imagenes, nota];
    }

    renderizarNotas();
  }

  const modalImagenes = () => {
    document.querySelector('.default-modal')?.remove();
    verificarExisteEv();

    const btnAgregar = document.createElement("BUTTON");
    btnAgregar.className = "text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 disabled:opacity-10";
    btnAgregar.textContent = "Guardar";
    imagenes.length === 0 ? btnAgregar.setAttribute('disabled', true) : btnAgregar.removeAttribute('disabled')
    btnAgregar.onclick = confirmarEvidencias;

    const divImages = document.createElement('DIV');
    divImages.className = "w-full p-5 grid sm:grid-cols-2 md:grid-cols-3 gap-3"

    if(imagenes.length > 0) {
      imagenes.forEach( ima => {
        const divImage = document.createElement('DIV');
        divImage.className = 'flex flex-col gap-5'

        const imagen = document.createElement("IMG");
        imagen.src = `images/${ima.image}`;
        imagen.alt = "imagen-pdf";
        imagen.className ="w-full block";

        const btnEliminar = document.createElement("BUTTON");
        btnEliminar.className = "w-full px-2 py-2 md:py-1 text-xs leadindg-5 font-semibold rounded cursor-pointer bg-red-200 text-red-800 flex flew-row flex-nowrap items-center justify-center gap-2 uppercase hover:bg-red-300 disabled:opacity-10";
        btnEliminar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg><p class="font-bold text-xs">Eliminar</p>`;
        btnEliminar.onclick = () => eliminarEvidenciaPDF(ima);

        divImage.appendChild(imagen);
        divImage.appendChild(btnEliminar);

        divImages.appendChild(divImage);
      })
    } else {
      const parrafo = document.createElement('P');
      parrafo.textContent = 'No hay imagenes seleccionadas'
      parrafo.className = 'sm:col-span-2 md:col-span-3 text-center uppercase text-gray-900 dark:text-gray-200 font-black'
      divImages.appendChild(parrafo);
    }

    Modal.renderModal(divImages, btnAgregar)
  }

  const eliminarEvidenciaPDF = (ima) => {
    imagenes = imagenes.filter( evi => evi.id !== ima.id)
    modalImagenes();
    renderizarNotas();
    Alerta.Toast.fire({
      icon: 'success',
      text: 'Evidencia eliminada'
    });
  }

  const confirmarEvidencias = () => {
    if(imagenes.length < 3) {
      Alerta.Toast.fire({
        icon: 'error',
        title: 'Acción denegada',
        text: 'Debe seleccionar al menos 3 imagenes'
      })
      return;
    }

    Swal.fire({
      title: `¿Estás seguro de guardar estas evidencias?`,
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, guardar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        guardarEvidencias();
      }
    });
  }

  const verificarExisteEv = async () => {
    const url = `${location.origin}/reporte/evidencias?folio=${getSearch().folio}`
    guardadasEv = await GetDatos.consultar(url);
    guardadasEv.length === 3 ? btnAddBag.setAttribute('disabled', true) : btnAddBag.removeAttribute('disabled')
  }

  const guardarEvidencias = async () => {
    const url = `${location.origin}/reporte/evidencias-guardar`;
    const res = await PostDatos.enviarArray(url, JSON.stringify(imagenes));

    if(res.tipo === 'Error') {
      Alerta.Toast.fire({
        icon: 'error',
        title: 'Upss!',
        text: res.msg
      })
      return;
    }
    
    if(res.tipo === 'Exito') {
      Alerta.Toast.fire({
        icon: 'success',
        title: 'Guardado',
        text: res.msg
      })

      document.querySelector('.default-modal')?.remove();
      verificarExisteEv();
    }
  }
})();
