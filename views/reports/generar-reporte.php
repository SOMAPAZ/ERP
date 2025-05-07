<section class=" py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">Generar Reporte</h2>
        </div>

        <form method="POST" action="/generar-reporte" class="bg-white dark:bg-gray-800 mt-6 border p-5 border-gray-300 shadow rounded-lg border-dashed" id="formulario-reporte" autocomplete="off">

            <?php include_once __DIR__ . '/form-reporte.php'; ?>
            <div class="flex justify-center mt-6">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Enviar Reporte</button>
            </div>
        </form>

    </article>

</section>