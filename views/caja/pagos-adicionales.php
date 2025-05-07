<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Pagos Adicionales
            </h2>

            <div class="alertas w-full uppercase text-xs"></div>

            <form class="w-full bg-white my-5 dark:bg-gray-800 p-5 space-y-5 rounded shadow border border-dashed border-gray-400" autocomplete="off">
                <div>
                    <label for="idUser" class="block mb-1 dark:text-white font-bold uppercase text-sm">ID (En caso de ser usuario perteneciente al sistema)</label>
                    <input type="number" id="idUser" name="idUser" class="bg-gray-200 dark:bg-gray-700 dark:text-white px-2 py-2 w-full rounded uppercase" placeholder="Ingresa id" />
                    <ul id="listado-coincidencias-id" class="space-y-3 mt-3"></ul>
                </div>
                <div>
                    <label for="nombre" class="block mb-1 dark:text-white font-bold uppercase text-sm">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="bg-gray-200 dark:bg-gray-700 dark:text-white px-2 py-2 w-full rounded uppercase" placeholder="Ingresa nombre" />
                    <ul id="listado-coincidencias-nombre" class="space-y-3 mt-3"></ul>
                </div>
                <div>
                    <label for="direccion" class="block mb-1 dark:text-white font-bold uppercase text-sm">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="bg-gray-200 dark:bg-gray-700 dark:text-white px-2 py-2 w-full rounded uppercase" placeholder="Ingresa dirección">
                </div>
                <div>
                    <label for="tipo_pago" class="block mb-1 dark:text-white font-bold uppercase text-sm">Tipo de Pago</label>
                    <select id="tipo_pago" name="tipo_pago" class="bg-gray-200 dark:bg-gray-700 dark:text-white px-2 py-2 w-full rounded uppercase text-xs">
                        <option value=""> -- Seleccione el tipo de pago -- </option>
                        <option value="1">Efectivo</option>
                        <option value="2">Cheque</option>
                        <option value="3">Depósito</option>
                        <option value="4">Transferencia</option>
                        <option value="4">T.P.V</option>
                    </select>
                </div>
            </form>

            <?php include_once __DIR__ . '/../templates/lista-costos-adicionales.php'; ?>

            <div class="flex flex-col mt-5 lg:mt-0 sm:flex-row gap-4">

                <button class="py-2 px-4 rounded text-sm bg-green-200 text-green-800 dark:text-green-100 dark:bg-green-600 font-semibold flex flex-row gap-2 items-center justify-center" id="btn-consto-adicional">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>Adicionales
                </button>
                <button class="bg-indigo-800 px-4 py-2 rounded-md font-semibold text-sm text-white hover:bg-indigo-900 cursor-pointer" id="btn-enviar-pago">
                    Generar Recibo
                </button>
            </div>


        </div>
    </article>
</section>

<?php $scripts = [
    'caja-cobro/adicional_v2.js',
    'caja-cobro/formulario-adicionales_v2.js',
]; ?>