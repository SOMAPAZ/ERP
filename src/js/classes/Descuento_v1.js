import Modal from "./Modal_v1.js";

export default class Descuento {
    static formularioDescuentoRecargos(btnAction) {
        {
            const formulario = document.createElement("FORM");
            formulario.className = "p-4 md:p-5";
            formulario.innerHTML = `<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>`;
            formulario.onsubmit = e => e.preventDefault()
            const h3 = document.createElement("H3");
            h3.className = "mb-5 text-lg font-normal text-gray-500 dark:text-gray-400";
            h3.textContent = "Ingrese el monto de recargos a descontar";
            const divAlerta = document.createElement('DIV');
            divAlerta.id = 'div-notif';
        
            const btnChange = document.createElement("BUTTON");
            btnChange.className ="text-xs font-semibold rounded-sm text-yellow-900 hover:bg-yellow-900 hover:text-white border border-yellow-900 px-3 py-1 dark:text-yellow-200 dark:border-yellow-200 dark:hover:bg-yellow-200 dark:hover:text-gray-900 mb-2";
            btnChange.textContent = "Porcentaje";
            btnChange.type = "button";
            btnChange.id = "botton-desc-tipo";
            btnChange.dataset.tipo = 1;
            btnChange.ondblclick = e => Descuento.cambiarTipoDesc(e);
        
            const input = document.createElement("INPUT");
            input.className = "w-full rounded-lg border border-gray-300 bg-white px-4 py-2 mb-4 text-gray-900 placeholder:text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:placeholder:text-gray-500";
            input.type = "number";
            input.name = "descuento"
        
            formulario.appendChild(h3);
            formulario.appendChild(divAlerta);
            formulario.appendChild(input);
            formulario.appendChild(btnChange);
            formulario.appendChild(btnAction); 
        
            Modal.renderModal(formulario, btnAction)
        }
    }

    static cambiarTipoDesc(e) {
        e.preventDefault()
        let tipoDesc = e.target;
  
        tipoDesc.parentElement.querySelector('input').value = "";
        tipoDesc.dataset.tipo === "1" ? tipoDesc.textContent = "Pesos" : tipoDesc.textContent = "Porcentaje";
        tipoDesc.dataset.tipo === "1" ? tipoDesc.dataset.tipo = 2 : tipoDesc.dataset.tipo = 1;      
    }
}