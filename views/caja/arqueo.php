<section class="py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Historial de Arqueos
            </h2>
        </div>

        <div class="mt-10 overflow-x-auto">
            <?php if ($arqueos) : ?>
                <table class="w-full">
                    <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
                        <tr>
                            <th class="py-1 px-2">Folio</th>
                            <th class="py-1 px-2">Entrega</th>
                            <th class="py-1 px-2">Recibe</th>
                            <th class="py-1 px-2">Testigo</th>
                            <th class="py-1 px-2">Fecha</th>
                            <th class="py-1 px-2">Hora</th>
                            <th class="py-1 px-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php
                        foreach ($arqueos as $arqueo) : ?>
                            <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                                <td class="py-2 px-2 font-bold"><?= $arqueo->folio ?></td>
                                <td class="py-2 px-2"><?= $arqueo->entrega->name . " " . $arqueo->entrega->lastname ?></td>
                                <td class="py-2 px-2"><?= $arqueo->recibe->name . " " . $arqueo->recibe->lastname ?></td>
                                <td class="py-2 px-2"><?= $arqueo->testigo->name . " " . $arqueo->testigo->lastname ?></td>
                                <td class="py-2 px-2"><?= $arqueo->fecha ?></td>
                                <td class="py-2 px-2"><?= $arqueo->hora ?></td>
                                <td class="py-2 px-2 flex flex-row gap-4 justify-end">
                                    <a href="/pdf/corte-caja?folio=<?= $arqueo->folio ?>" class="flex flex-row text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm4.75 6.75a.75.75 0 0 1 1.5 0v2.546l.943-1.048a.75.75 0 0 1 1.114 1.004l-2.25 2.5a.75.75 0 0 1-1.114 0l-2.25-2.5a.75.75 0 1 1 1.114-1.004l.943 1.048V8.75Z" clip-rule="evenodd" />
                                        </svg> PDF
                                    </a>
                                    <form method="POST" action="/eliminar-corte">
                                        <input type="hidden" name="folio" value="<?= $arqueo->folio ?>">
                                        <button type="submit" class="flex flex-row text-red-600 hover:text-red-800 font-semibold text-xs uppercase items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                            </svg>
                                            Eliminar
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
        </div>
    </article>

</section>