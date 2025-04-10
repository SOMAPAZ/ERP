import Modal from '../classes/Modal_v1.js';
import GetDatos from '../classes/GetData_v1.js';
import { limpiarHTML } from '../helpers/index_v1.js';

(function() {
    const btnbuscarUsuario = document.querySelector('#btn-buscar-usuario');
    let usuarios = [];
    let user = {};
    consultarUsuario();

    async function consultarUsuario() {
        const url = `${location.origin}/api/usuarios`;
        usuarios = await GetDatos.consultar(url);
    }

    btnbuscarUsuario.addEventListener('click', function() {
        const btnIr = document.createElement('BUTTON');
        btnIr.className = 'py-2 px-5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700';
        btnIr.textContent = 'Ver Información';
        btnIr.onclick = mostrarInformacion;

        const divInput = document.createElement('FORM');
        divInput.autocomplete = 'off';
        divInput.className = 'flex flex-col my-4 p-3';

        const labelBuscar = document.createElement('LABEL');
        labelBuscar.className = 'block text-xs font-bold uppercase text-gray-900 dark:text-gray-400 mb-1';
        labelBuscar.textContent = 'Buscar por id, nombre o dirección';
        const inputBuscar = document.createElement('INPUT');
        inputBuscar.className = 'w-full py-2 px-3 text-xs uppercase focus:outline-hidden text-gray-900 rounded border border-gray-200 dark:text-gray-400 dark:border-gray-600 bg-gray-200 dark:bg-gray-700 mb-2';
        inputBuscar.type = 'text';
        inputBuscar.id = 'input-buscar-usuario';
        inputBuscar.placeholder = 'Buscar por id, nombre o dirección';
        inputBuscar.oninput = filtrarCoincidencias;

        const lista = document.createElement('UL');
        lista.className = 'list-none m-0 p-0 space-y-2';
        lista.id = 'listado-coincidencias';
        
        divInput.appendChild(labelBuscar);
        divInput.appendChild(inputBuscar);
        divInput.appendChild(lista);
        Modal.renderModal(divInput, btnIr);
    });

    function mostrarInformacion() {
        if(!user.id) return;
        if(location.pathname === '/usuarios') {
            location.href = `buscar-usuario?id=${user.id}`;
        } else {
            location.href = `/datos-usuarios-editar?id=${user.id}`;
        }
    }

    function filtrarCoincidencias(e) {
        const lista = document.querySelector('#listado-coincidencias');
        limpiarHTML(lista);

        const valor = e.target.value.trim();

        if(Number.isInteger(+valor)) {
            const coincidencia = usuarios.find(usuario => usuario.id === valor);
            if(coincidencia) {
                autocompletar(coincidencia);
            } else {
               user = {};
               return;
            }
        
            return;
        };

        if(valor.length < 5) return;
        const coincidencias = [...usuarios].filter( usuario => {
            const con = `${usuario.id} - ${usuario.nombre} - ${usuario.direccion}`;
            return con.toLowerCase().includes(valor.toLowerCase());
        });

        coincidencias.forEach(coincidencia => {
            const li = document.createElement('LI');
            li.className = 'block bg-gray-200 text-gray-800 px-4 py-2 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200 uppercase cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-600 rounded shadow';
            li.textContent = `${coincidencia.id} - ${coincidencia.nombre}`;
            li.onclick = () => autocompletar(coincidencia);
            lista.appendChild(li);
        });

    }

    function autocompletar (usuario) {
        const lista = document.querySelector('#listado-coincidencias');
        limpiarHTML(lista);
        
        user = usuario;

        const li = document.createElement('LI');
        li.className = 'block bg-gray-200 text-gray-800 px-4 py-2 text-xs font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-200 uppercase cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-600 rounded shadow';
        li.textContent = `${usuario.id} - ${usuario.nombre}`;
        lista.appendChild(li);
    }
})();