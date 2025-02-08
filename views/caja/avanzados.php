<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">


        <div class="relative overflow-x-auto sm:rounded-lg">

            <button class="py-2 px-4 bg-blue-100 dark:bg-blue-700 rounded text-sm text-gray-800 dark:text-white
                my-4 hover:bg-blue-200 dark:hover:bg-blue-600 font-semibold" id="btn-pago-parcial">Pagar Parcial</button>
            <button class="py-2 px-4 bg-orange-100 dark:bg-orange-700 rounded text-sm text-gray-800 dark:text-white
                my-4 hover:bg-orange-200 dark:hover:bg-orange-600 font-semibold" id="btn-condonar-parcial">Condonar Parcial</button>

            <div id="radio_inputs" class="grid selection:sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 my-6">
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"><input id="tipo_pago_1" type="radio" value="1" name="tipo_pago" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" checked><label for="tipo_pago_1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Efectivo</label></div>
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"><input id="tipo_pago_2" type="radio" value="2" name="tipo_pago" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"><label for="tipo_pago_2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Cheque</label></div>
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"><input id="tipo_pago_3" type="radio" value="3" name="tipo_pago" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"><label for="tipo_pago_3" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Depósito</label></div>
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"><input id="tipo_pago_4" type="radio" value="4" name="tipo_pago" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"><label for="tipo_pago_4" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Transferencia</label></div>
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"><input id="tipo_pago_5" type="radio" value="5" name="tipo_pago" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"><label for="tipo_pago_5" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">T.P.V</label></div>
            </div>

            <div id="periodo-label"></div>

            <table class="w-full shadow-md text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="adeudo-desglose">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="whitespace-nowrap">
                        <th scope="col" class="p-4">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Año
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Agua
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Recargo Agua
                        </th>
                        <th scope="col" class="px-6 py-3">
                            IVA Agua
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Drenaje
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Recargo Drenaje
                        </th>
                        <th scope="col" class="px-6 py-3">
                            IVA Drenaje
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </article>
</section>
<?php $scripts = ['caja-cobro/avanzados.js']; ?>