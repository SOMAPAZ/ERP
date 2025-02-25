<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>


<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

<article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">Editar Reporte: <?= $reporte->id ?></h2>
            <a class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700" href="/reporte?folio=<?= $reporte->id ?>">Volver</a>
        </div>

        <form class="mt-6 border p-5 border-gray-300 shadow rounded-lg border-dashed" id="formulario-reporte" autocomplete="off">
            <div id="div-notif"></div>
            <div class=" grid gap-6 mb-6 md:grid-cols-2">
                <input type="hidden" name="folio" class="input-report" value="<?= $reporte->id ?>">
                <div class="relative">
                    <label for="nombre" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Nombre del Usuario</label>
                    <input type="text" id="nombre" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ingrese el nombre de usuario" value="<?= $reporte->name ?? 'Nombre no registrado' ?>" />
                    <ul id="coincidencias-usuario" class="flex flex-col gap-2 mt-2"></ul>
                </div>
                <div>
                    <label for="idUser" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">ID User</label>
                    <input type="number" id="idUser" name="id_user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ingrese el ID" value="<?= $reporte->id_user ?? '0' ?>" />
                    <ul id="coincidencias-ID" class="flex flex-col gap-2 mt-2"></ul>
                </div>
                <div>
                    <label for="direccion" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Dirección</label>
                    <input type="text" id="direccion" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ej: La Concordia #42" value="<?= $reporte->address ?? 'Dirección no registrada' ?>" />
                </div>
                <div>
                    <label for="telefono" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Número de Teléfono</label>
                    <input type="tel" id="telefono" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ej: 123 456 78 90" value="<?= $reporte->phone ?? 's/#' ?>" />
                </div>
                <div>
                    <label for="beneficiario" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Beneficiario</label>
                    <input type="text" id="beneficiario" name="beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ingrese nombre de beneficiario" value="<?= $reporte->beneficiary ?? 's/n' ?>" />
                </div>
                <div class="relative">
                    <button type="button" id="resetear-formulario" class="flex items-center gap-2 md:absolute sm:bottom-0 font-bold hover:bg-gray-200 text-xs w-auto px-5 py-2.5 text-center uppercase dark:text-white dark:hover:bg-gray-600 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                        Resetear
                    </button>
                </div>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="sm:mb-6">
                    <label for="categoria" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Categoría</label>
                    <select name="id_category" id="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input-report">
                        <option value="">-Seleccione una categoría</option>
                    </select>
                </div>
                <div class="sm:mb-6">
                    <label for="incidencia" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Incidencia</label>
                    <select name="id_incidence" id="incidencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input-report">
                        <option value="">-Seleccione una incidencia</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="prioridad" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Prioridad</label>
                    <select name="id_priority" id="prioridad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input-report">
                        <option value="">-Seleccione la prioridad</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="descripcion" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Tu descripción</label>
                <textarea id="descripcion" name="description" rows="4" class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white input-report" placeholder="Escribe tu descripción aquí..."><?= $reporte->description ?? 'Sin descripción' ?></textarea>
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Actualizar Reporte</button>
            </div>
            </div>

        </form>

    </article>

    <article class="py-4 antialiased md:py-8 h-auto mx-auto mt-6 max-w-screen-lg px-4 2xl:px-0 border-y border-gray-200 dark:border-gray-700">
        <div class="flow-root">
            <div class="-my-6">
                <div class="space-y-4 py-2 md:py-4" id="reporte-reciente"></div>
            </div>
        </div>
    </article>

</section>

<?php
$scripts = ['reportes/editar-reporte.js'];
?>