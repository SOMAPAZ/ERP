<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<main class="container mx-auto px-10 mt-10">

    <h1 class="text-center font-black text-4xl mb-5 uppercase dark:text-dark-font">Información de usuarios</h1>
    <section class="relative overflow-x-auto mx-auto mt-10 mb-10 bg-background-light rounded-md shadow-md py-4 px-10 text-left font-extrabold uppercase dark:bg-dark-bg-container">

        <form action="/facturas/filtrar-facturas-pendientes" method="post" class="mb-5 dark:text-dark-font">
            <label for="filtrado" class="block w-full uppercase mb-3 font-bold">Busqueda con id o nombre:</label>
            <div class="relative">
                <input type="text" name="filtrado" id="filtrado" class="block w-full p-2.5 text-sm font-normal mb-3 border-2 border-primary-base rounded-md dark:bg-dark-bg-container dark:border-dark-bg" placeholder="Direccion, Trámite, Nombre, ID" />
            </div>
        </form>
        <table class="w-full mx-auto divide-y-2 divide-gray-200 text-sm dark:divide-gray-700" id="listado-usuarios">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row justify-between gap-2 items-center cursor-pointer" id="id-table">
                            Id
                            <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                        </div>
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row justify-between gap-2 items-center cursor-pointer" id="nombre-table">
                            Nombre
                            <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                        </div>
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row justify-between gap-2 items-center cursor-pointer" id="direcc-table">
                            Dirección
                            <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                        </div>
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row justify-between gap-2 items-center cursor-pointer" id="zona-table">
                            Zona
                            <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                        </div>
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row justify-between gap-2 items-center cursor-pointer" id="tel-table">
                            Teléfono
                            <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                        </div>
                    </th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 dark:text-white" scope="col">
                        <div class="flex flex-row gap-2 items-center">
                            Acceder
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="font-semibold text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <tr class="animate-bounce">
                    <td colspan="7" class="text-center py-10 text-gray-500 dark:text-gray-400 text-lg">Cargando datos de usuarios...</td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-center items-center mt-5 text-xs">
            <button id="btn-anterior" class="flex items-center justify-center px-3 h-8  font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                Anterior
            </button>
            <span id="info-pagina" class=" font-medium px-3 text-gray-500 dark:text-gray-400 uppercase"></span>
            <button id="btn-siguiente" class="flex items-center justify-center px-3 h-8  font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Siguiente
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
        </div>
    </section>
</main>


<?php $scripts = [
    'app.js',
    'usuarios/users.js'
]; ?>