<section class="py-4 antialiased md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Agregar registro
            </h2>
        </div>

        <form id="enviar-registro" method="POST" class="my-10 space-y-5 max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded shadow px-5 md:px-10 py-5">
            <div id="div-notif"></div>
            <div>
                <label for="nivel" class="text-gray-600 font-bold text-sm uppercase block dark:text-gray-200 mb-1">Nivel</label>
                <select name="nivel" id="nivel" class="w-full px-4 py-2 rounded border bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-form">
                    <option value="">--Seleccione el nivel--</option>
                </select>
            </div>
            <div>
                <label for="llegada" class="text-gray-600 font-bold text-sm uppercase block dark:text-gray-200 mb-1">Llegada</label>
                <select name="llegada" id="llegada" class="w-full px-4 py-2 rounded border bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-form">
                    <option value="">--Seleccione el procentaje--</option>
                </select>
            </div>
            <div>
                <label for="fecha" class="text-gray-600 font-bold text-sm uppercase block dark:text-gray-200 mb-1">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full px-4 py-2 rounded border bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-form" value="<?= date('Y-m-d') ?>" />
            </div>
            <div>
                <label for="tanque_id" class="text-gray-600 font-bold text-sm uppercase block dark:text-gray-200 mb-1">Tanque</label>
                <select name="tanque_id" id="tanque_id" class="w-full px-4 py-2 rounded border bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white input-form">
                    <option value="">--Seleccione el tanque--</option>
                </select>
            </div>

            <div class="mb-10">
                <input type="submit" class="w-full bg-gray-200 px-4 py-2 rounded font-bold text-xs hover:bg-gray-300 uppercase dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 cursor-pointer" value="Guardar Registro" />
            </div>
        </form>

        <div class="min-w-lg w-full grid grid-cols-1 gap-5" id="contenedor-graficas">
            <div class=" w-full flex flex-col bg-clip-border text-gray-700 bg-white shadow-md rounded dark:bg-gray-800 dark:text-gray-200" id="line-chart-level"></div>
            <div class=" w-full flex flex-col bg-clip-border text-gray-700 bg-white shadow-md rounded dark:bg-gray-800 dark:text-gray-200"></div>
        </div>
    </div>
</section>

<?php $src = '<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>'; ?>
<?php $scripts = ['tanques/tanques_form_v1.js']; ?>