<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="container mx-auto px-2 lg:px-5 mt-10">

    <article class="mx-auto max-w-screen-xl  px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Facturacion Pendiente
            </h2>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <div class="w-full flex justify-end">
            <button class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="agregar-deudor">Mostrar Agregados</button>
        </div>
        <form action="/notificaciones" method="POST">
            <div class="gap-4 mt-10 px-5 text-xs">
                <h1 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Filtrar por:</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-10 px-5 text-xs">
                <input type="hidden" name="filtros" id="filtrosInput">
                <button id="dropdownSearchButtonZona" data-dropdown-toggle="dropdownSearchZona" class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">- Zona -
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownSearchZona" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonZona"></ul>
                    <a href="#" class="dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 hover:underline">Confirmar</a>
                </div>
                <button id="dropdownSearchButtonColonia" data-dropdown-toggle="dropdownSearchColonia" class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">- Colonia -
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownSearchColonia" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonColonia"></ul>
                    <a href="#" class="dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 hover:underline">Confirmar</a>
                </div>
                <button id="dropdownSearchButtonTipoToma" data-dropdown-toggle="dropdownSearchTipoToma" class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">- Tipo Toma -
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownSearchTipoToma" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonTipoToma"></ul>
                    <a href="#" class="dropdown-confirmar flex justify-center items-center p-3 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 hover:underline">Confirmar</a>
                </div>
                <button id="dropdownSearchButtonTipoConsumo" data-dropdown-toggle="dropdownSearchTipoConsumo"
                    class="w-full inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 justify-center" type="button">- Tipo Consumo -
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="dropdownSearchTipoConsumo" class="z-10 hidden bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700">
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButtonTipoConsumo"></ul>
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
                <?php
                $ordenActual = $_GET['orden'] ?? 'asc';
                $nuevoOrden = $ordenActual === 'asc' ? 'desc' : 'asc';
                $queryString = $_GET;
                $queryString['orden'] = $nuevoOrden;
                $queryString['columna'] = 'monto';
                $urlOrden = '?' . http_build_query($queryString);
                ?>
                <table class="w-full" id="tablaUsuarios">
                    <thead class="text-left bg-indigo-600 text-white text-xs uppercase">
                        <tr class="whitespace-nowrap font-medium">
                            <th class="px-4 py-2">Acciones</th>

                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Direccion</th>
                            <th class="px-4 py-2">Zona</th>
                            <th class="px-4 py-2">Colonia</th>
                            <th class="px-4 py-2">T. Toma</th>
                            <th class="px-4 py-2">T. Consumo</th>
                            <th class="px-4 py-2">Meses Rez</th>
                            <th class="px-4 py-2">Obser</th>
                            <th class="px-4 py-2">
                                <a href="?columna=monto&orden=<?= $ordenActual === 'asc' ? 'desc' : 'asc' ?>" class="hover:underline">
                                    Monto <?= $ordenActual === 'asc' ? '↑' : '↓' ?>
                                </a>
                            </th>
                            <th class="px-4 py-2">
                                <a href="?columna=ultimo_pago&orden=<?= $ordenActual === 'asc' ? 'desc' : 'asc' ?>" class="hover:underline">
                                    Ultimo Pago <?= $ordenActual === 'asc' ? '↑' : '↓' ?>
                                </a>
                            </th>
                            <th class="px-4 py-2">
                                <a href="?columna=ultima_notificacion&orden=<?= $ordenActual === 'asc' ? 'desc' : 'asc' ?>" class="hover:underline">
                                    Ultima Notificación <?= $ordenActual === 'asc' ? '↑' : '↓' ?>
                                </a>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">



                       <?php foreach ($usuarios as $usuario) : ?>
                         <?php
                                 $tieneReporte = in_array($usuario->id, $usuariosConReporte);

                                $montoTotal = $usuario->monto;

                                if ($usuario->monto != $usuario->monto) {
                                 $usuario->monto = $nuevoMonto;
                                                      }

                                $pagoParcial = isset($usuario->monto_pagado) && $usuario->monto_pagado > 0 && $usuario->monto < $montoTotal;
                                          if ($pagoParcial) {
                                $usuario->dias_ultima_notificacion = 0;
                                                          }

                            $notificacionActiva = isset($usuario->dias_ultima_notificacion) && $usuario->dias_ultima_notificacion <= 8 && !$pagoParcial && !$tieneReporte;

                             $esRetrasado = isset($usuario->dias_ultima_notificacion) && $usuario->dias_ultima_notificacion >= 8 && !$pagoParcial && !$tieneReporte;

                             if ($tieneReporte) {
                                $claseFila = 'bg-gray-400 text-black dark:text-white';
                              } elseif ($esRetrasado) {
                           $claseFila = 'bg-red-600 text-white';
                                      }  elseif ($notificacionActiva) {
                                $claseFila = 'bg-gray-400 text-black dark:bg-gray-600 dark:text-white';
                            } 
                                      else {
                               $claseFila = 'odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white';
    }
    ?>

    <tr class="whitespace-nowrap <?= $claseFila ?> text-xs uppercase">
        <td class="flex justify-end items-center py-2 px-2">
            <?php if ($tieneReporte): ?>
                <span class="font-bold text-gray-700 uppercase bg-gray-300 px-2 rounded">Reportado</span>
            <?php elseif ($esRetrasado): ?>
                <?php
                $idNotificacion = $usuario->id_notificacion;
                $idNotificacionDesformateado = preg_replace('/^NOT\//', '', $idNotificacion);
                list($anio, $mes, $id) = explode('-', $idNotificacionDesformateado);
                ?>
                <a href="/generar-reporte?idx=<?= $idNotificacionDesformateado ?>&id_user=<?= $usuario->id ?>" class="flex flex-row flex-nowrap gap-2 items-center font-bold text-xs uppercase text-white hover:underline">
                    <span class="text-gray-600 text-xl">→</span>
                    Reporte
                </a>
            <?php else: ?>
                <?php if ($notificacionActiva): ?>
                                            <span class="font-bold text-gray-700 uppercase bg-gray-300 px-2 rounded">Not Activa</span>
                                        <?php else: ?>
                                            <button id="agregar-datos" class="flex flex-row flex-nowrap gap-2 items-center font-bold text-xs uppercase text-indigo-600 dark:text-indigo-200 hover:text-indigo-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                                </svg>
                                                Agregar
                                            </button>
                                        <?php endif; ?>
            <?php endif; ?>
        </td>
        <td class="py-2 px-2 font-bold"><?= $usuario->id ?></td>
        <td class="py-2 px-2"><?= strlen($usuario->nombre) >= 30 ? substr($usuario->nombre, 0, 30) . "..." : $usuario->nombre ?></td>
        <td class="py-2 px-2"><?= strlen($usuario->direccion) >= 30 ? substr($usuario->direccion, 0, 30) . "..." : $usuario->direccion ?></td>
        <td class="py-2 px-2"><?= $usuario->zona ?></td>
        <td class="py-2 px-2"><?= $usuario->colonia ?></td>
        <td class="py-2 px-2"><?= $usuario->tipo_toma ?></td>
        <td class="py-2 px-2"><?= $usuario->tipo_consumo ?></td>
        <td class="py-2 px-2"><?= $usuario->meses_rezagados ?></td>
        <td class="py-2 px-2"><?= $usuario->observaciones ?></td>
        <td class="py-2 px-2"><?= number_format($usuario->monto, 2) ?></td>
        <td class="py-2 px-2">
            <?= $usuario->ultimo_pago && $usuario->ultimo_pago != '0000-00-00' ? date('d/m/Y', strtotime($usuario->ultimo_pago)) : 'Sin Fecha' ?>
        </td>
        <td class="py-2 px-2">
            <?= isset($usuario->dias_ultima_notificacion) && $usuario->dias_ultima_notificacion !== null ? $usuario->dias_ultima_notificacion . ' días' : 'Sin Notificación' ?>
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
<?php $scripts = ['notificacion/filtros.js']; ?>