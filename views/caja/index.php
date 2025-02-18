<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Consultar Usuario
            </h2>

            <form class="w-full mx-auto mt-5" id="formulario-busqueda" autocomplete="off">
                <div id="error"></div>
                <label for="busqueda" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="busqueda" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" placeholder="Id o Nombre del usuario" />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 font-medium rounded text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700">Buscar</button>
                </div>
            </form>
            <div id="listado-coincidencias" class="my-2">
                <ul class="space-y-2"></ul>
            </div>
        </div>
    </article>

    <?php include_once __DIR__ . '../deuda/index.php'; ?>
</section>

<?php $scripts = [
    'caja-cobro/busqueda.js',
    'caja-cobro/deuda.js'
]; ?>