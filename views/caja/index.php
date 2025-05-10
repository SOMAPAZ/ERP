<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Consulta del Adeudo del Usuario
            </h2>

            <div class="my-10 flex flex-col items-center justify-center gap-6">
                <p class="text-lg text-center dark:text-white">
                    No hay ninguna consulta previa,
                    <a id="a-search-user" class="text-indigo-600 hover:underline font-bold cursor-pointer">agrega una consulta para comenzar</a>
                </p>

                <button
                    id="btn-search-user"
                    class="text-sm font-bold uppercase px-6 py-2 bg-indigo-600 rounded text-white hover:bg-indigo-700">
                    Buscar
                </button>
            </div>

            <div>
                <img src="build/img/bg-search-debt.svg" alt="buscar usuario" class="h-96">
            </div>
        </div>
    </article>

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div id="datos-usuario"></div>
        <div id="deuda-usuario" class="mt-6"></div>
        <div id="boton" class="mt-6 flex flex-col md:flex-row gap-4"></div>
    </article>
</section>