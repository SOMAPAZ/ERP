<?php $cdn = "<link rel='stylesheet' href='https://unpkg.com/dropzone@5/dist/min/dropzone.min.css' type='text/css' />"; ?>

<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-10">
        <h2 class="py-10 font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center">
            Agrega tu nota
        </h2>

        <div class="flex justify-end">
            <a class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700" href="/reporte?folio=<?= $reporte->id ?>">Volver</a>
        </div>

        <div>
            <form method="POST" action="/crear-nota_reporte" id="formulario-notas" class="md:flex md:items-center p-10 bg-white dark:bg-gray-800 rounded-lg shadow-xl mt-10 gap-5" enctype="multipart/form-data" novalidate>
                <div class="md:w-1/2">
                    <div id="dropzone" class="dropzone dark:bg-gray-800 dark:text-white font-semibold border-2 border-dashed dark:border-gray-600 w-full min-h-96 lg:min-h-72 rounded flex-col lg:flex-row justify-center items-center"></div>
                </div>
                <div class="md:w-1/2 px-0 py-5 md:p-10">
                    <div class="mb-5">
                        <label for="note" class="mb-2 block uppercase text-gray-500 font-bold">
                            Descripción de la imagen
                        </label>
                        <textarea id="note" name="note" placeholder="Descripción de la imagen" rows="4"
                            class="border p-3 w-full rounded-lg dark:bg-gray-700 dark:border-gray-600" required></textarea>
                        <div class="alerta-vacio"></div>
                    </div>

                    <div class="mb-5">
                        <input type="hidden" id="id_report" name="id_report" value="<?= $reporte->id ?>">
                    </div>

                    <input type="button" value="Crear nota" id="btn-crear-nota"
                        class="bg-indigo-600 hover:bg-indigo-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded text-sm" />
                </div>
            </form>
        </div>
    </div>
</section>