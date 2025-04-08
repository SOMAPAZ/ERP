<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Condonaciones
            </h2>
        </div>

        <div class="overflow-x-auto mt-10">
            <table class="w-full shadow-md text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="condonacion-desglose">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="whitespace-nowrap text-center">
                        <th scope="col" class="px-6 py-3">
                            Id Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Año
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Monto Condonado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </article>

</section>

<?php $scripts = [
    'caja-cobro/condonaciones_v2.js'
];
