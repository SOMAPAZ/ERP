<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Consulta del Adeudo del Usuario
            </h2>

            <div class="my-10 flex flex-col items-center justify-center gap-6">
                <p class="text-lg text-center dark:text-white">
                    No hay ninguna consulta previa,
                    <a id="a-search-user" class="text-indigo-600 hover:underline font-bold cursor-pointer">agrega una consulta para comenzar</a>
                </p>

                <button
                    id="btn-search-user"
                    class="w-full sm:w-auto flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white">
                    Buscar
                </button>
            </div>

            <div class="overflow-x-auto lg:w-full">
                <?php if (count($ultimosPagos)) : ?>
                    <h1 class="text-2xl text-center font-bold my-10 dark:text-gray-200">Últimos con abonos realizados</h1>
                    <table class="whitespace-nowrap w-full bg-white dark:bg-gray-800 shadow-md overflow-hidden">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-sm leading-normal">
                            <tr class="text-left">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Usuario</th>
                                <th class="px-4 py-2">Fecha</th>
                                <th class="px-4 py-2">Buscado por</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <?php foreach ($ultimosPagos as $pago) : ?>
                                <tr class="uppercase text-gray-600 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 font-bold"><?= $pago->usuario->id ?></td>
                                    <td class="px-4 py-2"><?= $pago->usuario->user . " " . $pago->usuario->lastname ?></td>
                                    <td class="px-4 py-2"><?= formatearFechaESLong($pago->fecha) ?></td>
                                    <td class="px-4 py-2"><?= $pago->empleado->name . " " . $pago->empleado->lastname ?></td>
                                    <td class="px-4 py-2">
                                        <a href="/caja-cobro?usuario=<?= $pago->usuario->id ?>" class="text-indigo-600 hover:underline dark:text-indigo-400 font-bold cursor-pointer">Ver</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <img src="build/img/bg-search-debt.svg" alt="buscar usuario" class="h-96">
                <?php endif; ?>
            </div>
        </div>
    </article>

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div id="datos-usuario"></div>
        <div id="deuda-usuario" class="mt-6"></div>
        <div id="boton" class="mt-6 flex flex-col md:flex-row gap-4"></div>
    </article>
</section>