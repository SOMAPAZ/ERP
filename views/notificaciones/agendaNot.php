<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="w-full px-4 sm:px-6 lg:px-8  lg:max-w-screen-xl mx-auto">

        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">

            <div class="w-full flex justify-end px-4 mb-4">
                <a href="/agenda" class="bg-gray-100 px-4 py-2 mr-4 rounded-md font-semibold text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white cursor-pointer">
                    Agenda de Notificaciones
                </a>
                <a href="/agendalec" class="bg-gray-100 px-4 py-2 rounded-md font-semibold text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white cursor-pointer">
                    Agenda de Lecturas
                </a>
            </div>
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Agenda de Notificaciones
            </h2>
            <a href="/pdf/not-realizadas" class="bg-gray-100 px-4 py-2 rounded-md font-semibold text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white cursor-pointer">
                Notificaciones Realizadas
            </a>

            <div id="swal-container" data-alerta="<?= $_SESSION['alerta'] ?? '' ?>"></div>
            <?php unset($_SESSION['alerta']); ?>


        </div>
        <div class="font-bold text-base uppercase bg-white px-4 md:px-10 py-5  dark:bg-gray-900 ">
            <div id="agenda-container" class="grid grid-cols-1 md:grid-cols-1 gap-4">
            </div>
        </div>

    </article>

    <script>
        const empleadoId = <?php echo $_SESSION['empleado_id']; ?>;
    </script>

</section>

<?php $scripts = ['notificacion/agendaNot.js']; ?>