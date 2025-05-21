<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-2xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 text-xl text-gray-900 dark:text-white sm:text-4xl mt-10 uppercase text-center">
                <span class="font-black">Usuario:</span> <?= $usuario->user . " " . $usuario->lastname; ?>
            </h2>

            <div class=" w-full flex flex-col sm:flex-row justify-between gap-5 my-5">
                <form action="/caja-cobro" method="GET" autocomplete="off" id="formConsultarSig" class="w-full">
                    <label for="usuario" class="block text-sm font-bold uppercase text-gray-500 dark:text-gray-300 mb-2">Nueva busqueda por ID: </label>
                    <input type="number" name="usuario" class="w-full md:w-72 bg-gray-300 dark:bg-gray-700 border dark:border-gray-600 rounded py-2 px-4 dark:text-white" placeholder="Ingrese el ID">
                </form>
                <div>
                    <a class="w-full md:w-auto flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white" href="/consultar">Volver</a>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row justify-between items-center gap-5 my-5">
                <?php include_once __DIR__ . '/templates/card-info-usuario.php'; ?>

                <?php include_once __DIR__ . '/templates/card-info-deuda.php'; ?>
            </div>

        </div>
    </article>
</section>