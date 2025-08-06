<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0">
    <div class="space-y-2 h-full px-3 py-4 overflow-y-auto bg-indigo-600 dark:bg-indigo-950">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/welcome" class="flex gap-2 justify-center items-center mb-3 text-2xl font-extrabold text-white dark:text-white">
                    <picture class="bg-white w-12 h-12 flex justify-center items-center rounded-full">
                        <source srcset="build/img/log-smpz.avif" type="image/avif">
                        <source srcset="build/img/log-smpz.webp" type="image/webp">
                        <img class="h-8" src="build/img/log-smpz.avif" alt="logo">
                    </picture>
                    SOMAPAZ
                </a>
            </li>
        </ul>
        <ul class="md:hidden space-y-2 font-medium mt-5 border-y border-indigo-200">
            <li>
                <button class="w-full flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group md:hidden" id="btn-cerrar-menu" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="ms-3">Cerrar menú</span>
                </button>
            </li>
        </ul>
        <ul class="font-medium md:border-y border-indigo-200">
            <p class="text-sm text-white py-5 text-center">
                <?= $_SESSION['empleado_name']; ?>
            </p>
        </ul>
        <ul class="space-y-2 font-medium my-5 mt-5 border-y border-indigo-200">
            <?php if ($_SESSION['empleado_rol'] === "1" || $_SESSION['empleado_rol'] === "3") : ?>
                <li>
                    <a href="/general" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 <?= $_SERVER['PATH_INFO'] === "/general" ? "bg-indigo-800" : "" ?> group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>

                        <span class="ms-3">Administrador</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['empleado_rol'] === "1" || $_SESSION['empleado_rol'] === "3" || $_SESSION['empleado_rol'] === "8" || $_SESSION['empleado_rol'] === "2") : ?>
                <li>
                    <a href="/usuarios" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group <?= $_SERVER['PATH_INFO'] === "/usuarios" ? "bg-indigo-800" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['empleado_rol'] === "1" || $_SESSION['empleado_rol'] === "3" || $_SESSION['empleado_rol'] === "8" || $_SESSION['empleado_rol'] === "2") : ?>
                <li>
                    <a href="/notificaciones" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group <?= $_SERVER['PATH_INFO'] === "/notificaciones" ? "bg-indigo-800" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                            <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97Z" clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Notificaciones</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['empleado_rol'] === "1" || $_SESSION['empleado_rol'] === "3" || $_SESSION['empleado_rol'] === "8" || $_SESSION['empleado_rol'] === "2") : ?>
                <li>
                    <a href="/consultar" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group <?= $_SERVER['PATH_INFO'] === "/consultar" ? "bg-indigo-800" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                            <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                            <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                            <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Caja</span>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="/reportes?s=1" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group <?= $_SERVER['PATH_INFO'] === "/reportes" ? "bg-indigo-800" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                        <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                        <path d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                        <path fill-rule="evenodd" d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Reportes</span>
                </a>
            </li>
            <li>
                <a href="/tanks" class="flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group <?= $_SERVER['PATH_INFO'] === "/tanks" ? "bg-indigo-800" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="flex-shrink-0 w-5 h-5 text-white">
                        <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Tanques</span>
                </a>
            </li>
        </ul>
        <ul class="space-y-2 font-medium">
            <li>
                <button type="button" class="w-full flex items-center p-2 rounded-lg text-white hover:bg-indigo-700 dark:hover:bg-gray-700 group" id="theme-switcher">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white" id="svg-icon-theme"></svg>
                    <span class=" ms-3 whitespace-nowrap">Cambiar tema</span>
                </button>
            </li>
            <li>
                <a href="/close" class="flex items-center p-2 rounded-lg hover:bg-red-100 hover:text-red-800 text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-400">
                        <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </div>
</aside>