<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>


<section class="bg-white py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">Reporte de Notificacion</h2>
        </div>
        <div class="space-y-2 sm:space-y-0 flex justify-end sm:flex-row gap-2 mt-2">
            <a href="/agenda" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                </svg>
                Volver
            </a>
        </div>
        <form class="mt-6" id="formulario-notificaciones" autocomplete="off" method="POST" enctype="multipart/form-data">
            <div class="max-w-4xl mx-auto p-4 space-y-8">
                <section class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Datos de Usuario</h2>
                    <div class="grid gap-6 md:grid-cols-3">
                        <div class="flex flex-col col-span-1">
                            <label for="idUser" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">ID User</label>
                            <input type="number" id="idUser" name="idUser" placeholder="7777"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase w-24" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="nombreCompleto" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Nombre del Usuario</label>
                            <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="John Wayne"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500                  dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="direccion" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Dirección</label>
                            <input type="text" id="direccion" name="direccion" placeholder="La Concordia #42" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="colonia" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Colonia</label>
                            <input type="text" id="colonia" name="colonia" placeholder="Colonia Centro"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500                 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="zona" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Zona</label>
                            <input type="text" id="zona" name="zona" placeholder="ZONA 3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase" disabled />
                        </div>

                        <div class="flex flex-col">
                            <label for="observaciones" class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Observaciones</label>
                            <input type="text" id="observaciones" name="observaciones" placeholder="104" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2.5 uppercase" disabled />
                        </div>
                    </div>
                </section>
                <section class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 ">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mt-5">Datos de Notificación</h2>

                    <div class="flex flex-col items-center mt-6 space-y-6">
                        <div class="w-full flex flex-wrap justify-between items-center mt-6">
                            <button type="button" data-id="1"
                                class="tipo_notificacion text-blue-700 hover:text-white border-2 border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 w-full sm:w-auto">
                                Personal
                            </button>
                            <button type="button" data-id="2"
                                class="tipo_notificacion text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 w-full sm:w-auto">
                                Domiciliaria
                            </button>
                            <button type="button" data-id="3"
                                class="tipo_notificacion text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 w-full sm:w-auto">
                                No Realizada
                            </button>
                        </div>
                        <input type="hidden" name="tipo_notificacion" id="tipoNotificacionInput" required>


                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="evidencia" class="text-sm font-medium text-gray-700 dark:text-gray-200">Evidencia</label>
                        <input type="file" id="evidencia" name="evidencia" accept="image/*" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3" />
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="comentarios" class="text-sm font-medium text-gray-700 dark:text-gray-200">Comentarios</label>
                        <textarea name="comentarios" id="comentarios" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-3"></textarea>
                    </div>


            </div>

            <div class="flex justify-center mt-8">
                <button
                    type="submit"
                    id="resetear-formulario"
                    class="px-6 py-3 text-sm font-medium text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-indigo-600 dark:hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </article>
</section>

<?php $scripts = ['notificacion/formNot.js']; ?>