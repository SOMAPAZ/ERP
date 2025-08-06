<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>


<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="flex flex-col gap-4 sm:flex-row sm:gap-0 lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Filtrar Reporte
            </h2>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-xs font-bold rounded p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase cursor-pointer" name="select-input" id="select-input">
                <option value="" disabled selected class="font-semibold">-- Buscar en base a --</option>
                <option value="1" class="font-semibold p-2">Nombre o dirección</option>
                <option value="2" class="font-semibold p-2">Folio</option>
                <option value="3" class="font-semibold p-2">Categoría e Incidencia</option>
            </select>
        </div>

        <form class="bg-white dark:bg-gray-800 mt-6 p-5 shadow rounded" id="filtrado-reporte" autocomplete="off">
            <div id="div-notif"></div>
            <div>
                <div id="contenedor-texto">
                    <label for="data" class="block mb-2 uppercase font-medium text-gray-900 dark:text-white">Nombre, Dirección ó Teléfono</label>
                    <input type="text" id="data" name="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ej: Margarita Rodriguez Martinez, Camino ocotitan s/n, 123456789, 233-123-45-67" />
                </div>
                <div class="hidden" id="contenedor-folio">
                    <label for="foliate" class="block mb-2 uppercase font-medium text-gray-900 dark:text-white">Folio del reporte</label>
                    <input type="text" id="foliate" name="foliate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ej: 2503-0001" />
                </div>
                <div class="grid sm:grid-cols-2 gap-4 hidden" id="contenedor-categoria">
                    <div>
                        <label for="data-category" class="block mb-2 uppercase font-medium text-gray-900 dark:text-white">Categoría</label>
                        <select id="data-category" name="data-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report">
                            <option value="">-- Selecciones una categoría --</option>
                        </select>
                    </div>
                    <div>
                        <label for="data-incidence" class="block mb-2 uppercase font-medium text-gray-900 dark:text-white">Incidencia</label>
                        <select id="data-incidence" name="data-incidence" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" disabled>
                            <option value="">-- Selecciones una incidencia --</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Buscar reportes" class=" mt-2 w-full text-center font-bold bg-indigo-600 hover:bg-indigo-700 text-white uppercase p-2 rounded cursor-pointer disabled:opacity-10 disabled:cursor-not-allowed" />
        </form>

        <div id="resultados" class="mt-10">

        </div>

    </article>

</section>

<?php $scripts = ['reportes/filtrar-reportes_v1.js']; ?>