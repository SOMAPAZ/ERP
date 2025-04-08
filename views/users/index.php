<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Información de Usuarios
            </h2>
        </div>
        <div class="relative overflow-x-auto mx-auto mb-5 py-4 lg:px-10 text-left uppercase">
            <button
                id="btn-buscar-usuario"
                class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 text-xs font-bold uppercase rounded hover:bg-indigo-500">
                Buscar
            </button>
            <?= $paginacion; ?>
            <table class="w-full">
                <thead class="text-left bg-indigo-600 text-white text-sm uppercase">
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
                            Zona
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col">
                            Télefono
                        </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="whitespace-nowrap odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800 dark:text-white">
                            <td class="py-2 px-2 font-bold"><?= $usuario->id ?></td>
                            <td class="py-2 px-2"><?= $usuario->user . " " . $usuario->lastname ?></td>
                            <td class="py-2 px-2"><?= strlen($usuario->address) >= 30 ? substr($usuario->address, 0, 30) . "..." : $usuario->address ?></td>
                            <td class="py-2 px-2"><?= $usuario->zona->name ?></td>
                            <td class="py-2 px-2"><?= !$usuario->phone || strlen($usuario->phone) === 0 ? 'Sin tel.' : $usuario->phone ?></td>
                            <td class="flex flex-end items-center">
                                <a href="/buscar-usuario?id=<?= $usuario->id ?>" class="flex flex-row gap-1 py-2 px-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-400 font-semibold text-xs uppercase items-center">Ver
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $paginacion; ?>
        </div>
    </article>
</section>