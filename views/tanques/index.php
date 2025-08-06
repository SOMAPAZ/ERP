<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="py-4 antialiased md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Control de Tanques
            </h2>
        </div>

        <form id="enviar-form">
            <div class="mt-10 mb-5 grid sm:grid-cols-3 gap-5">
                <div class="flex flex-col space-y-2 text-gray-700 dark:text-gray-200">
                    <label for="tanque_id" class="font-bold uppercase text-sm">Tanque</label>
                    <select name="tanque_id" id="tanque_id" class="border border-gray-200 dark:border-gray-600 px-4 py-2 rounded text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                        <option value="" selected>-- Seleccione --</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-2 text-gray-700 dark:text-gray-200">
                    <label for="mes" class="font-bold uppercase text-sm">Mes</label>
                    <select name="mes" id="number_mes" class="border border-gray-200 dark:border-gray-600 px-4 py-2 rounded text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                        <option value="" selected>-- Seleccione --</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-2 text-gray-700 dark:text-gray-200">
                    <label for="year" class="font-bold uppercase text-sm">Año</label>
                    <select name="year" id="number_year" class="border border-gray-200 dark:border-gray-600 px-4 py-2 rounded text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                        <option value="" selected>-- Seleccione --</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>
    
            <div class="mb-10 flex justify-end">
                <input type="submit" class="w-full inline sm:w-auto bg-gray-300 px-4 py-2 rounded font-bold text-xs hover:bg-gray-400 uppercase dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 cursor-pointer" value="Graficar" />
            </div>
        </form>

        <div class="min-w-lg w-full grid grid-cols-1 gap-5" id="contenedor-graficas">
            <div class=" w-full flex flex-col bg-clip-border text-gray-700 bg-white shadow-md rounded dark:bg-gray-800 dark:text-gray-200" id="line-chart-level"></div>
            <div class=" w-full flex flex-col bg-clip-border text-gray-700 bg-white shadow-md rounded dark:bg-gray-800 dark:text-gray-200"></div>
        </div>
    </div>
</section>

<?php $src = '<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>'; ?>  
<?php $scripts = ['tanques/tanques_charts_v2.js']; ?>