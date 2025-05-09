<section class="py-4 antialiased md:py-8 h-auto">
    <div class="flex flex-col justify-center mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
            <?= $titulo ?>
        </h2>

        <?php include_once __DIR__ . '/../templates/fitro_reportes.php'; ?>

        <div class="w-full mt-5 overflow-x-auto mx-auto py-4 text-left uppercase">
            <?php if (count($reportes) > 0): ?>
                <p class="font-black text-lg uppercase mb-5 text-gray-700 dark:text-white">Total: <span class="font-normal" id="total-reportes"><?= count($reportes) ?> reportes</span></p>
                <table class="w-full lg:min-w-full" id="table-reportes">
                    <thead>
                        <tr class="text-xs uppercase bg-gray-200 text-gray-900 dark:text-white dark:bg-gray-700">
                            <th class="p-3">Folio</th>
                            <th class="p-3">Prioridad</th>
                            <th class="p-3">Usuario</th>
                            <th class="p-3">Dirección</th>
                            <th class="p-3">
                                <button
                                    id="dropdownCategoryButton"
                                    class="flex items-center cursor-pointer hover:text-indigo-700 dark:hover:text-indigo-200 uppercase">
                                    Categoria
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 ms-3">
                                        <path d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
                                    </svg>
                                </button>
                                <form id="dropdownCategory" class="absolute z-40 hidden bg-white rounded-lg shadow-lg w-60 dark:bg-gray-950">
                                    <ul class="h-48 px-3 py-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" id="category-items">
                                        <?php foreach ($categorias as $categoria): ?>
                                            <li>
                                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    <input type="checkbox" id="<?= $categoria->name ?>" value="<?= $categoria->id ?>" class="size-6 cursor-pointer text-indigo-600 bg-gray-100 border-gray-300 rounded-sm dark:bg-gray-600 dark:border-gray-500 input-checkbox">
                                                    <label for="<?= $categoria->name ?>" class="w-full ms-2 text-xs font-medium text-gray-900 rounded-sm dark:text-gray-300"><?= $categoria->name ?></label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="flex justify-center items-center p-3 text-sm font-medium text-indigo-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-indigo-200 gap-3">
                                        <button type="button"
                                            class="text-white bg-red-600 py-1 px-2 rounded hover:bg-red-700 text-xs uppercase"
                                            id="btnDropdownCategoryClose">
                                            Cerrar
                                        </button>
                                        <button type="button"
                                            class="text-white bg-green-600 py-1 px-2 rounded hover:bg-green-700 text-xs uppercase hidden"
                                            id="btnCategoryClear">
                                            Limpiar
                                        </button>
                                        <button
                                            class="text-white bg-indigo-600 py-1 px-2 rounded hover:bg-indigo-700 text-xs uppercase"
                                            id="btnCategorySearch">
                                            Buscar
                                        </button>
                                    </div>
                                </form>
                            </th>
                            <th class="p-3">
                                <button
                                    id="dropdownIncidenceButton"
                                    class="flex items-center cursor-pointer hover:text-indigo-700 dark:hover:text-indigo-200 uppercase">
                                    Incidencia
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4 ms-3">
                                        <path d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
                                    </svg>
                                </button>
                                <form id="dropdownIncidence" class="absolute z-40 hidden bg-white rounded-lg shadow-lg w-60 dark:bg-gray-950">
                                    <ul class="h-96 px-3 py-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" id="incidence-items">
                                        <?php foreach ($incidencias as $incidencia): ?>
                                            <li>
                                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    <input type="checkbox" id="<?= $incidencia->incidencia ?>" value="<?= $incidencia->id ?>" class="size-6 cursor-pointer text-indigo-600 bg-gray-100 border-gray-300 rounded-sm dark:bg-gray-600 dark:border-gray-500 input-checkbox">
                                                    <label for="<?= $incidencia->incidencia ?>" class="w-full ms-2 text-xs font-medium text-gray-900 rounded-sm dark:text-gray-300"><?= $incidencia->incidencia ?></label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="flex justify-center items-center p-3 text-sm font-medium text-indigo-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-indigo-200 gap-3">
                                        <button type="button"
                                            class="text-white bg-red-600 py-1 px-2 rounded hover:bg-red-700 text-xs uppercase"
                                            id="btnDropdownIncidenceClose">
                                            Cerrar
                                        </button>
                                        <button type="button"
                                            class="text-white bg-green-600 py-1 px-2 rounded hover:bg-green-700 text-xs uppercase hidden"
                                            id="btnIncidenceClear">
                                            Limpiar
                                        </button>
                                        <button
                                            class="text-white bg-indigo-600 py-1 px-2 rounded hover:bg-indigo-700 text-xs uppercase"
                                            id="btnIncidenceSearch">
                                            Buscar
                                        </button>
                                    </div>
                                </form>
                            </th>
                            <th class="p-3">Emisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportes as $reporte): ?>
                            <tr class="bg-white hover:bg-slate-50 dark:bg-gray-800 dark:hover:bg-gray-700 border-b border-slate-200 dark:border-gray-700 text-xs uppercase whitespace-nowrap text-gray-900 dark:text-white">
                                <td class="p-2 py-3 font-medium underline">
                                    <a href="/reporte?folio=<?= $reporte->id ?>">
                                        <?= $reporte->id ?>
                                    </a>
                                </td>
                                <td class="p-2 py-3">
                                    <?php if ($reporte->prioridad->id === "1") : ?>
                                        <p class="bg-green-200 text-green-800 font-bold p-1 text-center rounded">
                                        <?php elseif ($reporte->prioridad->id === "2") : ?>
                                        <p class="bg-yellow-200 text-yellow-700 font-bold p-1 text-center rounded">
                                        <?php elseif ($reporte->prioridad->id === "3") : ?>
                                        <p class="bg-red-200 text-red-800 font-bold p-1 text-center rounded">
                                        <?php else: ?>
                                        <p class="bg-purple-200 text-purple-800 font-bold p-1 text-center rounded">
                                        <?php endif; ?>
                                        <?= $reporte->prioridad->name ?>
                                        </p>
                                </td>
                                <td class="p-2 py-3"><?= strlen($reporte->name) >= 30 ? substr($reporte->name, 0, 30) . "..." : $reporte->name ?></td>
                                <td class="p-2 py-3"><?= strlen($reporte->address) >= 30 ? substr($reporte->address, 0, 30) . "..." : $reporte->address ?></td>
                                <td class="p-2 py-3 category-row" data-categoryId="<?= $reporte->categoria->id ?>"><?= $reporte->categoria->name ?></td>
                                <td class="p-2 py-3 incidence-row" data-incidenceId="<?= $reporte->incidencia->id ?>">
                                    <?php if ($reporte->incidencia->id === "10" || $reporte->incidencia->id === "20") : ?>
                                        <p class="bg-gray-200 text-gray-800 font-bold p-1 text-center rounded">
                                        <?php elseif ($reporte->incidencia->id === "5") : ?>
                                        <p class="bg-cyan-200 text-cyan-700 font-bold p-1 text-center rounded">
                                        <?php else: ?>
                                        <p>
                                        <?php endif; ?>
                                        <?= $reporte->incidencia->name ?>
                                        </p>
                                </td>
                                <td class="p-2 py-3"><?= formatearFechaESLong($reporte->created) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-xs font-bold text-gray-500 dark:text-gray-400 py-10">No hay reportes en <?= formatearFechaES($year . "-" . $mes . "-01") ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>