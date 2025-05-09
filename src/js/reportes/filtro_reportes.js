import Alerta from "../classes/Alerta.js";

(() => {
    const dropdownCategoryButton = document.querySelector("#dropdownCategoryButton");
    const dropdownIncidenceButton = document.querySelector("#dropdownIncidenceButton");

    if(dropdownCategoryButton && dropdownIncidenceButton) {
        const btnCategorySearch = document.querySelector("#btnCategorySearch");
        const btnIncidenceSearch = document.querySelector("#btnIncidenceSearch");
        const btnCategoryClear = document.querySelector("#btnCategoryClear");
        const btnIncidenceClear = document.querySelector("#btnIncidenceClear");
        const parrTotal = document.querySelector('#total-reportes');
        btnCategorySearch.addEventListener("click", obtenerValores);
        btnIncidenceSearch.addEventListener("click", obtenerValores);

        mostarOcultarDropdown(dropdownCategoryButton, "Category");
        mostarOcultarDropdown(dropdownIncidenceButton, "Incidence");
        btnCategoryClear.addEventListener("click", () => resetearFiltros("Category"));
        btnIncidenceClear.addEventListener("click", () => resetearFiltros("Incidence"));
        const filas = document.querySelectorAll("#table-reportes tbody tr");

        function resetearFiltros(name) {
            const dropdown = document.querySelector(`#dropdown${name}`);
            dropdown.classList.add("hidden");
            dropdown.reset();
            filas.forEach(fila => fila.classList?.remove("hidden"));
            parrTotal.textContent = `${filas.length} reportes`;
        }
        
        function mostarOcultarDropdown(button, name) {
            const dropdown = document.querySelector(`#dropdown${name}`);
            dropdown.addEventListener("submit", e => e.preventDefault());
            const btnDropdownClose = document.querySelector(`#btnDropdown${name}Close`);
            button.addEventListener("click", () => dropdown.classList.toggle("hidden"));
            btnDropdownClose.addEventListener("click", () => dropdown.classList.add("hidden"));
        }

        function obtenerValores(e) {
            const list = e.target.parentElement.parentElement.querySelectorAll("li input[type='checkbox']:checked");
            const listValues = Array.from(list).map((item) => item.value);

            if(!listValues.length) {
                Alerta.ToastifyError("Seleccione al menos una opción");
                return
            }

            const dataName = e.target.id === "btnCategorySearch" ? "category" : "incidence";
            const dropdown = document.querySelector(`#dropdown${dataName.charAt(0).toUpperCase() + dataName.slice(1)}`);

            filas.forEach(fila => {
                const row = fila.querySelector(`.${dataName}-row`).getAttribute(`data-${dataName}Id`);
                listValues.includes(row) ? fila.classList.remove("hidden") : fila.classList.add("hidden");
            });
            let filasMostradas = Array.from(filas).filter(fila => !fila.classList.contains("hidden"));
            document.querySelector(`#btn${dataName.charAt(0).toUpperCase() + dataName.slice(1)}Clear`).classList?.remove("hidden");

            if(filasMostradas.length === 0) {
                Alerta.ToastifyError("No se encontraron reportes con los filtros seleccionados");
                filas.forEach(fila => fila.classList?.remove("hidden"));
                document.querySelector(`#btn${dataName.charAt(0).toUpperCase() + dataName.slice(1)}Clear`).classList.add("hidden");
                filasMostradas = filas
            }
            
            dropdown.classList.add("hidden");
            dropdown.reset();
            parrTotal.textContent = `Filtrados ${filasMostradas.length} reportes`;
        }

    }
})();
