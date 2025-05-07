<div class=" w-full px-4 sm:px-10 sm:mx-auto text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center my-5">
        <form class="flex justify-center items-center">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M19.906 9c.382 0 .749.057 1.094.162V9a3 3 0 0 0-3-3h-3.879a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H6a3 3 0 0 0-3 3v3.162A3.756 3.756 0 0 1 4.094 9h15.812ZM4.094 10.5a2.25 2.25 0 0 0-2.227 2.568l.857 6A2.25 2.25 0 0 0 4.951 21H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-2.227-2.568H4.094Z" />
                    </svg>
                </div>
                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ingrese el texto..." required />
            </div>
            <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
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