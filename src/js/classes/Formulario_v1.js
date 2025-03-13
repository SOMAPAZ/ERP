export default class Formulario {
    static crearInput(form, desc, tipo, atributo, valor = null) {
        const div = document.createElement("DIV");

        const label = document.createElement("LABEL");
        label.setAttribute("for", atributo);
        label.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
        label.textContent = desc;

        const input = document.createElement("INPUT");
        input.type = tipo;
        input.name = atributo;
        input.id = atributo;
        input.className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white input-form";
        if (valor === null) {
            input.placeholder = desc;
        } else {
            input.value = valor;
            input.placeholder = desc;
        }

        tipo !== "hidden" ? div.appendChild(label) : null;
        div.appendChild(input);
        form.appendChild(div);
    }

    static crearSelect(form, desc, atributo, opciones, valor = null) {
        const div = document.createElement("DIV");

        const label = document.createElement("LABEL");
        label.setAttribute("for", atributo);
        label.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
        label.textContent = desc;

        const select = document.createElement("SELECT");
        select.name = atributo;
        select.id = atributo;
        select.className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white input-form";
        const optionVacio = document.createElement("OPTION");
        optionVacio.value = "";
        optionVacio.textContent = `- ${desc} -`;
        select.appendChild(optionVacio);

        opciones.map((opcion) => {
            const option = document.createElement("OPTION");
            option.value = opcion.id;
            option.textContent = opcion.name;
            if (opcion.name === valor) option.selected = true;
            select.appendChild(option);
        });

        div.appendChild(label);
        div.appendChild(select);
        form.appendChild(div);
    }

    static crearTextarea(form, desc, atributo, valor = null) {
        const div = document.createElement("DIV");

        const label = document.createElement("LABEL");
        label.setAttribute("for", atributo);
        label.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase";
        label.textContent = desc;

        const textarea = document.createElement("TEXTAREA");
        textarea.name = atributo;
        textarea.id = atributo;
        textarea.className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white input-form";
        if (valor === null) {
            textarea.placeholder = desc;
        } else {
            textarea.value = valor;
            textarea.placeholder = desc;
        }

        div.appendChild(label);
        div.appendChild(textarea);
        form.appendChild(div);
    }
}