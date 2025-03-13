import Alerta from "../classes/Alerta_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import PostDatos from "../classes/PostData_v1.js";
import { getLocalStorage, limpiarHTML, saveLocalStorage } from "../helpers/index_v1.js";

(() => {
    const selectorInput = document.querySelector('#select-input');
    const contenedorTexto = document.querySelector('#contenedor-texto')
    const contenedorFolio = document.querySelector('#contenedor-folio')
    const contenedorCategoria = document.querySelector('#contenedor-categoria')
    const selectCategoria = document.querySelector('#data-category');
    const selectIncidencia = document.querySelector('#data-incidence');
    const formulario = document.querySelector('#filtrado-reporte');
    const divAlerta = document.querySelector('#div-notif');
    const divResultados = document.querySelector('#resultados');
    let tipoConcepto = '1';
    let conceptoBusqueda = '';

    document.addEventListener('DOMContentLoaded', () => {
        obtenerCategorias();
        selectCategoria.addEventListener('change', consultarIncidencias);
        conceptoBusqueda = getLocalStorage('conceptoBusqueda') ?? '';
        if (conceptoBusqueda !== '') buscarCoincidencias();
        selectorInput.addEventListener('change', mostrarInput);
        formulario.addEventListener('submit', obtenerValores);
    })

    const obtenerCategorias = async () => {
        const res = await GetDatos.consultar(`${location.origin}/api/categorias`);
        res.forEach((categoria) => {
            const opt = document.createElement('option');
            opt.value = categoria.id;
            opt.textContent = categoria.name;
            selectCategoria.appendChild(opt);
        })
    }

    const consultarIncidencias = async (e) => {
        const id = e.target.value;
        if(id === '') {
            selectIncidencia.setAttribute('disabled', 'disabled');
            selectIncidencia.value = '';
            limpiarHTML(selectIncidencia);
            return;
        }

        const res = await PostDatos.enviarArray(`${location.origin}/api/incidencias`, id);
        
        if(res.tipo === 'exito' && res.datos.length > 0) {
            selectIncidencia.removeAttribute('disabled');
            limpiarHTML(selectIncidencia);
            res.datos.forEach((incidencia) => {
                const opt = document.createElement('option');
                opt.value = incidencia.id;
                opt.textContent = incidencia.name;
                selectIncidencia.appendChild(opt);
            })
        }
    }

    const mostrarInput = (e) => {
        tipoConcepto = e.target.value;
        formulario.reset();

        if(tipoConcepto === '1') {
            contenedorTexto.classList?.remove('hidden');
            contenedorFolio.classList.contains('hidden') ? '' : contenedorFolio.classList.add('hidden');
            contenedorCategoria.classList.add('hidden') ? '' : contenedorCategoria.classList.add('hidden');
        }

        if(tipoConcepto === '2') {
            contenedorFolio.classList?.remove('hidden');
            contenedorTexto.classList.contains('hidden') ? '' : contenedorTexto.classList.add('hidden');
            contenedorCategoria.classList.contains('hidden') ? '' : contenedorCategoria.classList.add('hidden');
        }

        if(tipoConcepto === '3') {
            contenedorCategoria.classList?.remove('hidden');
            contenedorFolio.classList.contains('hidden') ? '' : contenedorFolio.classList.add('hidden');
            contenedorTexto.classList.contains('hidden') ? '' : contenedorTexto.classList.add('hidden');
        }
    }

    const obtenerValores = (e) => {
        e.preventDefault();
        conceptoBusqueda = '';
        const regex = /^\d{4}-\d{4}$/;
        
        if(tipoConcepto === '1') {
            conceptoBusqueda = contenedorTexto.querySelector('input').value.trim();

            if (conceptoBusqueda === '') {
                new Alerta({msg: 'El campo es obligatorio', position: divAlerta})
                return;
            }

            if (conceptoBusqueda.length < 4) {
                new Alerta({msg: 'Valor demasiado corto', position: divAlerta})
                return;
            }

            if (regex.test(conceptoBusqueda)) {
                new Alerta({msg: 'Este valor no es válido en este campo', position: divAlerta})
                return;
            }

            buscarCoincidencias();
        }

        if(tipoConcepto === '2') {

            conceptoBusqueda = contenedorFolio.querySelector('input').value.trim();
            if (conceptoBusqueda === '') {
                new Alerta({
                    msg: 'El campo es obligatorio',
                    position: divAlerta
                })
                return;
            } 
            
            if(!regex.test(conceptoBusqueda)) {
                new Alerta({
                    msg: 'El formato de folio es incorrecto, ej. 2502-0106',
                    position: divAlerta
                })

                return;
            }
             
             buscarCoincidencias()
        }

        if(tipoConcepto === '3') {
            if (selectCategoria.value === '' || selectIncidencia.value === '') { 
                new Alerta({msg: 'Ambos campos son obligatorios', position: divAlerta})
                return;
            }

            conceptoBusqueda = [selectCategoria.value, selectIncidencia.value]
            buscarCoincidencias();
        }
    }

    const buscarCoincidencias = async() => {
        saveLocalStorage('conceptoBusqueda', conceptoBusqueda);
        const res = await PostDatos.enviarArray(`${location.origin}/filtrar-reportes-coincidencias`, conceptoBusqueda);
        
        if(res.length === 0) {
            Alerta.Toast.fire({
                icon: 'warning',
                title: 'Upss!',
                text: 'No se encontraron resultados'
            })

            return;
        }

        limpiarHTML(divResultados);
        res.forEach((reporte) => {
            const divCoincidencia = document.createElement('DIV');
            divCoincidencia.className = 'bg-white dark:bg-gray-800 shadow rounded p-4 mb-4 uppercase text-left w-full space-y-2';

            const titulo = document.createElement('H2');
            titulo.className = 'text-xl font-bold dark:text-white';
            titulo.innerHTML = `Usuario: <span class="font-normal text-gray-700 dark:text-gray-300">${reporte.name || 'Sin nombre'}</span>`;
            divCoincidencia.appendChild(titulo);
            
            const descripcion = document.createElement('P');
            descripcion.className = 'text-sm text-gray-700 dark:text-gray-300';
            descripcion.innerHTML = `<span class="font-bold">Descripción:</span> ${reporte.description}`;
            divCoincidencia.appendChild(descripcion);

            const folio = document.createElement('P');
            folio.className = 'text-sm text-gray-700 dark:text-gray-300';
            folio.innerHTML = `<span class="font-bold">Folio:</span> ${reporte.id}`;
            divCoincidencia.appendChild(folio);

            const fecha = document.createElement('P');
            fecha.className = 'text-sm text-gray-700 dark:text-gray-300';
            fecha.innerHTML = `<span class="font-bold">Fecha:</span> ${reporte.created}`;
            divCoincidencia.appendChild(fecha);

            const direccion = document.createElement('P');
            direccion.className = 'text-sm text-gray-700 dark:text-gray-300';
            direccion.innerHTML = `<span class="font-bold">Dirección:</span> ${reporte.address}`;
            divCoincidencia.appendChild(direccion);

            const telefono = document.createElement('P');
            telefono.className = 'text-sm text-gray-700 dark:text-gray-300';
            telefono.innerHTML = `<span class="font-bold">Teléfono:</span> ${reporte.phone}`;
            divCoincidencia.appendChild(telefono);

            const link = document.createElement('A');
            link.className = 'bg-indigo-600 hover:bg-indigo-700 text-xs font-bold p-2 text-white rounded';
            link.innerHTML = `<a href="${location.origin}/reporte?folio=${reporte.id}">Acceder al reporte</a>`;
            
            const divLink = document.createElement('DIV');
            divLink.className = 'flex justify-center';
            divCoincidencia.appendChild(divLink);
            
            divLink.appendChild(link);

            divResultados.appendChild(divCoincidencia);
        })
    }
})()