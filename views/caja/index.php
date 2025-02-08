<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Consultar Usuario
            </h2>

            <div class="relative mt-2 w-full">
                <div class="absolute top-1 left-1 flex items-center">
                    <button id="dropdownButton" class="rounded border border-transparent py-1 px-1.5 text-center flex items-center text-sm transition-all dark:bg-gray-800 text-slate-600 dark:text-white">
                        <span id="dropdownSpan" class="text-ellipsis overflow-hidden">Serv. Agua</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="h-6 border-l border-slate-200 ml-1"></div>
                    <div id="dropdownMenu" class="min-w-[100px] overflow-hidden absolute left-0 w-full mt-10 hidden bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-md shadow-lg z-10">
                        <ul id="dropdownOptions">
                            <li class="px-4 py-2 text-slate-600 hover:bg-slate-50 text-sm dark:hover:bg-gray-700 dark:text-white cursor-pointer" data-value="Serv. Agua">Serv. Agua</li>
                            <li class="px-4 py-2 text-slate-600 hover:bg-slate-50 text-sm dark:hover:bg-gray-700 dark:text-white cursor-pointer" data-value="Serv. User">Serv. User</li>
                            <li class="px-4 py-2 text-slate-600 hover:bg-slate-50 text-sm dark:hover:bg-gray-700 dark:text-white cursor-pointer" data-value="Serv. No User">Serv. No User</li>
                        </ul>
                    </div>
                </div>
                <input
                    type="text"
                    id="busqueda"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 dark:text-white text-sm border border-slate-200 dark:border-gray-700 rounded-md px-36 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 dark:focus:border-gray-600 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="ID y Nombre del Usuario..." />

                <button class="absolute top-1 right-1 flex items-center rounded bg-slate-800 dark:bg-white dark:text-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 dark:focus:bg-slate-300 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 dark:hover:bg-slate-300 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button" id="consultar-montos">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-1.5">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                    </svg>
                    Buscar
                </button>
            </div>
            <div id="listado-coincidencias" class="mt-2"></div>
        </div>
    </article>

    <?php include_once __DIR__ . '../deuda/index.php'; ?>
</section>

<?php $scripts = ['caja-cobro/busqueda.js', 'caja-cobro/deuda.js']; ?>