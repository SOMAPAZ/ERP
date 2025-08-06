<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="container mx-auto px-2 lg:px-5 mt-10">
    <article class="mx-auto max-w-screen-xl  px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Servicio Medido
            </h2>
        </div>
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white text-left border-b border-gray-300 dark:border-gray-700 pb-2">
                Crear o Editar Lecturas
            </h2>
        </div>
        <div class="relative  w-full flex flex-col gap-4">
            <!-- Formulario de búsqueda -->
            <div class="flex gap-2">
                <div class="w-full flex gap-2">
                    <select id="modoBusqueda" name="modoBusqueda"
                        class="border border-slate-300 dark:border-gray-700 rounded-md px-2 py-2 text-sm bg-white dark:bg-gray-800 text-slate-700 dark:text-white">
                        <option value="crear">Crear</option>
                        <option value="editar">Editar</option>
                    </select>

                    <input type="text" id="busqueda" name="busqueda"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 dark:text-white text-sm border border-slate-200 dark:border-gray-700 rounded-md px-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 dark:focus:border-gray-600 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Buscar por ID o usuario para registrar lectura" />


                    <button type="submit" class="hidden">Buscar</button>
                </div>
            </div>
            <!-- Resultados de búsqueda -->
            <div id="listado-coincidencias" class="mt-2 max-h-[400px] overflow-y-auto"></div>
            <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
            <div class="w-full flex justify-end">
                <button class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="agregar-deudorlec">Mostrar Agregados</button>
            </div>
            <form action="/lecturas" method="POST" class="w-full max-w-4xl mx-auto">
                <input type="hidden" name="filtros_lecturas" id="filtrosInput">
                <div class="gap-4 px-5 text-xs">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Filtrar por:</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs w-full max-w-4xl">
                    <button id="dropdownSearchButtonZona" data-dropdown-toggle="dropdownSearchZona" class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">
                        - Zona -
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownSearchZona" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonZona"></ul>
                        <a href="#" class="dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 hover:underline">Confirmar</a>
                    </div>
                    <button id="dropdownSearchButtonColonia" data-dropdown-toggle="dropdownSearchColonia" class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">
                        - Colonia -
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownSearchColonia" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonColonia"></ul>
                        <a href="#" class="dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 hover:underline">Confirmar</a>
                    </div>
                    <div>
                        <button id="reiniciar" type="submit" name="reiniciar" value="true" class="w-full dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-gray-600 hover:bg-gray-700 rounded-lg hover:underline">🔄 Reiniciar</button>
                    </div>
                    <div class="w-full flex flex-col items-center px-4 py-2 text-sm font-medium text-center text-white bg-white rounded-lg dark:bg-gray-800 justify-center">
                        <p class="text-gray-700 dark:text-white font-semibold text-xs">Resultado: </p>
                        <p class="text-blue-600 dark:text-white text-lg font-semibold mt-2"><?= $totalFiltrado ?></p>
                    </div>
                </div>
            </form>
        </div>
        <div class="relative overflow-x-auto mx-auto mb-5 py-4 px-2 lg:px-5 text-left uppercase">
            <?= $paginacion ?>
            <div id="mensajeInfo" class=" text-sm bg-blue-600 border border-blue-400 text-white px-4 py-2 rounded relative mt-2 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M12 4v1m8 7h1m-1 0a9 9 0 11-9-9 9 9 0 019 9z" />
                </svg>
                Haz clic en "Agregar" para seleccionar usuarios
            </div>
            <?php if (empty($usuarios)) : ?>
                <div class="w-full text-center py-4 text-lg font-semibold text-gray-500">Sin resultados</div>
            <?php else : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-xs uppercase">
                        <tr class="whitespace-nowrap font-medium">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Direccion</th>
                            <th class="px-4 py-2">Zona</th>
                            <th class="px-4 py-2">Colonia</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-xs uppercase">
                                <td class="py-2 px-2 font-bold"><?= $usuario->id ?></td>
                                <td class="py-2 px-2"><?= strlen($usuario->nombre) >= 30 ? substr($usuario->nombre, 0, 30) . "..." : $usuario->nombre ?></td>
                                <td class="py-2 px-2"><?= strlen($usuario->direccion) >= 30 ? substr($usuario->direccion, 0, 30) . "..." : $usuario->direccion ?></td>
                                <td class="py-2 px-2"><?= $usuario->zona ?></td>
                                <td class="py-2 px-2"><?= $usuario->colonia ?></td>
                                <td class="flex justify-end items-center py-2 px-2">
                                    <button id="agregar-datoslec" class="flex flex-row flex-nowrap gap-2 items-center font-bold text-xs uppercase text-indigo-600 dark:text-indigo-200 hover:text-indigo-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                        </svg>
                                        Agregar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?= $paginacion ?>
        </div>
    </article>
</section>
<?php $scripts = ['notificacion/serv_med.js']; ?>