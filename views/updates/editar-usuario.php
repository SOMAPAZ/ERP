<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class=" py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Editar usuario
            </h2>
        </div>

        <div class="space-y-2 sm:space-y-0 flex justify-end sm:flex-row gap-2 mt-2">
            <a href="/buscar-usuario?id=<?= s($_GET['id']) ?>" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                </svg>
                Volver
            </a>
        </div>
        <div class="py-8 px-4 lg:px-8 mx-auto mt-10 bg-white dark:bg-gray-800 rounded shadow-lg">
            <form method="POST" autocomplete="off" enctype="multipart/form-data">
                <?php include_once __DIR__ . '/forms/formulario-usuario.php'; ?>
                <button type="submit" class="inline-flex bg-indigo-600 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded hover:bg-indigo-800">
                    Guardar Cambios
                </button>
            </form>
        </div>

    </article>

</section>