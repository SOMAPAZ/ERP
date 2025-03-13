(()=> {
    const table = document.querySelector('#table-deudores tbody');
    const btnAnterior = document.querySelector('#btn-anterior');
    const btnSiguiente = document.querySelector('#btn-siguiente');
    const infoPagina = document.querySelector('#info-pagina');
    const selectColonia = document.querySelector('#colonia');
    const selectZona = document.querySelector('#zona');
    const selectMeses = document.querySelector('#meses');
    const selectCantidad = document.querySelector('#cantidad');
    const btnReset = document.querySelector('#btn-reset');
    const filtradoText = document.querySelector('#filtrado-text');
    const resultadosText = document.querySelector('#resultados-text');
    let itemPorPagina = 30;
    let paginaActual = 1;
    let totalItems = 0;
    let deudores = [];
    let order = 'ASC';
    let orderBy = 'id';
    let filtrado = '';
    let id_filter = '';
    let urlFilter = '';
    let between = '';
    let bettweenMonto = ''; 
    let colonias = [];
    let zonas = [];

    document.addEventListener('DOMContentLoaded', function() {
        consultarDeudores();
        consultarColonias();
        consultarZonas();
        btnAnterior.addEventListener("click", disminuirPaso);
        btnSiguiente.addEventListener("click", aumentarPaso);

        selectColonia.addEventListener("change", (e) => {
            itemPorPagina = 30
            paginaActual = 1
            totalItems = 0
            filtrado = e.target.value.trim();
            e.target.parentElement.reset();
            id_filter = 'id_colony';
            urlFiltrar();
            filtradoText.textContent = `${colonias.find(opcion => opcion.id === filtrado).name}`;
        });
        selectZona.addEventListener("change", (e) => {
            itemPorPagina = 30
            paginaActual = 1
            totalItems = 0
            filtrado = e.target.value.trim();
            e.target.parentElement.reset();
            id_filter = 'id_zone';
            urlFiltrar();
            filtradoText.textContent = `${zonas.find(opcion => opcion.id === filtrado).name}`;
        });
        selectMeses.addEventListener("change", (e) => {
            itemPorPagina = 30
            paginaActual = 1
            totalItems = 0
            between = e.target.value.trim();
            e.target.parentElement.reset();
            filtrarMeses();

            between.split('_')[0] === "13" ? filtradoText.textContent = "Más de 13 meses" : filtradoText.textContent = `${between.split('_')[0]} a ${between.split('_')[1]} meses`;
        });
        selectCantidad.addEventListener("change", (e) => {
            console.log(e.target.value);
        });

        btnReset.addEventListener("click", (e) => {
            e.target.parentElement.reset();
            urlFilter = '';
            consultarDeudores();
            filtradoText.textContent = "Ninguno";
        });
    });

    async function consultarDeudores(url = '') {
        try {
            if (url === '') {
                url = `${location.origin}/notificaciones/deudores?limite=${itemPorPagina}&offset=${obtenerOffset()}`;
            }
            const response = await fetch(url);
            const data = await response.json();

            deudores = data.usuarios;
            totalItems = data.total;
            resultadosText.textContent = `${totalItems} resultados`;

            renderizarDeudores();

            if(itemPorPagina > deudores.length || itemPorPagina + obtenerOffset() >= totalItems){
                btnSiguiente.classList.remove("flex")
                btnSiguiente.classList.add("hidden")
            } else {
                btnSiguiente.classList.remove("hidden");
                btnSiguiente.classList.add("flex");
            };

        } catch (error) {
            console.log(error);
        }
    }

    async function consultarColonias() {
        try {
            const url = `${location.origin}/api/colonias`;
            const response = await fetch(url);
            colonias = await response.json();

            colonias.map((opcion) => {
                if(opcion.id !== "1"){
                    const option = document.createElement('OPTION');
                    option.value = opcion.id;
                    option.text = opcion.name;
                    selectColonia.appendChild(option);
                }
            });
        } catch (error) {
            console.log(error);
        }
    }

    async function consultarZonas() {
        try {
            const url = `${location.origin}/api/zonas`;
            const response = await fetch(url);
            zonas = await response.json();

            zonas.map((opcion) => {
                if(opcion.id !== "1"){
                    const option = document.createElement('OPTION');
                    option.value = opcion.id;
                    option.text = opcion.name;
                    selectZona.appendChild(option);
                }
            });
        } catch (error) {
            console.log(error);
        }
    }

    function obtenerOffset() {
        if (paginaActual - 1 === 0) return 0;
        return (paginaActual - 1) * itemPorPagina;
    }

    function aumentarPaso() {
        paginaActual++;
        if (urlFilter === '') {
            consultarDeudores() 
        } else if (between === '') {
            urlFiltrar();
        } else {
            filtrarMeses();
        };
    }

    function disminuirPaso() {
        paginaActual--;
        if (urlFilter === '') {
            consultarDeudores() 
        } else if (between === '') {
            urlFiltrar();
        } else {
            filtrarMeses();
        };
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

    function renderizarDeudores() {
        limpiarAnterior(table);

        comprobarActual();
        const corteDeInicio = (paginaActual - 1) * itemPorPagina;
        infoPagina.innerHTML = `Mostrando <span class="font-semibold text-gray-900 dark:text-white">${obtenerOffset() + 1}</span> a <span class="font-semibold text-gray-900 dark:text-white">${(corteDeInicio + itemPorPagina) > totalItems ? totalItems : corteDeInicio + itemPorPagina}</span> de <span class="font-semibold text-gray-900 dark:text-white">${totalItems}</span> resultados`;

        deudores.map((deudor) => {
            const tr = document.createElement('TR');
            tr.className = "whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 uppercase";

            const tdID = document.createElement('TD');
            tdID.className = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            tdID.textContent = deudor.id;

            const tdNombre = document.createElement('TD');
            tdNombre.className = "px-6 py-4";
            tdNombre.textContent = `${deudor.user} ${deudor.lastname}`.slice(0, 40) + "...";

            const tdAddress = document.createElement('TD');
            tdAddress.className = "px-6 py-4";
            tdAddress.textContent = deudor.address.slice(0, 40) + "...";

            const tdColonia = document.createElement('TD');
            tdColonia.className = "px-6 py-4";
            tdColonia.textContent = deudor.id_colony;

            const tdZona = document.createElement('TD');
            tdZona.className = "px-6 py-4";
            tdZona.textContent = deudor.id_zone;

            const tdMesesRec = document.createElement('TD');
            tdMesesRec.className = "px-6 py-4";
            tdMesesRec.textContent = deudor.adeudos.meses_rezagados;

            const tdTotal = document.createElement('TD');
            tdTotal.className = "px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white";
            const deudaTotal = Number(deudor.adeudos.total);
            tdTotal.textContent = `$ ${deudaTotal.toLocaleString("en-US")}`;

            const tdAdd = document.createElement('TD');
            tdAdd.className = "py-2 px-6";
            const btnAdd = document.createElement('BUTTON');
            btnAdd.className = "flex items-center justify-center w-full uppercase text-blue-600 hover:text-blue-900 dark:text-blue-300 dark:hover:text-blue-500 text-xs py-1 px-3 rounded-md gap-2";
            btnAdd.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /></svg><p class="font-bold text-xs">Agregar</p>`;
            tdAdd.appendChild(btnAdd);

            tr.appendChild(tdID);
            tr.appendChild(tdNombre);
            tr.appendChild(tdAddress);
            tr.appendChild(tdColonia);
            tr.appendChild(tdZona);
            tr.appendChild(tdMesesRec);
            tr.appendChild(tdTotal);
            tr.appendChild(tdAdd);

            table.appendChild(tr);
        });
    }

    function limpiarAnterior(where) {
        while (where.firstChild) {
            where.removeChild(where.firstChild);
        }
    }

    function urlFiltrar() {
        if(filtrado === "" || id_filter === "") return;
        urlFilter = `${location.origin}/notificaciones/deudores?limite=${itemPorPagina}&offset=${obtenerOffset()}&id_filter=${id_filter}&whoffset=${filtrado}`;
        consultarDeudores(urlFilter);
    }

    function filtrarMeses() {
        if(between === "") return;
        urlFilter = `${location.origin}/notificaciones/deudores?limite=${itemPorPagina}&offset=${obtenerOffset()}&between=${between}`;
        consultarDeudores(urlFilter);
    }

})();