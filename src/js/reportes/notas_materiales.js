import Modal from "../classes/Modal.js";
import { limpiarHTML } from "../helpers/index.js";
const imagenes = document.querySelectorAll('[data-imagen]');
const inputMaterial = document.querySelector('#material');

(() => {

    if(imagenes) {
        imagenes.forEach(imagen => imagen.addEventListener('click', function() {
            const div = document.createElement('DIV');
            div.className = "w-full flex-col justify-center items-center";
            
            const img = document.createElement('IMG');
            img.className = "rounded-lg p-5"
            img.src = imagen.getAttribute("src");
    
            div.appendChild(img);
    
            const btnAdd = document.createElement('BUTTON');
            btnAdd.className = "text-white bg-indigo-700 hover:bg-indigo-800 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700";
            btnAdd.textContent = '';
    
            Modal.renderModal(div, btnAdd);
        }))
    }
    
    if(inputMaterial) {
        let materiales = [];
        let materialesFiltrados = [];
        const listadoMateriales = document.querySelector('#listado-materiales');
        inputMaterial.addEventListener('input', valoresInput)
    
        obtenerMateriales();
    
        async function obtenerMateriales() {
            const response = await fetch(`${location.origin}/api/materiales`);
            materiales = await response.json();
        }
    
        function valoresInput(e) {
            const valor = e.target.value.trim();
            
            if(valor.length >= 5) {
                const expresion = new RegExp(valor, 'i');
                materialesFiltrados = materiales.filter( material => {
                    if(material.name.search(expresion) != -1){
                        return material
                    }
                });
            } else {
                materialesFiltrados = [];
            }
    
            mostrarMateriales(materialesFiltrados);
        }
    
        function mostrarMateriales(materialesFiltrados) {
            
            limpiarHTML(listadoMateriales);
    
            if(materialesFiltrados.length > 0) {
                materialesFiltrados.forEach(material => {
                    const materialOption = document.createElement('li');
                    materialOption.className = "flex items-center gap-2 py-2 px-6 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 dark:hover:bg-gray-700 dark:bg-gray-600 dark:text-white rounded-lg uppercase font-bold cursor-pointer";
                    materialOption.textContent = material.name;
                    materialOption.onclick = () => agregarMaterial(material);
                    listadoMateriales.appendChild(materialOption);
                });
            } else {
                const parr = document.createElement('p');
                parr.className = "flex items-center gap-2 py-2 px-6 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 dark:hover:bg-gray-700 dark:bg-gray-600 dark:text-white rounded-lg uppercase font-bold";
                parr.textContent = "No hay materiales coincidentes";
                listadoMateriales.appendChild(parr);
            }
        }
    
        function agregarMaterial(material) {
            inputMaterial.value = material.name;
            limpiarHTML(listadoMateriales);
        }
    }
})();
