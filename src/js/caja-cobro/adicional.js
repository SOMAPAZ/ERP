import Modal from "../classes/Modal_v1.js";
import GetDatos from "../classes/GetData_v1.js"
import Alerta from "../classes/Alerta_v1.js";
import { saveLocalStorage, deleteLocalStorage, getLocalStorage, limpiarHTML } from "../helpers/index_v1.js";

(() => {
    const btnpagoAdicional = document.querySelector("#btn-consto-adicional");
    const listadoAdicionales = document.querySelector("#listado-adicionales ul");
    let costosAdicionales = [];
    let costoAdicional = {};
    let agregados = [];

    window.addEventListener("unload", function () {
        getLocalStorage('costosAdicionales') ? deleteLocalStorage('costosAdicionales') : null;
    });

    document.addEventListener("DOMContentLoaded", () => {
        getLocalStorage('costosAdicionales') ? deleteLocalStorage('costosAdicionales') : null;
        obtenerCostosAdicionales();
        btnpagoAdicional.addEventListener('click', mostrarFormulario);
    });

    const obtenerCostosAdicionales = async () => {
        const url = `${location.origin}/cuentas-adicionales`;
        costosAdicionales = await GetDatos.consultar(url);
    }

    const mostrarFormulario = () => {
        const formulario = document.createElement('FORM');
        formulario.className = 'flex flex-col gap-2 p-4 my-5 space-y-2';

        const divCostoAdicional = document.createElement('DIV');

        const labelCostoAdicional = document.createElement('LABEL');
        labelCostoAdicional.className = 'block text-sm font-medium text-gray-700 dark:text-gray-400 uppercase my-1';
        labelCostoAdicional.textContent = 'Costo';
        labelCostoAdicional.htmlFor = 'costo';

        const inputCostoAdicional = document.createElement('INPUT');
        inputCostoAdicional.className = 'block w-full px-4 py-2 rounded-md border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white text-sm overflow-hidden text-ellipsis whitespace-nowrap';
        inputCostoAdicional.type = 'number';
        inputCostoAdicional.name = 'costo';
        inputCostoAdicional.id = 'costo';
        inputCostoAdicional.onchange = e => costoAdicional.cantidad = +e.target.value;
        
        divCostoAdicional.appendChild(labelCostoAdicional);
        divCostoAdicional.appendChild(inputCostoAdicional);
        
        const divAdicional = document.createElement('DIV');
        
        const labelAdicional = document.createElement('LABEL');
        labelAdicional.className = 'block text-sm font-medium text-gray-700 dark:text-gray-400 uppercase my-1';
        labelAdicional.textContent = 'Descripción';
        labelAdicional.htmlFor = 'adicional';
        
        const selectAdicional = document.createElement('SELECT');
        selectAdicional.className = 'block w-full px-4 py-2 rounded-md border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white text-sm overflow-hidden text-ellipsis whitespace-nowrap';
        selectAdicional.name = 'adicional';
        selectAdicional.id = 'adicional';
        selectAdicional.onchange = e => {
            costoAdicional = costosAdicionales.find(costo => costo.id === e.target.value);
            inputCostoAdicional.value = +costoAdicional.cantidad ?? 0;
        }

        const emptyOption = document.createElement('OPTION');
        emptyOption.classList.add('text-sm', 'truncate')
        emptyOption.value = '';
        emptyOption.textContent = '-- Seleccione una opción --';
        selectAdicional.appendChild(emptyOption);
        
        costosAdicionales.forEach(costo => {
            const option = document.createElement('OPTION');
            option.classList.add('text-xs', 'truncate')
            option.value = costo.id;
            option.textContent = costo.cuenta.length >= 48 ? `${costo.cuenta.substring(0, 48)} ...` : costo.cuenta;
            selectAdicional.appendChild(option);
        })

        divAdicional.appendChild(labelAdicional);
        divAdicional.appendChild(selectAdicional);


        formulario.appendChild(divAdicional);
        formulario.appendChild(divCostoAdicional);

        const btnEnviar = document.createElement('INPUT');
        btnEnviar.className = 'py-2 px-4 bg-green-700 text-white rounded font-semibold text-sm hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-700';
        btnEnviar.type = 'submit';
        btnEnviar.value = 'Agregar';

        formulario.onsubmit = e => e.preventDefault();

        btnEnviar.onclick = () => {
            if(selectAdicional.value === '' || inputCostoAdicional.value === '' || inputCostoAdicional.value === '0') {
                Alerta.Toast.fire({
                    icon: 'error',
                    title: 'Campos erroneos',
                    text: 'Campos vacíos o valor no agregado'
                })
                return;
            }
            formulario.reset();
            agregarAdicionalesDOM();
        }

        Modal.renderModal(formulario, btnEnviar);
    }

    const agregarAdicionalesDOM = () => {
        console.log(costoAdicional)

        if(agregados.find(costo => costo.id === costoAdicional.id)) {
            Alerta.Toast.fire({
                icon: 'error',
                title: 'El costo ya existe',
                text: 'No se puede agregar el mismo costo'
            })
            return;
        }

        console.log(costoAdicional.cantidad);

        agregados = [...agregados, costoAdicional];
        saveLocalStorage('costosAdicionales', agregados);

        Alerta.Toast.fire({
            icon: 'success',
            title: 'Agregado',
            text: 'El costo ha sido agregado'
        })

        renderizarAgregados();
    }

    const renderizarAgregados = () => {
        limpiarHTML(listadoAdicionales);

        agregados.forEach(agregado => {
            const liAdd = document.createElement('LI');
            liAdd.className = 'flex flex-row gap-2 items-center font-bold uppercase text-sm dark:text-white';
            liAdd.innerHTML = `Cuenta: <span class="font-normal"> ${agregado.cuenta}</span> Monto:<span class="text-sm text-gray-700 dark:text-gray-200">$ ${agregado.cantidad}</span>`;
            listadoAdicionales.appendChild(liAdd);
        });

        const total = agregados.reduce((acum, item) => acum + +item.cantidad, 0);
        const liTotal = document.createElement('LI');
        liTotal.className = 'flex flex-row gap-2 items-center text-center text-xl font-bold uppercase text-sm dark:text-white';
        liTotal.innerHTML = `Total: <span class="font-normal"> $ ${total}</span>`;
        listadoAdicionales.appendChild(liTotal);
    }

})()