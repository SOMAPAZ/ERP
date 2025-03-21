<?php
// $links[] = 'adicionales';
require_once __DIR__ . '/../templates/nav-bar.php';
?>
<section class=" py-4 antialiased md:py-8 h-auto">
    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="relative sm:rounded-lg">

            <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                <button class="py-2 px-4 bg-gray-200 dark:bg-gray-700 rounded text-sm text-gray-800 dark:text-white
                    md:my-4 hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold flex flex-row gap-2 items-center" id="btn-pago-parcial">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                        <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                        <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                    </svg>
                    Pagar
                </button>
                <button class="py-2 px-4 bg-transparent rounded text-sm text-green-800 dark:text-green-400
                    md:my-4 font-semibold flex flex-row gap-2 items-center" id="btn-consto-adicional">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>Adicionales
                </button>
                <button class="py-2 px-4 bg-transparent rounded text-sm text-gray-800 dark:text-white
                    md:my-4 font-semibold flex flex-row gap-2 items-center" id="btn-condonar-parcial">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
                    </svg>Condonar
                </button>
            </div>

            <div id="periodo-label" class="bg-white dark:bg-gray-700"></div>

            <div id="radio_inputs" class="grid selection:sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-5">
                <div class="bg-white flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center dark:bg-gray-700 dark:text-gray-300 text-xs uppercase font-black">
                    <input id="tipo_pago_1" type="radio" value="1" name="tipo_pago" checked>
                    <label for="tipo_pago_1" class="cursor-pointer w-full">Efectivo</label>
                </div>
                <div class="bg-white flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center dark:bg-gray-700 dark:text-gray-300 text-xs uppercase font-black">
                    <input id="tipo_pago_2" type="radio" value="2" name="tipo_pago">
                    <label for="tipo_pago_2" class="cursor-pointer w-full">Cheque</label>
                </div>
                <div class="bg-white flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center dark:bg-gray-700 dark:text-gray-300 text-xs uppercase font-black">
                    <input id="tipo_pago_3" type="radio" value="3" name="tipo_pago">
                    <label for="tipo_pago_3" class="cursor-pointer w-full">Depósito</label>
                </div>
                <div class="bg-white flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center dark:bg-gray-700 dark:text-gray-300 text-xs uppercase font-black">
                    <input id="tipo_pago_4" type="radio" value="4" name="tipo_pago">
                    <label for="tipo_pago_4" class="cursor-pointer w-full">Transferencia</label>
                </div>
                <div class="bg-white flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center dark:bg-gray-700 dark:text-gray-300 text-xs uppercase font-black">
                    <input id="tipo_pago_5" type="radio" value="5" name="tipo_pago">
                    <label for="tipo_pago_5" class="cursor-pointer w-full">T.P.V</label>
                </div>
            </div>

            <div class="overflow-x-auto">
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
                                Tarifa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descuento
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Agua
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rec Agua
                            </th>
                            <th scope="col" class="px-6 py-3">
                                IVA Agua
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Drenaje
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rec Drenaje
                            </th>
                            <th scope="col" class="px-6 py-3">
                                IVA Drenaje
                            </th>
                            <?php if ($esMedido): ?>
                                <th scope="col" class="px-6 py-3">
                                    Lectura
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Direfencia
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Extra (m3)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Extra ($)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Extra (IVA)
                                </th>
                            <?php endif; ?>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div id="listado-adicionales" class="p-4 my-5 space-y-2 bg-white dark:bg-gray-700 rounded shadow">
                <ul class="space-y-2 border-gray-600 dark:border-gray-400 border-b py-3">
                    <li class="text-center font-bold text-gray-700 dark:text-gray-200">No hay costos adicionales</li>
                </ul>
            </div>
        </div>
    </article>
</section>
<?php $scripts = ['caja-cobro/avanzados.js', 'caja-cobro/adicional.js']; ?>