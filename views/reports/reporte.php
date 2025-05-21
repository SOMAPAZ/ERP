<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-10">
        <div>
            <h2 class="font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center">
                Reporte: <span class="font-normal"><?= $reporte->id ?></span>
            </h2>
        </div>

        <div class="my-5">
            <ol class="text-gray-600 dark:text-gray-400 items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse justify-between" id="ol-status">
                <li class="<?= ((int) $reporte->id_status) >= 1 ? 'text-indigo-600' : 'text-gray-600 dark:text-gray-400' ?> flex items-center space-x-2.5 rtl:space-x-reverse" id="status-1">
                    <button class="<?= (int) $reporte->id_status >= 1 ? "text-indigo-800 bg-indigo-200" : "text-gray-800 bg-gray-200" ?> flex items-center justify-center w-8 h-8 rounded-full shrink-0 font-bold" data-status="1">1</button>
                    <h3 class="font-medium leading-tight">Abierto</h3>
                </li>
                <li class="<?= (int) $reporte->id_status >= 2 ? 'text-indigo-600' : 'text-gray-600 dark:text-gray-400' ?> flex items-center space-x-2.5 rtl:space-x-reverse" id="status-2">
                    <button class="<?= (int) $reporte->id_status >= 2 ? "text-indigo-800 bg-indigo-200" : "text-gray-800 bg-gray-200" ?> flex items-center justify-center w-8 h-8 rounded-full shrink-0 font-bold" data-status="2">2</button>
                    <h3 class="font-medium leading-tight">En proceso</h3>
                </li>
                <li class="<?= (int) $reporte->id_status >= 3 ? 'text-indigo-600' : 'text-gray-600 dark:text-gray-400' ?> flex items-center space-x-2.5 rtl:space-x-reverse" id="status-3">
                    <button class="<?= (int) $reporte->id_status >= 3 ? "text-indigo-800 bg-indigo-200" : "text-gray-800 bg-gray-200" ?> flex items-center justify-center w-8 h-8 rounded-full shrink-0 font-bold" data-status="3">3</button>
                    <h3 class="font-medium leading-tight">Cerrado</h3>
                </li>
                <li class="<?= (int) $reporte->id_status >= 4 ? 'text-indigo-600' : 'text-gray-600 dark:text-gray-400' ?> flex items-center space-x-2.5 rtl:space-x-reverse" id="status-4">
                    <button class="<?= (int) $reporte->id_status >= 4 ? "text-indigo-800 bg-indigo-200" : "text-gray-800 bg-gray-200" ?> flex items-center justify-center w-8 h-8 rounded-full shrink-0 font-bold" data-status="4">4</button>
                    <h3 class="font-medium leading-tight">Terminado</h3>
                </li>
            </ol>
        </div>

        <div class="py-2 lg:py-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="mb-4 text-lg font-normal leading-none text-gray-700 md:text-2xl dark:text-white">
                    <span class="font-extrabold">Usuario:</span> <span class="uppercase"><?= $reporte->name ?></span>
                </h2>
                <ul class="font-bold text-gray-700 dark:text-white space-y-2">
                    <li>
                        ID User: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $reporte->id_user ? $reporte->id_user : "Sin ID" ?></span>
                    </li>
                    <li>
                        Teléfono: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $reporte->phone ? $reporte->phone : "Sin Teléfono" ?></span>
                    </li>
                    <li>
                        Dirección: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $reporte->address ?></span>
                    </li>
                    <li>
                        Beneficiario: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $reporte->beneficiary ? $reporte->beneficiary : "Sin beneficiario" ?></span>
                    </li>
                    <li>
                        Categoría: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $categoria->name ?></span>
                    </li>
                    <li>
                        Incidencia: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $incidencia->name ?></span>
                    </li>
                    <li>
                        Prioridad: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $prioridad->name ?></span>
                    </li>
                    <li>
                        Realizado: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= is_null($realizado) ? "No registrado" : $realizado->name . " " . $realizado->lastname ?></span>
                    </li>
                    <li>
                        Emisión: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= formatearFechaESLong($reporte->created) ?></span>
                    </li>
                    <li>
                        Descripción: <span class="font-normal text-gray-500 dark:text-gray-400">
                            <?= $reporte->description ?></span>
                    </li>
                    <li class="flex flex-col justify-center md:flex-row md:justify-end gap-2">
                        <button type="button" id="copy-report" class="flex items-center mt-2 font-semibold text-xs uppercase bg-amber-600 hover:bg-amber-700 px-4 py-2 text-white rounded shadow-lg justify-center">
                            <svg class="size-4 me-2 dark:text-white">
                                <use xlink:href="assets/sprite.svg#copy" />
                            </svg>
                            Copiar
                        </button>
                        <a href="/editar-reporte?folio=<?= $reporte->id ?>" class="flex items-center mt-2 font-semibold text-xs uppercase bg-indigo-600 hover:bg-indigo-700 px-4 py-2 text-white rounded shadow-lg justify-center">
                            <svg class="size-4 me-2 dark:text-white">
                                <use xlink:href="assets/sprite.svg#edit" />
                            </svg>
                            Editar
                        </a>
                        <button class="flex items-center font-semibold mt-2 text-xs uppercase bg-red-600 hover:bg-red-700 px-4 py-2 text-white rounded shadow-lg justify-center" id="delete-report">
                            <svg class="size-4 me-2 text-white">
                                <use xlink:href="assets/sprite.svg#delete-x" />
                            </svg>
                            Eliminar
                        </button>
                    </li>
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-lg">
                <h3 class="text-center text-lg font-bold text-gray-900 dark:text-white">Comentarios de Seguimiento</h3>
                <form method="POST" action="/crear-comentario" autocomplete="off">
                    <label for="comentario" class="block mb-2 text-sm font-medium text-gray-600 dark:text-white">Tu Comentario</label>
                    <textarea id="comentario" name="comentario" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border dark:bg-gray-700 dark:text-white <?= isset($_SESSION['alerta']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?>" placeholder="Escribe tu comentario aquí..."></textarea>
                    <?php if (isset($_SESSION['alerta'])): ?>
                        <p class="text-center text-xs font-bold text-white bg-red-600 rounded py-2 my-2"><?= $_SESSION['alerta'] ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="reporte_id" value="<?= $reporte->id ?>">
                    <input type="submit" class="w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2 px-4 rounded uppercase mt-2 cursor-pointer" value="Guardar Comentario">
                </form>
                <div class="text-sm text-gray-700 dark:text-gray-400 my-4 max-h-72 overflow-y-scroll">
                    <?php
                    if (count($comentarios)):
                        foreach ($comentarios as $comentario): ?>
                            <div class="border-b border-gray-200 dark:border-gray-700 text-sm py-2">
                                <p class="font-bold"><?= $comentario->empleado->name . " " . $comentario->empleado->lastname ?></p>
                                <p class="dark:text-white"><?= $comentario->comentario ?></p>
                                <p class="text-xs"><?= formatearFechaESLong($comentario->created_at) ?></p>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <p class="text-center text-xs font-bold text-gray-500 dark:text-gray-400 py-10">No hay comentarios aún</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-end gap-2">
            <?php if ($reporte->id_user): ?>
                <a href="/crear-nota_reporte?folio=<?= $reporte->id ?>" class="w-full md:w-auto flex items-center rounded border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-note">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Costo a usuario</span>
                </a>
            <?php endif; ?>
            <a href="/crear-nota_reporte?folio=<?= $reporte->id ?>" class="w-full md:w-auto flex items-center rounded border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-note">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Agregar Nota</span>
            </a>
            <a href="/crear-material_reporte?folio=<?= $reporte->id ?>" class="w-full md:w-auto flex items-center rounded border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-material">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 me-2 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Agregar Material</span>
            </a>
            <a href="/reporte/pdf?folio=<?= $reporte->id ?>" class="w-full md:w-auto flex items-center rounded border border-gray-200 bg-white px-4 py-2 hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" id="btn-add-material">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 me-2 dark:text-white">
                    <path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625Z" />
                    <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
                <span class="text-sm font-medium text-gray-900 dark:text-white">Generar PDF</span>
            </a>
        </div>

        <div class="space-y-4 divide-y divide-gray-200 mt-10">
            <?php if (count($notas)): ?>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <?php
                    $i = 0;
                    foreach ($notas as $nota):
                        $i++;
                    ?>
                        <div>
                            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg md:flex-row hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 shadow-lg">
                                <img
                                    class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                    src="images/<?= $nota->image ?>"
                                    alt="Imagen de nota folio <?= $nota->id_report ?>"
                                    data-imagen="<?= $nota->id ?>" />
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                        <?= $nota->empleado->name . ' ' . $nota->empleado->lastname ?>
                                    </h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        <?= $nota->note ?>
                                    </p>
                                    <p class="mb-3 font-semibold text-xs text-gray-700 dark:text-gray-400">
                                        <?= formatearFechaESLong($nota->created) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-sm font-bold text-gray-500 dark:text-gray-400 py-10">No hay notas aún, tal vez quieras <a href="/crear-nota_reporte?folio=<?= $reporte->id ?>" class="text-indigo-600 hover:underline">agregar una nota</a></p>
            <?php endif; ?>
            <div id="render-materiales" class="text-gray-800 dark:text-gray-200 font-semibold text-lg gap-4 divide-y divide-gray-300 dark:divide-gray-600"></div>
        </div>
        <div class="space-y-4 divide-y divide-gray-200 mt-10">
            <?php if (count($materiales)): ?>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <?php foreach ($materiales as $material): ?>
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg md:flex-row hover:bg-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 shadow-lg">
                            <ul class="font-bold text-gray-700 dark:text-white space-y-2 p-4">
                                <li class="flex gap-2">Material:<span class="font-normal"><?= $material->material ?></span></li>
                                <li class="flex gap-2">Unidad:<span class="font-normal"><?= $material->unity->name ?></span></li>
                                <li class="flex gap-2">Cantidad:<span class="font-normal"><?= $material->quantity ?></span></li>
                                <li class="flex gap-2">Agregado:<span class="font-normal"><?= $material->empleado->name . ' ' . $material->empleado->lastname ?></span></li>
                                <li class="flex gap-2">Fecha:<span class="font-normal"><?= formatearFechaESLong($material->created) ?></span></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-sm font-bold text-gray-500 dark:text-gray-400 py-10">No hay materiales aún, tal vez quieras <a href="/crear-material_reporte?folio=<?= $reporte->id ?>" class="text-indigo-600 hover:underline">agregar un material</a></p>
            <?php endif; ?>
            <div id="render-materiales" class="text-gray-800 dark:text-gray-200 font-semibold text-lg gap-4 divide-y divide-gray-300 dark:divide-gray-600"></div>
        </div>
    </div>
</section>