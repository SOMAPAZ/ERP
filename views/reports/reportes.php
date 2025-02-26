<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                <span id="titulo-estado"></span>
                <span id="total-reportes"></span>
            </h2>
        </div>

        <div id="filtros-radio" class="flex justify-between flex-wrap w-full gap-4 border-y border-gray-200 dark:border-gray-700">
            <div class="flex items-center py-2">
                <a id="abiertos" href="/reportes?s=1" class="ms-2 text-sm font-black text-gray-900 dark:text-gray-300 cursor-pointer uppercase hover:text-indigo-800 hover:underline">Abiertos</a>
            </div>
            <div class="flex items-center py-2">
                <a id="empezados" href="/reportes?s=2" class="ms-2 text-sm font-black text-gray-900 dark:text-gray-300 cursor-pointer uppercase hover:text-indigo-800 hover:underline">En Proceso</a>
            </div>
            <div class="flex items-center py-2">
                <a id="cerrados" href="/reportes?s=3" class="ms-2 text-sm font-black text-gray-900 dark:text-gray-300 cursor-pointer uppercase hover:text-indigo-800 hover:underline">Cerrado</a>
            </div>
            <div class="flex items-center py-2">
                <a id="terminados" href="/reportes?s=4" class="ms-2 text-sm font-black text-gray-900 dark:text-gray-300 cursor-pointer uppercase hover:text-indigo-800 hover:underline">Terminado</a>
            </div>
        </div>

        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-200 dark:divide-gray-800" id="listado-reportes">
            </div>
            <div class="border-t mt-5 p-4 shadow-md flex justify-between items-center uppercase font-bold dark:text-white gap-2">
                <button type="button" id="btn-anterior" class="flex flex-row justify-between gap-2 px-4 py-2 font-bold uppercase border border-gray-200 dark:border-gray-700 rounded shadow text-indigo-800 hover:bg-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-600 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span class="hidden lg:block">Anterior</span>
                </button>
                <p class="hidden md:block text-gray-600 dark:text-gray-600 text-sm">
                    Mostrando 
                    <span class="text-gray-900 dark:text-gray-300 text-xl" id="inicio-mostrado"></span> 
                        a
                    <span class="text-gray-900 dark:text-gray-300 text-xl" id="fin-mostrado"></span> 
                        de
                    <span id="total-rep" class="text-gray-900 dark:text-gray-300 text-xl"></span> 
                    Reportes
                </p>
                <p class="md:hidden text-gray-600 dark:text-gray-600 text-xs">
                <span class="text-gray-900 dark:text-gray-300 text-xs" id="inicio-mostrado-sm"></span> 
                        a
                    <span class="text-gray-900 dark:text-gray-300 text-xs" id="fin-mostrado-sm"></span> 
                        de
                    <span id="total-rep-sm" class="text-gray-900 dark:text-gray-300 text-xs"></span> 
                </p>
                <button type="button" id="btn-siguiente" class="flex flex-row justify-between gap-2 px-4 py-2 font-bold uppercase border border-gray-200 dark:border-gray-700 rounded shadow text-indigo-800 hover:bg-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-600"><span class="hidden lg:block">Siguiente</span> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<?php $scripts = ['reportes/mostrar-reportes.js']; ?>