<?php $links[] = 'arqueos';
require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Historial de Recibos
            </h2>
        </div>

        <div class="mt-10 overflow-x-auto">
            <!-- Recibos actuales -->
            <?php if ($recibos) : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                        <tr>
                            <th class="py-1 px-2">Folio</th>
                            <th class="py-1 px-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php
                        foreach ($recibos as $recibo) : ?>
                            <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                                <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                    <form method="POST" action="/eliminar-corte">
                                        <input type="hidden" name="folio" value="<?= $recibo->folio ?>">
                                        <button type="submit" class="flex flex-row text-red-600 hover:text-red-800 font-semibold text-xs uppercase items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                            </svg>
                                            Cancelar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-center p-2 bg-white rounded shadow-lg font-bold">No hay registros</p>
            <?php endif; ?>
            <!-- Recibos Pagos Adicionales -->
            <?php if ($pagos_adicionales) : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                        <tr>
                            <th class="py-1 px-2">Folio</th>
                            <th class="py-1 px-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php
                        foreach ($pagos_adicionales as $pago) : ?>
                            <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                                <td class="py-2 px-2 font-bold"><?= $pago->folio ?></td>
                                <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                    <form method="POST" action="/cancelar-recibo">
                                        <input type="hidden" name="folio" value="<?= $pago->folio ?>">
                                        <button type="submit" class="flex flex-row text-red-600 hover:text-red-800 font-semibold text-xs uppercase items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                            </svg>
                                            Cancelar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-center p-2 bg-white rounded shadow-lg font-bold">No hay registros</p>
            <?php endif; ?>
            <!-- Recibos Anteriores -->
            <?php if ($recibos_pasados) : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                        <tr>
                            <th class="py-1 px-2">Folio</th>
                            <th class="py-1 px-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php
                        foreach ($recibos_pasados as $recibo) : ?>
                            <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                                <td class="py-2 px-2 font-bold"><?= $recibo->folio ?></td>
                                <td class="py-2 px-2 flex flex-row justify-end">
                                    <button type="submit" class="flex flex-row gap-2 text-red-600 hover:text-red-800 font-semibold text-xs uppercase items-center disabled:opacity-50" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                        </svg>
                                        No cancelables
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-center p-2 bg-white rounded shadow-lg font-bold">No hay registros</p>
            <?php endif; ?>
        </div>
    </article>

</section>

<?php $scripts = [
    'caja-cobro/sumar-billetes.js'
];
