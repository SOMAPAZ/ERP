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
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3 sm:gap-6 mt-2">
                    <div class="w-full">
                        <label for="id_observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones</label>
                        <select name="id_observaciones" id="id_observaciones" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="">--Selecciona una opción--</option>
                            <?php foreach ($observaciones as $observacion): ?>
                                <option value="<?= $observacion->id ?>" <?= $usuario->id_observaciones == $observacion->id ? 'selected' : ''; ?>><?= $observacion->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="stored_water" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agua Almacenada</label>
                        <input type="text" id="stored_water" name="stored_water" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Agua en m3" value="<?= $usuario->stored_water ?? ''; ?>">
                    </div>
                </div>
                <button type="submit" class="inline-flex bg-indigo-600 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded hover:bg-indigo-800">
                    Guardar Cambios
                </button>
            </form>
        </div>

    </article>

</section>