<div class="text-center">
    <button class="fixed top-1 left-1 text-indigo-600 hover:bg-indigo-200 font-medium rounded text-sm px-5 py-2.5 dark:text-gray-300 dark:hover:bg-gray-950" type="button" id="show-sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
        </svg>

    </button>
</div>

<aside id="sidebar-navigation" class="fixed top-0 left-0 z-40 w-64 h-screen p-4 shadow-lg overflow-y-auto transition-transform -translate-x-full bg-indigo-600 dark:bg-gray-950">
    <h5 id="drawer-navigation-label" class="flex gap-2 items-center font-semibold text-sm text-white uppercase ">
        <svg class="h-6 w-6 text-white font-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
        </svg><?= $_SESSION['empleado_name']; ?>
    </h5>
    <button type="button" id="hide-sidebar" class="text-white bg-transparent hover:bg-indigo-700 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-900 ">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Cerrar menú</span>
    </button>
    <div class="py-4 overflow-y-auto">
        <ul class="space-y-2 font-normal text-sm py-5">
            <li>
                <button type="button" class="flex items-center w-full p-2 transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900" id="dropdown-admin">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75">
                        <use xlink:href="assets/sprite.svg#admin" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Administrador</span>
                    <svg class="w-5 h-5 text-white">
                        <use xlink:href="assets/sprite.svg#breakdown" />
                    </svg>
                </button>
                <ul id="list-admin" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/general" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; General</a>
                    </li>
                    <li>
                        <a href="/empleados" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Empleados</a>
                    </li>
                    <li>
                        <a href="/roles" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Roles</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/usuarios" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#users" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
                </a>
            </li>
            <li>
                <a href="/agreements" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#aggrenments" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Convenios</span>
                </a>
            </li>
            <li>
                <a href="/notificaciones" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#notifications" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Not & Lect</span>
                </a>
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900" id="dropdown-caja">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#payments" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Caja</span>
                    <svg class="w-5 h-5 text-white">
                        <use xlink:href="assets/sprite.svg#breakdown" />
                    </svg>
                </button>
                <ul id="list-caja" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/consultar" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Cobrar</a>
                    </li>
                    <li>
                        <a href="/adicionales" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Adicionales</a>
                    </li>
                    <li>
                        <a href="/crear-corte" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Crear Corte</a>
                    </li>
                    <li>
                        <a href="/arqueos" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Arqueos</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900" id="dropdown-reportes">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#reports" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Reportes</span>
                    <svg class="w-5 h-5 text-white">
                        <use xlink:href="assets/sprite.svg#breakdown" />
                    </svg>
                </button>
                <ul id="list-reportes" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/generar-reporte" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Generar</a>
                    </li>
                    <li>
                        <a href="/reportes-abiertos" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Rep. Abiertos</a>
                    </li>
                    <li>
                        <a href="/reportes-proceso" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Rep. Proceso</a>
                    </li>
                    <li>
                        <a href="/reportes-cerrados" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Rep. Cerrado</a>
                    </li>
                    <li>
                        <a href="/reportes-terminados" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Rep. Terminados</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2  transition duration-75 rounded-lg group text-white hover:bg-indigo-800 dark:hover:bg-gray-900" id="dropdown-tanques">
                    <svg class="shrink-0 w-5 h-5 text-white transition duration-75 ">
                        <use xlink:href="assets/sprite.svg#tanks" />
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tanques</span>
                    <svg class="w-5 h-5 text-white">
                        <use xlink:href="assets/sprite.svg#breakdown" />
                    </svg>
                </button>
                <ul id="list-tanques" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/tanks" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Gráficos</a>
                    </li>
                    <li>
                        <a href="/generar-registro" class="flex items-center gap-2 w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-indigo-800 dark:hover:bg-gray-900 text-white">&mdash; Generar Registro</a>
                    </li>
                </ul>
            </li>
            <li class="border-t border-gray-200 dark:border-gray-700 pt-2">
                <button type="button" class="w-full flex items-center p-2 text-sky-300 rounded-lg dark:text-sky-200 hover:bg-sky-900 dark:hover:bg-indigo-800 group" id="theme-switcher">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-sky-300  dark:text-indigo-200 transition duration-75 " id="svg-icon-theme"></svg>
                    <span class="ms-3 whitespace-nowrap">Cambiar tema</span>
                </button>
            </li>
            <li>
                <a href="/close" class="flex items-center p-2 text-red-200 rounded-lg dark:text-red-300 hover:bg-red-300 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-100 group">
                    <svg class="shrink-0 w-5 h-5 text-red-200 transition duration-75  dark:text-red-400 group-hover:text-red-900 dark:group-hover:text-red-100">
                        <use xlink:href="assets/sprite.svg#close" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</aside>