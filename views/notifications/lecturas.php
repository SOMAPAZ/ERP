<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Servicio Medido
            </h2>

            <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-medido">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="whitespace-nowrap">
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Direccion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Colonia
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Zona
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Meses Rez
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Monto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </article>


</section>
<?php $scripts = ['notificaciones/medido.js']; ?>