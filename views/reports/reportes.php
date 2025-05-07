<section class="py-4 antialiased md:py-8 h-auto">
    <div class="flex flex-col justify-center mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
            <?= $titulo ?>
        </h2>

        <?php include_once __DIR__ . '/../templates/fitro_reportes.php'; ?>

        <div class="w-full mt-5 relative overflow-x-auto mx-auto py-4 text-left uppercase">
            <?php if (count($reportes) > 0): ?>
                <p class="font-black text-lg uppercase mb-5 text-gray-700 dark:text-white">Total: <span class="font-normal"><?= count($reportes) ?> reportes</span></p>
                <table id="table-data" class="w-full lg:min-w-full">
                    <thead>
                        <tr class="text-xs uppercase bg-gray-200 text-gray-900 dark:text-white dark:bg-gray-700">
                            <th class="p-3">
                                <span class="flex items-center">
                                    Folio
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Prioridad
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Usuario
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Dirección
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Categoria
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Incidencia
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                                <span class="flex items-center">
                                    Emisión
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="p-3">
                            </th>
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
                                <td class="p-2 py-3"><?= $reporte->categoria->name ?></td>
                                <td class="p-2 py-3">
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
                                <td class="px-4 py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-600 cursor-pointer">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                </td>
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