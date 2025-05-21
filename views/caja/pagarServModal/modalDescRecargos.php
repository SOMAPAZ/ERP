<div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-600 bg-opacity-80 transition-opacity duration-300 ease-in-out opacity-0 hidden" id="modalDescRecargos">
    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto mt-20">
        <form class="relative w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white space-y-4" id="form-desc-recargos" novalidate>
            <div class="w-full">
                <label for="desc_recargos" class="block text-sm text-gray-600 dark:text-gray-300 uppercase font-bold mb-2">Descuento Recargos</label>
                <input
                    name="desc_recargos"
                    id="desc_recargos"
                    type="number"
                    class="w-full text-sm bg-gray-200 text-gray-700 py-3 px-6 rounded dark:bg-gray-700 dark:text-white uppercase "
                    placeholder="Ingrese un valor de descuento, Ej. 100.00">
            </div>
            <div class="w-full flex flex-col md:flex-row justify-between items-center md:gap-6 gap-0 border-b pb-4">
                <ul class="items-center w-full md:w-1/2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="input-tipo-desc-rec-percen" type="radio" value="100" name="tipo-desc-rec" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300" checked>
                            <label for="input-tipo-desc-rec-percen" class="w-full py-1 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                En Porcentaje
                            </label>
                        </div>
                    </li>
                    <li class="w-full dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="input-tipo-desc-rec-pesos" type="radio" value="1" name="tipo-desc-rec" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300">
                            <label for="input-tipo-desc-rec-pesos" class="w-full py-1 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                En Pesos
                            </label>
                        </div>
                    </li>
                </ul>
                <p class="w-full flex justify-end md:w-1/2">
                    Total Recargos: $ <span id="span-monto-recargos"><?= formatoMiles($deuda['recargos']['total']) ?></span>
                </p>
            </div>
            <div class="flex flex-col-reverse justify-end sm:flex-row items-center gap-4 mt-5">
                <button type="button" class="w-full md:w-auto text-gray-700 rounded-lg px-4 py-2 text-sm uppercase dark:text-gray-200 tracking-widest" id="btnCloseDescRecModal">
                    Cerrar
                </button>
                <button type="button" class="w-full md:w-auto border border-orange-700 text-orange-700 dark:bg-gray-700 rounded-lg px-4 py-2 text-sm uppercase dark:text-orange-200 tracking-widest" id="btnCalcularDesc">
                    Calcular
                </button>
                <input type="submit" value="Aplicar descuento" id="agregar-desc-subtotal" class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm uppercase hover:bg-indigo-700 cursor-pointer tracking-widest">
            </div>
        </form>
    </div>
</div>