<div class=" w-full px-4 sm:px-10 sm:mx-auto text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center my-5">

        <div class="flex flex-row lg:justify-between mt-5">
            <a href="<?= '?y=2024&m=1' ?>" class="inline-block p-2 border-b-2 rounded-lg <?= $year === '2024' ? 'text-blue-600 border-blue-600 border border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">2024</a>
            <a href="<?= '?y=2025&m=1' ?>" class="inline-block p-2 border-b-2 rounded-lg <?= $year === '2025' ? 'text-blue-600 border-blue-600 border border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">2025</a>
        </div>
    </div>

    <ul class="w-full grid grid-cols-6 sm:flex sm:flex-row sm:justify-between mb-1">
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=1" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '1' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">01<span class="hidden xl:inline-block xl:ms-1">- Ene</span></a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=2" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '2' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">02<span class="hidden xl:inline-block xl:ms-1">- Feb</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=3" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '3' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">03<span class="hidden xl:inline-block xl:ms-1">- Mar</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=4" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '4' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">04<span class="hidden xl:inline-block xl:ms-1">- Abr</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=5" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '5' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">05<span class="hidden xl:inline-block xl:ms-1">- May</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=6" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '6' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">06<span class="hidden xl:inline-block xl:ms-1">- Jun</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=7" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '7' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">07<span class="hidden xl:inline-block xl:ms-1">- Jul</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=8" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '8' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">08<span class="hidden xl:inline-block xl:ms-1">- Ago</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=9" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '9' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">09<span class="hidden xl:inline-block xl:ms-1">- Sep</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=10" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '10' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">10<span class="hidden xl:inline-block xl:ms-1">- Oct</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=11" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '11' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">11<span class="hidden xl:inline-block xl:ms-1">- Nov</a>
        </li>
        <li class="me-2">
            <a href="?y=<?= $year ?>&m=12" class="inline-block p-2 border-b-2 rounded-t-lg <?= $mes === '12' ? 'text-blue-600 border-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' ?>">12<span class="hidden xl:inline-block xl:ms-1">- Dic</a>
        </li>
    </ul>
</div>