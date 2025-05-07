<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-10">
        <h2 class="py-10 font-black text-xl text-gray-900 dark:text-white sm:text-4xl text-center">
            Agrega los materiales
        </h2>
        <div class="flex justify-end">
            <a class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700" href="/reporte?folio=<?= $reporte->id ?>">Volver</a>
        </div>

        <div>
            <form method="POST" class="max-w-screen-md mx-auto flex flex-col p-10 bg-white dark:bg-gray-800 rounded-lg shadow-xl mt-10 gap-5" autocomplete="off" novalidate>
                <div class="mb-2">
                    <?php if (isset($alertas['exito']['material'])): ?>
                        <p class="text-xs uppercase bg-green-600 p-2 text-white text-center font-bold rounded mt-2">
                            <?= $alertas['exito']['material'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="material" class="mb-2 block uppercase text-gray-500 font-bold">
                        Material
                    </label>
                    <input
                        type="text"
                        id="material"
                        name="material"
                        placeholder="Escriba el material"
                        class="bg-gray-200 dark:bg-gray-700 border dark:border-gray-600 dark:text-white p-3 w-full rounded-lg <?= isset($alertas['error']['material']) ? 'border-red-600' : '' ?>"
                        value="<?= $material->material ?? '' ?>" />
                    <?php if (isset($alertas['error']['material'])) : ?>
                        <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2">
                            <?= $alertas['error']['material'] ?>
                        </p>
                    <?php endif; ?>
                    <ul class="mt-2 space-y-2" id="listado-materiales"></ul>
                </div>
                <div class="mb-2">
                    <label for="quantity" class="mb-2 block uppercase text-gray-500 font-bold">
                        Cantidad
                    </label>
                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        placeholder="Escriba la cantidad utilizada"
                        class="bg-gray-200 dark:bg-gray-700 border dark:border-gray-600 dark:text-white p-3 w-full rounded-lg <?= isset($alertas['error']['quantity']) ? 'border-red-600' : '' ?>"
                        value="<?= $material->quantity ?? '' ?>" />
                    <?php if (isset($alertas['error']['quantity'])) : ?>
                        <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2">
                            <?= $alertas['error']['quantity'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="id_unity" class="mb-2 block uppercase text-gray-500 font-bold">
                        Unidad
                    </label>
                    <select
                        id="id_unity"
                        name="id_unity"
                        class="bg-gray-200 dark:bg-gray-700 border dark:border-gray-600 dark:text-white p-3 w-full rounded-lg <?= isset($alertas['error']['id_unity']) ? 'border-red-600' : '' ?>">
                        <option value="">--Seleccione una unidad --</option>
                        <?php foreach ($unidades as $unidad): ?>
                            <option value="<?= $unidad->id ?>" <?= $material->id_unity === $unidad->id ? 'selected' : ''; ?>><?= $unidad->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($alertas['error']['id_unity'])) : ?>
                        <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2">
                            <?= $alertas['error']['id_unity'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="id_report" name="id_report" value="<?= $reporte->id ?>">

                <input type="submit" value="Agregar material"
                    class="bg-indigo-600 hover:bg-indigo-700 transition-colors cursor-pointer uppercase font-bold w-full p-2 text-white rounded text-sm" />
            </form>

            <div class="max-w-screen-md mx-auto mt-10 rounded text-white p-5">
                <?php if (count($materiales)): ?>
                    <table class="table-auto text-gray-700 dark:text-white w-full bg-gray-600 font-semibold text-sm">
                        <thead class="text-white">
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Unidad</th>
                                <th class="px-4 py-2">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materiales as $material): ?>
                                <tr class="odd:bg-white odd:dark:bg-gray-700 even:bg-gray-200 even:dark:bg-gray-800">
                                    <td class="px-4 py-2"><?= $material->material ?></td>
                                    <td class="px-4 py-2"><?= $material->unity->name ?></td>
                                    <td class="px-4 py-2"><?= $material->quantity ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-gray-500 text-xs uppercase font-bold">No hay materiales asociados a este reporte</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>