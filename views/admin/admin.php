<?php include_once __DIR__ . '/../templates/nav-bar.php'; ?>

<main class="container mx-auto px-4 mt-10 dark:text-dark-font">
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Administrador</h2>
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16">
                <div class="items-center bg-white rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <img class="w-full sm:max-w-64 rounded-lg sm:rounded-none sm:rounded-l-lg" src="build/img/icon-director.webp" alt="icon-director">
                    <div class="p-5 space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            <a href="#"><?= $administrador->name . ' ' . $administrador->lastname; ?></a>
                        </h3>
                        <span class="text-gray-500 dark:text-gray-400">Director General</span>
                        <div class="flex flex-col space-y-2 sm:mt-0 font-bold">
                            <p>User id: <span class="font-normal"> <?= $administrador->id; ?></span></p>
                            <p>Phone number: <span class="font-normal"> <?= $administrador->phone; ?></span></p>
                            <p>E-mail: <span class="font-normal"> <?= $administrador->mail; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Tu equipo</h2>
            </div>

            <div class="flow-root">
                <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <?php foreach ($empleados as $empleado): 
                        if($empleado->id !== '0' && $empleado->id !== '1'): ?>
                        <div class="flex flex-col sm:gap-4 bg-white p-4 rounded shadow">
                            <dt class="font-bold text-gray-900 dark:text-white p-2">
                                ID:<span class="font-normal"> <?= $empleado->id; ?></span>
                            </dt>
                            <dd class="font-bold text-gray-700 sm:col-span-2 dark:text-gray-200 p-2">
                                Nombre: <span class="font-normal"><?= $empleado->name . ' ' . $empleado->lastname; ?></span>
                            </dd>
                        </div>
                    <?php
                        endif;
                    endforeach; ?>
                </dl>
            </div>
        </div>
    </section>
</main>