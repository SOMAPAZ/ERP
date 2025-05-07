<?php $cdn = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />'; ?>
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
            <div class="space-y-2 sm:space-y-0 flex flex-col sm:flex-row gap-2">
                <a href="/pdf/contrato-servicio?id=<?= s($_GET['id']) ?>" target="_blank" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                    </svg>
                    Contrato
                </a>
                <a href="/datos-usuarios-editar?id=<?= s($_GET['id']) ?>" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                    </svg>
                    Editar
                </a>
            </div>
            <div class=" flex flex-col lg:flex-row gap-4 md:gap-8 p-4 bg-white dark:bg-gray-800 rounded shadow-lg">
                <div class="w-full lg:max-w-1/2 p-4">
                    <?php if ($usuario->image) : ?>
                        <picture>
                            <img src="image_house_user/<?= $usuario->image ?>" loading="lazy" alt="Foto de casa de <?= $usuario->user . " " . $usuario->lastname ?>" class=" w-full max-h-96 object-cover rounded">
                        </picture>
                    <?php else : ?>
                        <picture>
                            <source srcset="build/img/abac7125a1a4888453a6524df523454b.avif" type="image/avif">
                            <source srcset="build/img/abac7125a1a4888453a6524df523454b.webp" type="image/webp">
                            <img src="build/img/abac7125a1a4888453a6524df523454b.png" loading="lazy" alt="Imagen con textto de no encontrada" class=" w-full max-h-96 object-cover rounded">
                        </picture>
                    <?php endif; ?>
                </div>
                <div class="w-full lg:max-w-1/2 flex flex-col justify-center p-4">
                    <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400 py-4">Datos de Usuario</h4>
                    <ul class="space-y-2 text-left uppercase text-gray-600 dark:text-gray-400">
                        <li><strong class="text-gray-900 dark:text-white me-2">Teléfono:</strong><?= !$usuario->phone || $usuario->phone === 0 ? 'Sin teléfono.' : $usuario->phone ?></li>
                        <li><strong class="text-gray-900 dark:text-white me-2">Direccion:</strong><?= $usuario->address ?> <?= $usuario->int_num ? $usuario->int_num : '' ?></li>
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
            <div class="flex flex-col gap-4 p-4 bg-white rounded shadow-lg dark:bg-gray-800">
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400 ">Ubicación en mapa</h4>
                <?php if ($usuario->lat && $usuario->lng) : ?>
                    <input type="hidden" name="lat" id="lat" value="<?= $usuario->lat ?>">
                    <input type="hidden" name="lng" id="lng" value="<?= $usuario->lng ?>">
                    <div id="mapa" class="h-96 border border-dashed border-gray-400 rounded-lg"></div>
                <?php else: ?>
                    <div class="h-96 flex flex-col items-center justify-center border border-dashed border-gray-400 bg-gray-200 rounded-lg dark:bg-gray-700">
                        <p class="font-bold text-xs uppercase text-gray-600 dark:text-gray-300">No hay coordenadas para el usuario.</p>
                    </div>
                <?php endif; ?>
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
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay beneficiarios registrados. <a href="/crear-beneficiario?id_user=<?= $usuario->id ?>" class="text-indigo-600">Tal Vez quieras agregar uno</a></p>
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
                <h4 class="font-bold text-2xl uppercase text-indigo-600 dark:text-indigo-400">Convenios</h4>
                <?php if ($convenios): ?>
                    <table class="w-full">
                        <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Folio</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Beneficiario</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">Fecha</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($convenios as $convenio): ?>
                                <tr class=" whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white text-sm uppercase">
                                    <td class="py-2 px-2 font-bold"><?= $convenio->folio ?></td>
                                    <td class="py-2 px-2"><?= isset($convenio->beneficiario) ? $convenio->beneficiario->name : 'Sin beneficiario.' ?></td>
                                    <td class="py-2 px-2"><?= $convenio->fecha_registrada ?></td>
                                    <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                        <a href="#" class="flex flex-row pe-2 text-indigo-600 hover:text-orange-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Acceder &raquo;</a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center p-2 font-semibold text-gray-700 dark:text-gray-300">No hay convenios para este usuario.</p>
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
        <div class="flex justify-end items-center mt-10">
            <form action="/datos-usuarios-eliminar" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                <button type="submit" class="flex flex-row gap-1 py-2 px-2 text-white bg-red-600 hover:bg-red-800 font-semibold text-xs uppercase items-center rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path d="M10.375 2.25a4.125 4.125 0 1 0 0 8.25 4.125 4.125 0 0 0 0-8.25ZM10.375 12a7.125 7.125 0 0 0-7.124 7.247.75.75 0 0 0 .363.63 13.067 13.067 0 0 0 6.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 0 0 .364-.63l.001-.12v-.002A7.125 7.125 0 0 0 10.375 12ZM16 9.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6Z" />
                    </svg>
                    Cancelar Usuario
                </button>
            </form>
        </div>
    </article>


</section>


<?php $src = '<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet@3.0.8/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-geosearch/2.7.0/bundle.min.js"></script>';
$scripts = ['usuarios/mapa.js'];
?>