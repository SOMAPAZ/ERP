<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Información de:
            </h2>
            <h3 class="font-bold text-2xl text-center uppercase text-indigo-600 dark:text-indigo-400 mb-10">
                ID: <span class="text-gray-800 dark:text-white"><?= $usuario->id ?> |</span> Nombre: <span class=" text-gray-800 dark:text-white"><?= $usuario->user . " " . $usuario->lastname ?></span>
            </h3>
        </div>

        <section class=" space-y-10">
            <div class=" flex flex-col lg:flex-row gap-4 md:gap-8 p-4 bg-white dark:bg-gray-800 rounded shadow-lg">
                <div class="w-full lg:max-w-1/2 p-4">
                    <img src="https://www.mexicoenfotos.com/MX12785339664635.jpg" alt="Foto de casa de <?= $usuario->user . " " . $usuario->lastname ?>" class=" w-full max-h-96 object-cover rounded">
                </div>
                <div class="w-full lg:max-w-1/2 flex flex-col justify-center p-4">
                    <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400 py-4">Datos de Usuario</h4>
                    <ul class="space-y-2 text-left uppercase text-gray-600 dark:text-gray-400">
                        <li><strong class="text-gray-900 dark:text-white me-2">Teléfono:</strong><?= !$usuario->phone || $usuario->phone === 0 ? 'Sin teléfono.' : $usuario->phone ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Direccion:</strong><?= $usuario->address ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Colonia:</strong><?= $usuario->colonia->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Zona:</strong><?= $usuario->zona->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Referencia:</strong><?= $usuario->reference ? $usuario->reference : 'Sin referencia.' ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">RFC:</strong><?= $usuario->rfc ? $usuario->rfc : 'Sin RFC.' ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Clave elector:</strong><?= $usuario->clave_elector ? $usuario->clave_elector : 'Sin clave.' ?></li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="flex flex-col gap-4 p-4 bg-white dark:bg-gray-800 rounded shadow-lg">
                    <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400 ">Datos de Toma</h4>
                    <ul class="space-y-2 text-left uppercase text-gray-600 dark:text-gray-400 text-sm">
                        <li><strong class="text-gray-900 dark:text-white me-2">Tipo usuario:</strong><?= $usuario->tipo_usuario->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Estado servicio:</strong><?= $usuario->estado_servicio->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Tipo servicio:</strong><?= $usuario->tipo_servicio->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Tipo toma:</strong><?= $usuario->tipo_toma->name . " - " . $usuario->tipo_consumo->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Drenaje:</strong><?= $usuario->drain === '1' ? 'Con Drenaje' : 'Sin Drenaje' ?></li>
                    </ul>
                </div>
                <div class="flex flex-col gap-4 p-4 bg-white dark:bg-gray-800 rounded shadow-lg">
                    <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400 ">Datos de Almacenamiento</h4>
                    <ul class="space-y-2 text-left uppercase text-gray-600 dark:text-gray-400 text-sm">
                        <li><strong class="text-gray-900 dark:text-white me-2">Tipo de almacenamiento:</strong><?= $usuario->tipo_almacenamiento->name ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Capacidad almacenamiento:</strong><?= $usuario->storage_height ? $usuario->storage_height : 'Sin capacidad registrada.' ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Cantidad Habitantes:</strong><?= $usuario->inhabitants ? $usuario->inhabitants : 'Sin cantidad registrada.' ?></li>
                    </ul>
                </div>
            </div>
            <div class="w-full overflow-auto flex flex-col gap-4">
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400">Beneficiarios</h4>
                <?php if ($beneficiarios): ?>
                    <table class="w-full">
                        <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Nombre</th>
                                <th class=" whitespace-nowrap px-4 py-2 font-medium" scope="col">Teléfono</th>
                                <th class=" whitespace-nowrap px-4 py-2 font-medium" scope="col">Correo</th>
                                <th class=" whitespace-nowrap px-4 py-2 font-medium" scope="col">Tipo</th>
                                <th class=" whitespace-nowrap px-4 py-2 font-medium" scope="col">Clave Elector</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beneficiarios as $beneficiario): ?>
                                <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                    <td class="py-2 px-2 font-bold"><?= $beneficiario->name . " " . $beneficiario->lastname ?></td>
                                    <td class="py-2 px-2"><?= $beneficiario->phone ?></td>
                                    <td class="py-2 px-2"><?= $beneficiario->email ?></td>
                                    <td class="py-2 px-2"><?= $beneficiario->relationship ?></td>
                                    <td class="py-2 px-2"><?= $beneficiario->clave_elector ?></td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay beneficiarios registrados.</p>
                <?php endif; ?>
            </div>
            <div class="w-full overflow-auto flex flex-col gap-4">
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400">Reportes</h4>
                <?php if ($reportes): ?>
                    <table class="w-full">
                        <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Folio</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Categoria</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Incidencia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportes as $reporte): ?>
                                <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                    <td class="py-2 px-2 font-bold"><?= $reporte->id ?></td>
                                    <td class="py-2 px-2"><?= $reporte->categoria->name ?></td>
                                    <td class="py-2 px-2"><?= $reporte->incidencia->name ?></td>
                                    <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                        <a href=" /reporte?folio=<?= $reporte->id ?>" class="flex flex-row pe-2 text-indigo-600 hover:text-orange-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Acceder &raquo;</a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay reportes para este usuario.</p>
                <?php endif; ?>
            </div>
            <div class="w-full overflow-auto flex flex-col gap-4">
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400">Notificaciones</h4>
                <?php if ($notificaciones): ?>
                    <table class="w-full">
                        <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Folio</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Tipo</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Fecha de reporte</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notificaciones as $notificacion): ?>
                                <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                    <td class="py-2 px-2 font-bold"><?= $notificacion->idx ?></td>
                                    <td class="py-2 px-2"><?= $notificacion->tipo->name ?></td>
                                    <td class="py-2 px-2"><?= $notificacion->fecha_reporte ?></td>
                                    <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                        <a href="#" class="flex flex-row pe-2 text-indigo-600 hover:text-orange-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Acceder &raquo;</a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay notificaciones para este usuario.</p>
                <?php endif; ?>
            </div>
            <div class="w-full overflow-auto flex flex-col gap-4">
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400">Recibos</h4>
                <?php if ($recibos_anterior || $recibos_actuales || $recibos_pagos_adicionales): ?>
                    <table class="w-full">
                        <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Folio</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Fecha pago</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Periodo Abonado</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Pago</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recibos_actuales) :
                                foreach ($recibos_actuales as $recibo): ?>
                                    <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                        <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                        <td class="py-2 px-2"><?= formatearFechaESLong($recibo->fecha) ?></td>
                                        <td class="py-2 px-2"><?= $recibo->mes_inicio ? formatearFechaES($recibo->mes_inicio) . " - " . formatearFechaES($recibo->mes_fin) : '' ?></td>
                                        <td class="py-2 px-2"><?= formatoMiles($recibo->total) ?></td>
                                        <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                            <a href="/pdf/recibo?id=<?= $usuario->id ?>&folio=<?= $recibo->folio ?>" class="flex flex-row pe-2 text-indigo-600 hover:text-orange-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Acceder &raquo;</a>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif;  ?>
                            <?php if ($recibos_pagos_adicionales) :
                                foreach ($recibos_pagos_adicionales as $recibo): ?>
                                    <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                        <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                        <td class="py-2 px-2"><?= formatearFechaESLong($recibo->fecha) ?></td>
                                        <td class="py-2 px-2"></td>
                                        <td class="py-2 px-2"><?= formatoMiles($recibo->total) ?></td>
                                        <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                            <a href="/pdf/recibo-adicionales?folio=<?= $recibo->folio ?>&id=<?= $usuario->id ?>" class="flex flex-row pe-2 text-indigo-600 hover:text-orange-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Acceder &raquo;</a>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif;  ?>
                            <?php if ($recibos_anterior) :
                                foreach ($recibos_anterior as $recibo): ?>
                                    <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                        <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                        <td class="py-2 px-2"><?= formatearFechaESLong($recibo->date_invoice) ?></td>
                                        <td class="py-2 px-2"><?= $recibo->date_initial ? formatearFechaES($recibo->date_initial) . " - " . formatearFechaES($recibo->date_final) : '' ?></td>
                                        <td class="py-2 px-2">$ <?= formatoMiles($recibo->amount) ?></td>
                                        <td></td>
                                    </tr>
                            <?php endforeach;
                            endif;  ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay recibos para este usuario.</p>
                <?php endif; ?>
            </div>
        </section>

        <div class="mt-10 overflow-x-auto">

        </div>
    </article>

</section>