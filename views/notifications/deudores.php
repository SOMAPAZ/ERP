<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Facturación Pendiente
            </h2>

            <form class="grid sm:grid-cols-2 md:grid-cols-3 my-10 md:my-5 lg:grid-cols-5 gap-4">
                <select name="colonia" id="colonia" class="bg-white px-6 py-1 border border-gray-300 rounded">
                    <option value="">- Colonia -</option>
                </select>
                <select name="zona" id="zona" class="bg-white px-6 py-1 border border-gray-300 rounded">
                    <option value="">- Zona -</option>
                </select>
                <select name="meses" id="meses" class="bg-white px-6 py-1 border border-gray-300 rounded">
                    <option value="">- Meses -</option>
                    <option value="1_3">1 - 3 meses</option>
                    <option value="4_6">4 - 6 meses</option>
                    <option value="7_9">7 - 9 meses</option>
                    <option value="10_12">10 - 12 meses</option>
                    <option value="13">+ 12 meses</option>
                </select>
                <select name="cantidad" id="cantidad" class="bg-white px-6 py-1 border border-gray-300 rounded">
                    <option value="">- Deuda -</option>
                    <option value="0_1000"> $100 - $1,000 </option>
                    <option value="1001_1500"> $1,001 - $1,500 </option>
                    <option value="1501_2000"> $1,501 - $2,000 </option>
                    <option value="2001_2500"> $2,001 - $2,500 </option>
                    <option value="2501"> +$2,500 </option>
                </select>

                <button type="button" id="btn-reset" class="bg-indigo-600 font-bold rounded text-white">Reiniciar</button>
            </form>

            <div class="grid md:grid-cols-2 gap-4">
                <p class="font-bold text-lg dark:text-white">Filtrado: <span id="filtrado-text" class="text-gray-700 dark:text-gray-400 font-normal">Ninguno</span></p>
                <p class="font-bold text-lg dark:text-white">Resultados: <span id="resultados-text" class="text-gray-700 dark:text-gray-400 font-normal"></span></p>
            </div>

            <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-deudores">
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
            <div class="flex flex-col items-center">
                <span id="info-pagina" class="text-sm text-gray-700 dark:text-gray-400"></span>
                <div class="inline-flex mt-2 xs:mt-0">
                    <button id="btn-anterior" class="hidden items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previo</button>
                    <button id="btn-siguiente" class="hidden items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Siguiente</button>
                </div>
            </div>
        </div>
    </article>
</section>

<?php $scripts = ['notificaciones/deudores.js']; ?>