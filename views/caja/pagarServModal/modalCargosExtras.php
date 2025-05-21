<div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-600 bg-opacity-80 transition-opacity duration-300 ease-in-out opacity-0 hidden" id="ModalCargosExtras">
    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto mt-20">
        <form class="relative w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white space-y-4" id="form-cargo-extra" novalidate>
            <div class="w-full">
                <label for="adicionales" class="block text-sm text-gray-600 uppercase font-bold mb-2 dark:text-gray-200">Cargos adicionales</label>
                <select name="adicionales" id="adicionales" class="w-full text-sm bg-gray-200 text-gray-700 py-3 px-6 rounded dark:bg-gray-700 dark:text-whit uppercase dark:text-white">
                    <option value="">-- Seleccione un cargo --</option>
                    <?php foreach ($costos as $costo): ?>
                        <option value="<?= $costo->id ?>">
                            <?= strlen($costo->cuenta) > 60 ? substr($costo->cuenta, 0, 60) . '...' : $costo->cuenta ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full flex flex-col md:flex-row items-center gap-6 border-b pb-4">
                <div class="w-full md:w-3/5">
                    <label for="costo" class="block text-sm text-gray-600 uppercase font-bold mb-2 dark:text-gray-200">Costo (Sin IVA)</label>
                    <input type="number" name="costo" id="costo" class="w-full text-sm bg-gray-200 text-gray-700 dark:text-gray-300 py-3 px-6 rounded dark:bg-gray-700 dark:text-whit uppercase" placeholder="Ingrese el costo, Ej. 161.22">
                </div>
                <div class="w-full md:w-2/5 flex flex-nowrap gap-2 md:mt-6">
                    <input type="checkbox" name="costo_iva" id="costo_iva" class="size-6 text-indigo-600 bg-gray-300 rounded border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" checked>
                    <label for="costo_iva" class="text-sm text-gray-600 uppercase font-bold dark:text-gray-200">¿Incluye IVA?</label>
                </div>
            </div>
            <div class="flex flex-col-reverse justify-end sm:flex-row items-center gap-4 mt-5">
                <button type="button" class="w-full md:w-auto text-gray-700 rounded-lg px-4 py-2 text-sm uppercase dark:text-gray-200 tracking-widest" id="btnCloseExtrasModal">Cerrar</button>
                <input type="submit" value="Agregar cargo" id="agregar-cargo-extra" class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm uppercase hover:bg-indigo-700 cursor-pointer tracking-widest">
            </div>
        </form>
    </div>
</div>