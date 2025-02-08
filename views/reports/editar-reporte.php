<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>


<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <section class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">Editar Reporte: <span id="folio-report"><?= $reporte->id ?></span></h2>
        </div>

        <form class="mt-6" id="formulario-reporte" autocomplete="off" method="POST"">
            <div class=" grid gap-6 mb-6 md:grid-cols-2">
            <div class="relative">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Usuario</label>
                <input type="text" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" value="<?= $reporte->name ?>" placeholder="John Wayne" />
                <div id="coincidencias-usuario" class="flex flex-col gap-2 mt-2"></div>
            </div>
            <div>
                <label for="idUser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID User</label>
                <input type="number" id="idUser" name="idUser" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" value="<?= $reporte->id_user ?>" placeholder="7777" />
                <div id="coincidencias-ID" class="flex flex-col gap-2 mt-2"></div>
            </div>
            <div>
                <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" value="<?= $reporte->address ?>" placeholder="La Concordia #42" />
            </div>
            <div>
                <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Teléfono</label>
                <input type="tel" id="telefono" name="telefono" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" value="<?= $reporte->phone ?>" placeholder="123 456 78 90" />
            </div>
            <div>
                <label for="beneficiario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beneficiario</label>
                <input type="text" id="beneficiario" name="beneficiario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase" value="<?= $reporte->beneficiary ?>" placeholder="Beneficiario de John Wayne" />
            </div>
            <div class="relative">
                <button type="button" id="resetear-formulario" class="md:absolute sm:bottom-0 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Resetear</button>
            </div>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="sm:mb-6">
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                    <select name="categoria" id="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                </div>
                <div class="sm:mb-6">
                    <label for="incidencia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Incidencia</label>
                    <select name="incidencia" id="incidencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled></select>
                </div>
                <div class="mb-6">
                    <label for="prioridad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prioridad</label>
                    <select name="prioridad" id="prioridad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                </div>
            </div>

            <div>
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Escribe tu descripción aquí..."><?= $reporte->description ?></textarea>
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Enviar Reporte</button>
            </div>
            </div>

        </form>

    </section>

    <section class="py-4 antialiased md:py-8 h-auto mx-auto mt-6 max-w-screen-lg px-4 2xl:px-0 border-y border-gray-200 dark:border-gray-700">
        <div class="flow-root">
            <div class="-my-6">
                <div class="space-y-4 py-2 md:py-4" id="reporte-reciente"></div>
            </div>
        </div>
    </section>

</section>

<?php
$scripts = ['reportes/editar-reporte.js'];
?>