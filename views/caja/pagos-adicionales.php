<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Pagos Adicionales
            </h2>

            <?php include_once __DIR__ . '/../templates/lista-costos-adicionales.php'; ?>

            <button class="py-2 px-4 bg-transparent rounded text-sm text-green-800 dark:text-green-400 font-semibold flex flex-row gap-2 items-center" id="btn-consto-adicional">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                </svg>Adicionales
            </button>

        </div>
    </article>
</section>

<?php $scripts = [
    'caja-cobro/adicional.js'
]; ?>