<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Usuarios
            </h2>
        </div>
        <div class="relative overflow-x-auto mx-auto mb-5 py-4 lg:px-10 text-left uppercase">
            <div class="flex flex-col md:flex-row gap-2">
                <button
                    id="btn-buscar-usuario"
                    class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 text-xs font-bold uppercase rounded hover:bg-indigo-500">
                    Buscar
                </button>
                <a href="/datos-usuarios-crear" class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                    Agregar usuario
                </a>
            </div>
            <?= $paginacion; ?>
            <table class="w-full">
                <thead class="text-left bg-indigo-600 text-white text-xs uppercase">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">
                            ID
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">
                            Nombre
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">
                            Dirección
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">
                            Télefono
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                            <td class="py-2 px-2 font-bold"><?= $usuario->id ?></td>
                            <td class="py-2 px-2"><?= $usuario->user . " " . $usuario->lastname ?></td>
                            <td class="py-2 px-2"><?= strlen($usuario->address) >= 30 ? substr($usuario->address, 0, 30) . "..." : $usuario->address ?></td>
                            <td class="py-2 px-2"><?= !$usuario->phone || strlen($usuario->phone) === 0 ? 'Sin tel.' : $usuario->phone ?></td>
                            <td class="flex justify-end items-center">
                                <a href="/datos-usuarios-editar?id=<?= $usuario->id ?>" class="flex flex-row gap-1 py-2 px-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                    Editar
                                </a>
                                <form action="/datos-usuarios-eliminar" method="POST" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                    <button type="submit" class="flex flex-row gap-1 py-2 px-2 text-red-600 hover:text-red-800 dark:text-red-200 dark:hover:text-red-400 font-semibold text-xs uppercase items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $paginacion; ?>
        </div>
    </article>
</section>

<?php $scripts = ['usuarios/busqueda.js']; ?>