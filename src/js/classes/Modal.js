export default class Modal {
    static styledModal(content, buttons) {
        const divBg = document.createElement('DIV');
        divBg.className = 'overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-600 bg-opacity-80 transition-opacity duration-300 ease-in-out opacity-0 default-modal';

        const divBgBody = document.createElement('DIV');
        divBgBody.className = 'relative p-4 w-full max-w-xl max-h-full mx-auto mt-20 rounded';

        const divBody = document.createElement('DIV');
        divBody.className = 'relative bg-white rounded-lg shadow-sm p-4 md:p-6 dark:bg-gray-800';

        const btnCloseModal = document.createElement('BUTTON');
        btnCloseModal.className = 'absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center';
        btnCloseModal.innerHTML = `<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>`;
        btnCloseModal.onclick = () => {
            divBg.classList.add('opacity-0');
            setTimeout(() => divBg?.remove(), 300);
        };

        divBody.appendChild(btnCloseModal);
        divBody.appendChild(content);
        divBody.appendChild(buttons);

        divBgBody.appendChild(divBody);
        divBg.appendChild(divBgBody);
        document.querySelector('main').appendChild(divBg);
        setTimeout(() => divBg.classList.remove('opacity-0'), 10);
    }

    static renderModal(contenido, btn) {
        const divBtns = document.createElement('DIV')
        divBtns.className = 'flex flex-row flex-nowrap justify-center gap-5';
        const btnClose = document.createElement('BUTTON');
        btnClose.className = 'py-2 px-5 text-sm font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700';
        btnClose.textContent = 'Cerrar';
        btnClose.onclick = () => {
            document.querySelector('.default-modal').classList.add('opacity-0');
            setTimeout(() => document.querySelector('.default-modal')?.remove(), 300);
        };
        divBtns.appendChild(btnClose);
        divBtns.appendChild(btn);

        Modal.styledModal(contenido, divBtns);
    }

    static simpleRenderModal(content) {
        const divBtns = document.createElement('DIV')
        divBtns.className = 'flex justify-center';
        const btnClose = document.createElement('BUTTON');
        btnClose.className = 'text-indigo-700 hover:text-white border border-indigo-700 hover:bg-indigo-800 focus:outline-none font-medium rounded text-sm uppercase px-5 py-2.5 text-center me-2 mb-2 dark:border-indigo-500 dark:text-indigo-500 dark:hover:text-white dark:hover:bg-indigo-500';
        btnClose.textContent = 'Cerrar';
        btnClose.onclick = () =>  {
            document.querySelector('.default-modal').classList.add('opacity-0');
            setTimeout(() => document.querySelector('.default-modal')?.remove(), 300);
        };
        divBtns.appendChild(btnClose);

        Modal.styledModal(content, divBtns);
    }
}