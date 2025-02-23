<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center">
                Reporte: <span class="font-normal"><?= $reporte->id ?></span>
            </h2>
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
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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

<?php $scripts = ['reportes/reporte.js', 'reportes/notas.js', 'reportes/materiales.js']; ?>