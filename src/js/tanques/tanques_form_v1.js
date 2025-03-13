import GetDatos from '../classes/GetData_v1.js'
import PostDatos from '../classes/PostData_v1.js'

(() => {

    const selectNivel = document.querySelector('#nivel')
    const selectLlegada = document.querySelector('#llegada')
    const inputFecha = document.querySelector('#fecha')
    const selectTanque = document.querySelector('#tanque_id')
    const formulario = document.querySelector('#enviar-registro')

    let tanques = [];

    document.addEventListener('DOMContentLoaded', function() {
        obtenerTanques();
        formulario.addEventListener('submit', enviarFormulario)
    })

    const obtenerTanques = async () => {
        const url = `${location.origin}/tanques`;
        tanques = await GetDatos.consultar(url);
        
        completarSelectores();
    }

    const completarSelectores = () => {
        for( let i = 0; i < 10; i++) {
            const opcion = document.createElement('OPTION');
            opcion.value = i * .5;
            opcion.textContent = i * .5;
            selectNivel.appendChild(opcion)
        }

        for( let i = 0; i <= 10; i++) {
            const opcion = document.createElement('OPTION');
            opcion.value = i * 10;
            opcion.textContent = i * 10;
            selectLlegada.appendChild(opcion)
        }
        
        tanques.forEach( tanque => {
            const opcion = document.createElement('OPTION');
            opcion.value = tanque.id;
            opcion.textContent = tanque.nombre;
            selectTanque.appendChild(opcion);
        })
    }

    const enviarFormulario = async (e) => {
        e.preventDefault();

        const URL = `${location.origin}/guardar-registro`;
        const inputs = formulario.querySelectorAll('.input-form');

        const res = await PostDatos.guardarDatos(URL, inputs);
        if(res.tipo === 'Exito') {
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: res.mensaje
            })

            formulario.reset();
        }
    }
})()