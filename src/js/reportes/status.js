import GetDatos from "../classes/GetData.js"
import PostDatos from "../classes/PostData.js"
import Alerta from "../classes/Alerta.js"
import { getSearch } from "../helpers/index.js"

(() => {
    const list = document.querySelectorAll('#ol-status button');
    const btnAbierto = document.querySelector('#status-1 button')
    const btnProcess = document.querySelector('#status-2 button')
    const btnCerrado = document.querySelector('#status-3 button')
    const btnTerminado = document.querySelector('#status-4 button')
    let estadoReporte = 1;

    document.addEventListener('DOMContentLoaded', () => {
        obtenerEstado();
        
        btnAbierto.addEventListener('click', () => cambiarStatus(btnAbierto.dataset.status))
        btnProcess.addEventListener('click', () => cambiarStatus(btnProcess.dataset.status))
        btnCerrado.addEventListener('click', () => cambiarStatus(btnCerrado.dataset.status))
        btnTerminado.addEventListener('click', () => cambiarStatus(btnTerminado.dataset.status))
    })

    const obtenerEstado = async() => {
        const url = `${location.origin}/reporte/estado?folio=${getSearch().folio}`;
        const res = await GetDatos.consultar(url);
        estadoReporte = Number(res)
        verificarEstado()
    }

    const cambiarStatus = async (status) => {
        const url = `${location.origin}/reporte/estado/actualizar`
        const estado = Number(status)
        const reporte = getSearch().folio;
        const arr = [estado, reporte]
        const res = await PostDatos.enviarArray(url, arr);
        
        if(res.tipo === 'Exito') {
            Alerta.Toast.fire({
                icon: 'success',
                title: 'Cambio exitoso',
                text: res.msg
            })

            estadoReporte = estado;
            verificarEstado();
        }
    }

    const verificarEstado = () => {
        list.forEach(elem => {
            const estado = Number(elem.dataset.status);
            const padre = elem.parentElement;
            
            if(estado <= estadoReporte) {
                padre.classList.remove('text-gray-500', 'dark:text-gray-400')
                padre.classList.add('text-blue-600', 'dark:text-blue-500')
                elem.classList.remove('border', 'border-gray-500', 'dark:border-gray-400')
                elem.classList.add('bg-blue-100', 'dark:bg-blue-800')
                elem.innerHTML = `<svg class="w-3.5 h-3.5 text-blue-600 lg:w-4 lg:h-4 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/></svg>`
            }

            if(estado > estadoReporte) {
                padre.classList.add('text-gray-500', 'dark:text-gray-400')
                padre.classList.remove('text-blue-600', 'dark:text-blue-500')
                elem.classList.add('border', 'border-gray-500', 'dark:border-gray-400')
                elem.classList.remove('bg-blue-100', 'dark:bg-blue-800')
                elem.innerHTML = ``;
                elem.textContent = estado;
            }
        });
    }
})()