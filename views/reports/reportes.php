<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                <span id="titulo-estado">Reportes Abiertos</span>
                <span id="total-reportes"></span>
            </h2>
        </div>

        <div id="filtros-radio" class="flex justify-between flex-wrap w-full gap-4 border-y border-gray-200 dark:border-gray-700">
            <div class="flex items-center py-2">
                <input id="abiertos" type="radio" value="1" name="estado-reporte" class="w-4 h-4 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" checked>
                <label for="abiertos" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Abiertos</label>
            </div>
            <div class="flex items-center py-2">
                <input id="empezados" type="radio" value="2" name="estado-reporte" class="w-4 h-4 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                <label for="empezados" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">En Proceso</label>
            </div>
            <div class="flex items-center py-2">
                <input id="cerrados" type="radio" value="3" name="estado-reporte" class="w-4 h-4 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                <label for="cerrados" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Cerrado</label>
            </div>
            <div class="flex items-center py-2">
                <input id="terminados" type="radio" value="4" name="estado-reporte" class="w-4 h-4 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                <label for="terminados" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Terminado</label>
            </div>
        </div>

        <form id="filtros-select" class="grid grid-cols-1 md:grid-cols-3 mb-6 w-full gap-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center py-2 overflow-x-hidden">
                <select name="categoria" id="categoria-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full px-2.5 py-0.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white cursor-pointer focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>- Categoría -</option>
                </select>
            </div>
            <div class="flex items-center py-2 overflow-x-hidden">
                <select name="incidencia" id="incidencia-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full px-2.5 py-0.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white cursor-pointer focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>- Incidencia -</option>
                </select>
            </div>
            <div class="flex items-center py-2 overflow-x-hidden">
                <select name="prioridad" id="prioridad-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full px-2.5 py-0.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white cursor-pointer focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>- Prioridad -</option>
                </select>
            </div>
        </form>

        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-200 dark:divide-gray-800" id="listado-reportes">
            </div>
        </div>
    </div>
</section>

<?php $scripts = ['reportes/mostrar-reportes.js']; ?>