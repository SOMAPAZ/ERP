<section class="py-4 antialiased md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Información de Usuarios
            </h2>
        </div>
        <div class="relative overflow-x-auto mx-auto mb-5 py-4 lg:px-10 text-left uppercase">
            <div class="space-y-2 sm:space-y-0 flex flex-col sm:flex-row gap-2">
                <button
                    id="btn-buscar-usuario"
                    class="w-full md:w-auto inline-flex justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs font-bold uppercase rounded hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                    </svg>
                    Buscar
                </button>
                <a href="/datos-usuarios-crear" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                    Agregar usuario
                </a>
            </div>

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

<?php $scripts = ['usuarios/busqueda.js']; ?>