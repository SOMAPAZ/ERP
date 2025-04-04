import { getSearch, limpiarHTML } from "../helpers/index_v1.js";
import GetDatos from "../classes/GetData_v1.js";
import PostDatos from "../classes/PostData_v1.js";
import Alerta from "../classes/Alerta_v1.js";

(() => {
    const table = document.querySelector("#condonacion-desglose tbody");
    let condonaciones = [];

    document.addEventListener("DOMContentLoaded", () => {
        obtenerCondonaciones();
    })

    const obtenerCondonaciones = async () => {
        const id = getSearch().usuario;
        const url = `${location.origin}/consultar-condonaciones-listado?id=${id}`;
        condonaciones = await GetDatos.consultar(url);
        
        renderizarCondonaciones();
    }

    const renderizarCondonaciones = () => {
        limpiarHTML(table);

        if(condonaciones.length === 0) {
            const tr = document.createElement("TR");
            tr.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";
            
            const tdEmpty = document.createElement("TD");
            tdEmpty.className = "px-4 py-5 text-xl font-medium text-gray-900 whitespace-nowrap dark:text-white";
            tdEmpty.textContent = "No hay datos";
            tdEmpty.setAttribute("colspan", "5");

            tr.appendChild(tdEmpty);
            table.appendChild(tr);
            return;
        }

        condonaciones.map(condonacion => {
            const tr = document.createElement("TR");
            tr.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600";
            tr.dataset.idx = condonacion.id;

            const tdUser = document.createElement("TD");
            tdUser.className = "px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            tdUser.textContent = condonacion.id_user;

            const tdYear = document.createElement("TD");
            tdYear.className = "px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            tdYear.textContent = condonacion.year;

            const tdMes = document.createElement("TD");
            tdMes.className = "px-4 py-2 uppercase";
            const opciones = { month: 'long'};
            tdMes.textContent = new Date(condonacion.mes).toLocaleDateString('es-MX', opciones);

            const tdMonto = document.createElement("TD");
            tdMonto.className = "px-4 py-2";
            tdMonto.textContent = `$ ${condonacion.monto_agua}`;

            const tdAcciones = document.createElement("TD");
            tdAcciones.className = "px-4 py-2";

            const btnDeshacer = document.createElement("BUTTON");
            btnDeshacer.className = "text-red-700 dark:text-red-200 font-bold flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2";
            btnDeshacer.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-700 dark:text-red-200"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>Deshacer Condonación`;
            btnDeshacer.onclick = () => deshacerCondonacion(condonacion.id);
            tdAcciones.appendChild(btnDeshacer);

            tr.appendChild(tdUser);
            tr.appendChild(tdYear);
            tr.appendChild(tdMes);
            tr.appendChild(tdMonto);
            tr.appendChild(tdAcciones);
            table.appendChild(tr);
        });
    }

    const deshacerCondonacion = async (id) => {
        const url = `${location.origin}/deshacer-condonacion?id=${id}`;
        const res = await PostDatos.eliminarDatos(url, id);

        if(res.tipo === 'Exito') {
            Alerta.Toast.fire({
                icon: 'success',
                title: 'Exito',
                text: res.mensaje
            })

            condonaciones = [...condonaciones].filter(cond => cond.id !== id);
            renderizarCondonaciones();
        }
    }
})()