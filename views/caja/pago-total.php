<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Pagar Total
            </h2>

            <?php if (date('m') < 3): ?>
                <div class="w-full flex flex-row justify-end">
                    <button class="bg-orange-200 text-orange-800 px-4 py-2 rounded-lg font-black text-xs uppercase hover:bg-orange-300" id="descuento-inicio-year">Descuento por inicio de año</button>
                </div>
            <?php endif; ?>

            <form class="w-full bg-white mx-auto mt-5 space-y-5 font-semibold border border-dashed border-gray-400 rounded-lg p-6 shadow-lg text-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white" id="formulario-pago" autocomplete="off">
                <div class="grid lg:grid-cols-4 gap-4">
                    <div class="space-y-2 lg:col-span-1">
                        <label for="id_user" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">ID Usuario</label>
                        <input type="number" name="id_user" id="id_user" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600" disabled>
                    </div>
                    <div class="space-y-2 lg:col-span-2">
                        <label for="nombre_usuario" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Usuario</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 uppercase" disabled>
                    </div>
                    <div class="space-y-2 lg:col-span-1">
                        <label for="tipo_usuario" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Tipo</label>
                        <input type="text" name="tipo_usuario" id="tipo_usuario" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 uppercase" disabled>
                    </div>
                </div>
                <div class="grid lg:grid-cols-4 gap-4">
                    <div class="space-y-2 lg:col-span-2">
                        <label for="mes_inicio" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Periodo Inicio</label>
                        <input type="text" name="mes_inicio" id="mes_inicio" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                    <div class="space-y-2 lg:col-span-2">
                        <label for="mes_fin" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Periodo Final</label>
                        <input type="text" name="mes_fin" id="mes_fin" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                </div>
                <div class="grid lg:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label for="total_agua" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Agua</label>
                        <input type="text" name="total_agua" id="total_agua" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                    <div class="space-y-2">
                        <label for="total_drenaje" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Drenaje</label>
                        <input type="text" name="total_drenaje" id="total_drenaje" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                    <div class="space-y-2">
                        <label for="total_recargos" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Recargos</label>
                        <input type="text" name="total_recargos" id="total_recargos" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                    <div class="space-y-2">
                        <label for="total_iva" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">IVA</label>
                        <input type="text" name="total_iva" id="total_iva" class="w-full px-4 py-2 rounded-md border-b border-gray-400 bg-transparent dark:border-gray-600 " disabled>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-row items-center py-5 text-xl md:text-2xl lg:text-4xl">
                        <label for="total" class="font-black text-gray-600 uppercase dark:text-gray-400">Total: <span class="text-black dark:text-white me-2">$ </span></label>
                        <input type="text" name="total" id="total" class="bg-transparent font-black w-24 md:w-40 lg:w-80" disabled>
                    </div>
                </div>
                <div class="space-y-5 border-t border-gray-400">
                    <h3 class="uppercase ms-5 font-bold mt-5">Seleccione el tipo de pago</h3>
                    <div class="w-full flex flex-col lg:flex-row justify-between px-5 space-y-2 lg:space-y-0">
                        <div class="flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center">
                            <input type="radio" name="tipo_pago" id="tipo_1" value="1">
                            <label for="tipo_1" class="cursor-pointer w-full">Efectivo</label>
                        </div>
                        <div class="flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center">
                            <input type="radio" name="tipo_pago" id="tipo_2" value="2">
                            <label for="tipo_2" class="cursor-pointer w-full">Cheque</label>
                        </div>
                        <div class="flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center">
                            <input type="radio" name="tipo_pago" id="tipo_3" value="3">
                            <label for="tipo_3" class="cursor-pointer w-full">Depósito</label>
                        </div>
                        <div class="flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center">
                            <input type="radio" name="tipo_pago" id="tipo_4" value="4">
                            <label for="tipo_4" class="cursor-pointer w-full">Transferencia</label>
                        </div>
                        <div class="flex flex-row gap-3 border border-dashed border-gray-400 px-4 py-1 rounded-lg items-center">
                            <input type="radio" name="tipo_pago" id="tipo_5" value="5">
                            <label for="tipo_5" class="cursor-pointer w-full">T.P.V</label>
                        </div>
                    </div>
                </div>
            </form>
            <form class="w-full p-4 bg-white dark:bg-gray-800 border border-dashed border-gray-400 rounded-lg space-y-5" id="notas-form">
                <label for="notas" class="block w-full font-black text-gray-600 text-xs uppercase dark:text-gray-400">Notas</label>
                <textarea name="notas" id="notas" class="w-full px-4 py-2 rounded-md border border-gray-200 dark:border-gray-600 dark:bg-gray-600 dark:text-white" placeholder="Ingrese aquí su nota"></textarea>
            </form>
            <?php include_once __DIR__ . '/../templates/lista-costos-adicionales.php'; ?>
            <div id="buttons-actions" class="flex flex-col mt-10 md:flex-row gap-4">
                <button type="button" id="realizar-pago" class="text-white text-lg flex items-center justify-center sm:w-full md:w-auto uppercase bg-gray-500 dark:bg-gray-700 py-2 px-6 rounded-sm hover:bg-gray-300 hover:text-gray-800 dark:hover:bg-gray-600 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    <p class="font-bold text-xs">Pagar</p>
                </button>
                <button class="py-2 px-4 bg-transparent rounded text-sm text-green-800 dark:text-green-400 font-semibold flex flex-row gap-2 items-center" id="btn-consto-adicional">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>Costo Adicional
                </button>
                <button type="button" id="realizar-desc" class="text-gray-900 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase text-xs py-2 px-6 rounded-sm gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="font-bold text-xs">Descuento Recargos</p>
                </button>
                <button type="button" id="eliminar-desc" class="hidden text-red-800 dark:text-white flex items-center justify-center sm:w-full md:w-auto uppercase bg-red-200 dark:bg-red-800 text-xs py-2 px-6 rounded-sm hover:bg-red-300 dark:hover:bg-red-600 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="font-bold text-xs">Eliminar descuento</p>
                </button>
            </div>
        </div>
    </article>
</section>

<?php $scripts = [
    'caja-cobro/pago-total_v2.js',
    'caja-cobro/adicional_v2.js'
]; ?>