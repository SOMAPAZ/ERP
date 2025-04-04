<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Historial de Recibos
            </h2>
        </div>

        <div class="mt-10 overflow-x-auto">
            <!-- Recibos actuales -->
            <?php if ($recibos || $pagos_adicionales || $recibos_pasados) : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                        <tr>
                            <th class="p-2">Folio</th>
                            <th class="p-2">Fecha De Pago</th>
                            <th class="p-2">Periodo Inicio</th>
                            <th class="p-2">Periodo Fin</th>
                            <th class="p-2">Total Abonado</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php
                        $folio_recibo = 0;
                        foreach ($recibos as $key => $recibo) :
                            if ($folio_recibo !== (int) $recibo->folio):
                                $total = 0;
                        ?>
                                <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                                    <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                    <td class="py-2 px-2"><?= formatearFechaESLong($recibo->fecha) ?></td>
                                    <td class="py-2 px-2"><?= $recibo->mes_inicio ?></td>
                                    <td class="py-2 px-2"><?= $recibo->mes_fin ?></td>
                                <?php
                            endif;
                            $folio_recibo = (int) $recibo->folio;
                            $total += floatval($recibo->total);
                            $actual = $recibo->folio;
                            $proximo = $recibos[$key + 1]->folio ?? 0;
                            if (esUltimo($actual, $proximo)):
                                ?>
                                    <td class="py-2 px-2">$ <?= formatoMiles($total) ?></td>
                                    <td class="py-2 px-2 flex flex-row gap-4 flex-1 items-center">
                                        <a href="/pdf/recibo?id=<?= $recibo->id_user ?>&folio=<?= $recibo->folio ?>" target="_blank" class="flex flex-row text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                                            </svg>
                                            Ver
                                        </a>
                                        <?php if (!$recibo->cancelado) : ?>
                                            <form method="POST" action="/cambiar-estado-recibo">
                                                <input type="hidden" name="folio" value="<?= $recibo->folio ?>">
                                                <button type="submit" class="flex flex-row text-red-600 hover:text-red-800 dark:text-red-500 font-semibold text-xs uppercase items-center gap-1 disabled:opacity-30" <?= $recibo->cancelado ? "disabled" : "" ?>>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                                    </svg>
                                                    Invalidar
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form method="POST" action="/cambiar-estado-recibo">
                                                <input type="hidden" name="folio" value="<?= $recibo->folio ?>">
                                                <button type="submit" class="flex flex-row text-green-600 hover:text-green-800 dark:text-green-500 font-semibold text-xs uppercase items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                                    </svg>
                                                    Validar
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php
                            endif;
                        endforeach;
                        ?>
                        <!-- Recibos Pagos Adicionales -->
                        <?php if ($pagos_adicionales) :
                            $folio_adicional = 0;
                            foreach ($pagos_adicionales as $key => $adicional) :
                                if ($folio_adicional !== (int) $adicional->folio):
                                    $total = 0; ?>
                                    <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                                        <td class="py-2 px-2 font-bold"><?= $adicional->folio ?></td>
                                        <td class="py-2 px-2"><?= formatearFechaESLong($adicional->fecha) ?></td>
                                        <td class="py-2 px-2"></td>
                                        <td class="py-2 px-2"></td>
                                    <?php
                                endif;
                                $folio_adicional = (int) $adicional->folio;
                                $total += floatval($adicional->total);
                                $actual = $adicional->folio;
                                $proximo = $pagos_adicionales[$key + 1]->folio ?? 0;
                                if (esUltimo($actual, $proximo)):
                                    ?>
                                        <td class="py-2 px-2">$ <?= formatoMiles($total) ?></td>
                                        <td class="py-2 px-2 flex flex-row gap-4 flex-1 items-center">
                                            <a href="/pdf/recibo-adicionales?folio=<?= $adicional->folio ?>&id=<?= $adicional->id_user ?>" target="_blank" class="flex flex-row text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                                                </svg>
                                                Ver
                                            </a>
                                            <?php if (!$adicional->cancelado) : ?>
                                                <form method="POST" action="/cambiar-estado-recibo">
                                                    <input type="hidden" name="folio" value="<?= $adicional->folio ?>">
                                                    <button type="submit" class="flex flex-row text-red-600 hover:text-red-800 dark:text-red-500 font-semibold text-xs uppercase items-center gap-1 disabled:opacity-30">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                                        </svg>
                                                        Invalidar
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" action="/cambiar-estado-recibo">
                                                    <input type="hidden" name="folio" value="<?= $adicional->folio ?>">
                                                    <button type="submit" class="flex flex-row text-green-600 hover:text-green-800 dark:text-green-500 font-semibold text-xs uppercase items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                        Validar
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                        <!-- Recibos Anteriores -->
                        <?php if ($recibos_pasados) :
                            foreach ($recibos_pasados as $recibo) : ?>
                                <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                                    <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                    <td class="py-2 px-2"><?= formatearFechaESLong($recibo->date_invoice) ?></td>
                                    <td class="py-2 px-2"><?= explode(' ', $recibo->date_initial)[0] ?></td>
                                    <td class="py-2 px-2"><?= explode(' ', $recibo->date_final)[0] ?></td>
                                    <td class="py-2 px-2">$ <?= formatoMiles($recibo->amount) ?></td>
                                    <td></td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-center p-2 bg-white rounded shadow-lg font-bold">No hay registros Actuales</p>
            <?php endif; ?>
        </div>
    </article>

</section>