<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class=" py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Crear usuario
            </h2>
        </div>

        <div class="py-8 px-4 lg:px-8 mx-auto mt-10 bg-white dark:bg-gray-800 rounded shadow-lg">
            <form action="/datos-usuarios-crear" method="POST" autocomplete="off" enctype="multipart/form-data">
                <?php include_once __DIR__ . '/forms/formulario-usuario.php'; ?>
                <button type="submit" class="inline-flex bg-indigo-600 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded hover:bg-indigo-800">
                    Agregar Usuario
                </button>
            </form>
        </div>

    </article>

</section>