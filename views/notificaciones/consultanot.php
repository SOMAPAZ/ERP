<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">



        <div class="space-y-2 sm:space-y-0 flex justify-end sm:flex-row gap-2 mt-2">
            <a id="volverbutton" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-indigo-600 text-white px-4 py-2 text-xs text-center font-bold uppercase rounded hover:bg-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                </svg>
                Volver
            </a>
        </div>





        <div class="lg:flex lg:items-center lg:justify-between lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center cursor-pointer">
                Notificación: <span class="font-normal"></span>
            </h2>
        </div>


        <div class="py-2 lg:py-4">
            <h2 class="mb-4 text-lg font-normal leading-none text-gray-900 md:text-2xl dark:text-white">
                <span class="font-extrabold">Usuario: </span>
                <dd id="nombreCompleto" class="uppercase"></dd>
            </h2>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Descripción:</dt>
                <dd class="mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
            </dl>
            <dl class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 items-center">
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">ID User:</dt>
                    <dd id="idUser" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">

                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Dirección:</dt>
                    <dd id="direccion" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Colonia:</dt>
                    <dd id="colonia" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Zona:</dt>
                    <dd id="zona" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Observaciones:</dt>
                    <dd id="observaciones" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Meses Rezagados:</dt>
                    <dd id="mesrez" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Total Deuda:</dt>
                    <dd id="tdeuda" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Estado de la Notificacion:</dt>
                    <dd id="status" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400">
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Fecha Registrada:</dt>
                    <dd id="fregistrada" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Fecha de Finalizacion:</dt>
                    <dd id="ffinal" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Costo por Notificacion:</dt>
                    <dd id="costonot" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Comentarios:</dt>
                    <dd id="comentarios" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Entregado por:</dt>
                    <dd id="idempleado" class="mb-2 md:mb-4 font-light text-gray-500 dark:text-gray-400"></dd>
                </div>

            </dl>

        </div>
        <div class="grid gap-2 md:grid-cols-1 text-center justify-between">
            <div class="flex flex-col items-center col-span-1">
                <label class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-200">Foto de Evidencia</label>
                <img alt="Foto de evidencia" id="fevidencia" name="fevidencia"
                    class="w-64 h-64 object-cover rounded-lg border border-gray-300 dark:border-gray-600" />

            </div>
          <div id="imgModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.75); justify-content:center; align-items:center; z-index:50;">
                <span id="closeModal" style="position:absolute; top:20px; right:30px; font-size:40px; color:white; cursor:pointer;">&times;</span>
                <img id="modalImg" style="max-width:90%; max-height:90%; border-radius:8px; transition: transform 0.3s ease;" />
                <div class="absolute bottom-5 text-black">
                    <button id="zoomOut" class="border-2 border-black bg-gray-200 text-black px-3 py-1 mx-1 rounded cursor-pointer">-</button>
                    <button id="zoomIn" class="border-2 border-black bg-gray-200 text-black px-3 py-1 mx-1 rounded cursor-pointer">+</button>
                </div>
            </div>
        </div>

    </div>
</section>
<?php $scripts = ['notificacion/consultanot.js']; ?>