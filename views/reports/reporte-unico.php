<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center">
                Reporte: <span class="font-normal"><?= $reporte->id ?></span>
            </h2>
        </div>

        <div class="my-5">
            <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse justify-between" id="ol-status">
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse" id="status-1">
                    <button class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full dark:bg-blue-800 shrink-0" data-status="1">1</button>
                    <h3 class="font-medium leading-tight">Abierto</h3>
                </li>
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse" id="status-2">
                    <button class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400 group" data-status="2">2</button>
                    <h3 class="font-medium leading-tight">En proceso</h3>
                </li>
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse" id="status-3">
                    <button class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400" data-status="3">3</button>
                    <h3 class="font-medium leading-tight">Cerrado</h3>
                </li>
                <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse" id="status-4">
                    <button class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400" data-status="4">4</button>
                    <h3 class="font-medium leading-tight">Terminado</h3>
                </li>
            </ol>
        </div>



        <div class="py-2 lg:py-4">
            <h2 class="mb-4 text-lg font-normal leading-none text-gray-900 md:text-2xl dark:text-white">
                <span class="font-extrabold">Usuario:</span> <span class="uppercase"><?= $reporte->name ?></span>
            </h2>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Descripción:</dt>
                <dd class="mb-4 font-light text-gray-500 dark:text-gray-400"><?= $reporte->description ?></dd>
            </dl>
            <dl class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 items-center">
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">ID User:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                        <?= $reporte->id_user ? $reporte->id_user : "Sin ID" ?>
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Beneficiario:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                        <?= $reporte->phone ? $reporte->phone : "Sin Teléfono" ?>
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Beneficiario:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                        <?= $reporte->beneficiary ? $reporte->beneficiary : "Sin beneficiario" ?>
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Dirección:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"><?= $reporte->address ?></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Categoría:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"><?= $categoria->name ?></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Incidencia:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"><?= $incidencia->name ?></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Prioridad:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"><?= $prioridad->name ?></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Realizado:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                        <?= is_null($realizado) ? "No registrado" : $realizado->name . " " . $realizado->lastname ?>
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Emisión:</dt>
                    <dd class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"><?= $reporte->created ?></dd>
                </div>
            </dl>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                <a href="/editar-reporte?folio=<?= $reporte->id ?>" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-edit-report">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 me-2 dark:text-white">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Editar</span>
                </a>
                <button type="button" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-note">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Nota</span>
                </button>
                <button type="button" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-material">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Material</span>
                </button>
                <button type="button" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 disabled:opacity-10" id="btn-bag-img">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" /></svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Imagenes PDF</span>
                </button>
                <a href="/reporte/pdf?folio=<?= $reporte->id ?>" target="_blank" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-descargar-PDF">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">PDF</span>
                </a>
                <button type="button" class="flex items-center rounded-lg border border-red-200 bg-white px-4 py-2 hover:bg-red-200 dark:border-red-700 dark:bg-red-800 dark:hover:bg-red-700" id="btn-remove-reporte">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 text-red-500 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-sm font-medium text-red-900 dark:text-white">Eliminar</span>
                </button>
            </div>
        </div>

        <div class="space-y-4 divide-y divide-gray-200 mt-10">
            <div id="render-notas" class="text-gray-800 dark:text-gray-200 font-semibold text-lg gap-4 divide-y divide-gray-300 dark:divide-gray-600"></div>
            <div id="render-materiales" class="text-gray-800 dark:text-gray-200 font-semibold text-lg gap-4 divide-y divide-gray-300 dark:divide-gray-600"></div>
        </div>
    </div>
</section>

<?php $scripts = ['reportes/reporte_v1.js', 'reportes/notas_v1-1-1.js', 'reportes/materiales_v1.js', 'reportes/status_v1.js']; ?>