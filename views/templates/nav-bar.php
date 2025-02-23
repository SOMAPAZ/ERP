<div class="bg-indigo-600 dark:bg-indigo-950 shadow-md">
    <div class="container mx-auto flex flex-col-reverse md:flex-row justify-end items-center gap-4 py-3 text-sm font-medium uppercase px-4">
        <div id="apartados" class="text-center gap-6 flex flex-row md:justify-between">
            <button id="btn-menu" type="button" class="flex flex-row gap-2 items-center p-2 text-sm text-white rounded-lg md:hidden hover:bg-indigo-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75Zm0 4.167a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Zm0 4.166a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Zm0 4.167a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
                Menú
            </button>

            <div class="hidden md:flex md:gap-4">
                <?php foreach ($links as $link): ?>
                    <a href="/<?= $link; ?>" class="bg-indigo-800 px-4 py-2 rounded-md font-semibold text-white hover:bg-indigo-900 cursor-pointer"><?= str_replace('-', ' ', $link); ?></a>
                <?php endforeach; ?>
            </div>
            <div>
                <button id="links-button" class="md:hidden flex-shrink-0 z-10 inline-flex items-center py-2 px-4 text-xs font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:border-gray-600 uppercase" type="button">
                    <?= $links[0] ?> <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="dropdown-links" class="absolute z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="states-button">
                        <?php foreach ($links as $link): ?>
                            <li>
                                <a href="/<?= $link; ?>" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <p class="inline-flex items-center"><?= str_replace('-', ' ', $link); ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>