import { limpiarHTML } from "../helpers/funciones.js";

(() => {
    const tabla = document.querySelector("#table-medido tbody")
    const itemPorPagina = 30;
    let paginaActual = 1;
    let totalItems = 0;
    let medidos = []

    document.addEventListener("DOMContentLoaded", function () {
        consultarMedido();
    })

    async function consultarMedido() {
        try {
            const url = `${location.origin}/notificaciones/medido?limite=${itemPorPagina}&offset=${obtenerOffset()}`
            const response = await fetch(url)
            const data = await response.json()
            medidos = data.usuarios
            totalItems = data.total
            renderizarMedido()
        } catch (error) {
            console.log(error)
        }
    }

    function renderizarMedido() {
        limpiarHTML(tabla);

        medidos.map((medidio) => {
            const tr = document.createElement('TR');
            tr.className = "whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 uppercase";

            const tdID = document.createElement('TD');
            tdID.className = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            tdID.textContent = medidio.id;

            const tdNombre = document.createElement('TD');
            tdNombre.className = "px-6 py-4";
            tdNombre.textContent = `${medidio.user} ${medidio.lastname}`.slice(0, 30) + "...";

            const tdAddress = document.createElement('TD');
            tdAddress.className = "px-6 py-4";
            tdAddress.textContent = medidio.address.slice(0, 30) + "...";

            const tdColonia = document.createElement('TD');
            tdColonia.className = "px-6 py-4";
            tdColonia.textContent = medidio.id_colony;

            const tdZona = document.createElement('TD');
            tdZona.className = "px-6 py-4";
            tdZona.textContent = medidio.id_zone;

            const tdMesesRec = document.createElement('TD');
            tdMesesRec.className = "px-6 py-4"
            tdMesesRec.textContent = medidio.adeudos.meses_rezagados;

            const tdTotal = document.createElement('TD');
            tdTotal.className = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            const deudaTotal = Number(medidio.adeudos.total);
            tdTotal.textContent = `$ ${deudaTotal.toLocaleString("en-US")}`;

            const tdAdd = document.createElement('TD');
            tdAdd.className = "py-2 px-6";
            const btnAdd = document.createElement('BUTTON');
            btnAdd.className = "flex items-center justify-center w-full uppercase text-blue-600 hover:text-blue-900 dark:text-blue-300 dark:hover:text-blue-500 text-xs py-1 px-3 rounded-md gap-2";
            btnAdd.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" /></svg><p class="font-bold text-xs">Agendar</p>`;
            tdAdd.appendChild(btnAdd);

            tr.appendChild(tdID);
            tr.appendChild(tdNombre);
            tr.appendChild(tdAddress);
            tr.appendChild(tdColonia);
            tr.appendChild(tdZona);
            tr.appendChild(tdMesesRec);
            tr.appendChild(tdTotal);
            tr.appendChild(tdAdd);

            tabla.appendChild(tr);
        });
    }

    function obtenerOffset() {
        if (paginaActual - 1 === 0) return 0
        return (paginaActual - 1) * itemPorPagina
    }

    function aumentarPaso() {
        paginaActual++;
        consultarMedido()
    }

    function disminuirPaso() {
        paginaActual--;
        consultarMedido()
    }

})()