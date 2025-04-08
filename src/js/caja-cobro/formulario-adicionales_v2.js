import GetDatos from "../classes/GetData_v1.js";
import Alerta from "../classes/Alerta_v1.js";
import { getLocalStorage, limpiarHTML } from "../helpers/index_v1.js";

(() => {

    let usuarios = [];
    const inputIdUser = document.querySelector('#idUser');
    const inputNombre = document.querySelector('#nombre');
    const inputDireccion = document.querySelector('#direccion');
    const inputTipoPago = document.querySelector('#tipo_pago');
    const listadoCoincidenciasID = document.querySelector("#listado-coincidencias-id");
    const listadoCoincidenciasNombre = document.querySelector("#listado-coincidencias-nombre");
    const btnEnviarForm = document.querySelector('#btn-enviar-pago');

    document.addEventListener("DOMContentLoaded", () => {
        obtenerUsuarios();
        inputIdUser.addEventListener('input', coincidirID);
        inputNombre.addEventListener('input', coincidirNombre);
        btnEnviarForm.addEventListener('click', enviarDatos);
    })

    const obtenerUsuarios = async () => usuarios = await GetDatos.consultar(`${location.origin}/api/users`);

    const coincidirID = e => {
        const id = e.target.value.trim();
        if(id === '') {
            limpiarHTML(listadoCoincidenciasID);
            return;
        }
        const coincidencias = [...usuarios].filter(usuario => `${usuario.id} - ${usuario.nombre}`.includes(id));
        renderizarListado(coincidencias, listadoCoincidenciasID);
    }

    const autocompletar = (usuario, listado) => {
        limpiarHTML(listado);
        inputIdUser.value = usuario.id;
        inputNombre.value = usuario.nombre;
        inputDireccion.value = usuario.direccion;
    }
    
    const coincidirNombre = e => {
        const nombre = e.target.value.trim().toLowerCase();
        if(nombre === '' || nombre.length < 4) {
            limpiarHTML(listadoCoincidenciasNombre);
            return;
        }
        const coincidencias = [...usuarios].filter(usuario => `${usuario.nombre}`.includes(nombre));
        renderizarListado(coincidencias, listadoCoincidenciasNombre);
    }

    const renderizarListado = (arr, listado) => {
        limpiarHTML(listado);
        arr.forEach( coincidencia => {
            const li = document.createElement("LI");
            li.className = "block rounded-lg bg-gray-100 hover:bg-gray-400 hover:text-white shadow text-gray-800 text-sm font-semibold px-2 py-2 text-center uppercase cursor-pointer dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:hover:text-gray-400";
            li.textContent = `${coincidencia.id} - ${coincidencia.nombre}`;
            li.onclick = () => autocompletar(coincidencia, listado);
            listado.appendChild(li);
        })
    }

    const enviarDatos = async () => {
        const id = inputIdUser.value;
        const nombre = inputNombre.value;
        const direccion = inputDireccion.value;
        const adicionales = getLocalStorage('costosAdicionales');

        if(nombre === '' || direccion === '' || adicionales === null || inputTipoPago.value === '') {
            new Alerta({ msg: 'El nombre, dirección y tipo de pago son obligatorios, además debe ingresar al menos un costo',
                position: document.querySelector('.alertas') 
            });
            return;
        }

        const URL = `${location.origin}/pago-parcial`;

        try {
            const data = new FormData();
            data.append('id', id);
            data.append('nombre', nombre);
            data.append('direccion', direccion);
            data.append('tipo_pago', inputTipoPago.value);
            data.append('adicionales', JSON.stringify(adicionales));

            const response = await fetch(URL, {
                method: 'POST',
                body: data
            });

            const resultado = await response.json();

            if(resultado.tipo === "Exito") {
                Swal.fire({
                    title: `Pago guardado correctamente con folio ${resultado.folio}`,
                    text: "El pago se ha guardado correctamente",
                    icon: "success",
                    confirmButtonText: "Mostrar recibo",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false, 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(`pdf/recibo-adicionales?folio=${resultado.folio}&id=${resultado.id_user}`, '_blank');
                        location.href = `${location.origin}/consultar`;
                    }
                });
            }
        } catch (error) {
            console.log(error);
        }
    }

    
})()