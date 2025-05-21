<div class="w-full md:w-1/2">
    <?php if ($deuda['estado'] === 'debe'): ?>
        <div class="w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white font-bold">
            <p class="text-xl md:text-2xl text-center">
                Periodo: <span class="font-normal uppercase"><?= formatearFechaES($deuda['periodo']['inicio']) ?> -- <?= formatearFechaES($deuda['periodo']['final']) ?></span>
            </p>
            <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-3 my-5 text-lg">
                <div class="space-y-1">
                    <p>Costo de Agua: <span class="font-normal text-gray-700 dark:text-gray-300">$ <?= formatoMiles($deuda['agua_inicial']) ?> MNX</span></p>
                    <?php if ($deuda['m3_excedido_agua'] > 0): ?>
                        <p class="font-normal text-gray-500 text-sm">Costo de Agua Excedido: <span>$ <?= formatoMiles($deuda['m3_excedido_agua']) ?> MNX</span></p>
                    <?php endif; ?>
                </div>
                <div class="space-y-1">
                    <p>Costo de Drenaje: <span class="font-normal text-gray-700 dark:text-gray-300">$ <?= formatoMiles($deuda['drenaje_inicial']) ?> MNX</span></p>
                    <?php if ($deuda['m3_excedido_drenaje'] > 0): ?>
                        <p class="font-normal text-gray-500 text-sm">Costo de Drenaje Excedido: <span>$ <?= formatoMiles($deuda['m3_excedido_drenaje']) ?> MNX</span></p>
                    <?php endif; ?>
                </div>
                <div class="space-y-1">
                    <p>Costo de Recargos: <span class="font-normal text-gray-700 dark:text-gray-300">$ <?= formatoMiles($deuda['recargos']['total']) ?> MNX</span></p>
                    <p class="font-normal text-gray-500 text-sm">Recargos Agua: <span>$ <?= $deuda['recargos']['agua'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">Recargos Drenaje: <span>$ <?= $deuda['recargos']['drenaje'] ?></span></p>
                </div>
                <div class="space-y-1">
                    <p>Descuento: <span class="font-normal text-gray-700 dark:text-gray-300"><?= $deuda['descuentos']['total'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">Descuento Agua: <span><?= $deuda['descuentos']['agua'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">Descuento Drenaje: <span><?= $deuda['descuentos']['drenaje'] ?></span></p>
                </div>
                <div class="space-y-1">
                    <p>Total de Meses: <span class="font-normal text-gray-700 dark:text-gray-300"><?= $deuda['meses']['totales'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">Meses Rezagados: <span><?= $deuda['meses']['rezagados'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">Meses Naturales: <span><?= $deuda['meses']['naturales'] ?></span></p>
                </div>
                <div class="space-y-1">
                    <p>Costo de IVA: <span class="font-normal text-gray-700 dark:text-gray-300">$ <?= formatoMiles($deuda['iva']['total']) ?> MNX</span></p>
                    <p class="font-normal text-gray-500 text-sm">IVA Agua: <span>$ <?= $deuda['iva']['agua'] ?></span></p>
                    <p class="font-normal text-gray-500 text-sm">IVA Drenaje: <span>$ <?= $deuda['iva']['drenaje'] ?></span></p>
                    <?php if ($deuda['iva']['m3_excedido_agua'] > 0): ?>
                        <p class="font-normal text-gray-500 text-sm">IVA Drenaje Excedido: <span>$ <?= $deuda['iva']['m3_excedido_agua'] ?></span></p>
                    <?php endif; ?>
                    <?php if ($deuda['iva']['m3_excedido_drenaje'] > 0): ?>
                        <p class="font-normal text-gray-500 text-sm">IVA Drenaje Excedido: <span>$ <?= $deuda['iva']['m3_excedido_drenaje'] ?></span></p>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-2xl md:text-4xl my-2 text-center">Total: <span class="font-normal text-gray-700 dark:text-gray-300 whitespace-nowrap">$ <?= formatoMiles($deuda['total']) ?> MNX</span></p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-5">
                <button id="btn-selector-periodo" class="w-full md:w-auto bg-slate-800 hover:bg-slate-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white dark:bg-slate-700 dark:hover:bg-slate-600">Seleccionar periodo</button>
                <a href="/pagar-servicio?id=<?= $usuario->id ?>&final=all" class="w-full md:w-auto text-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white">Pagar todo</a>
            </div>
        </div>
        <div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full bg-gray-600 bg-opacity-80 transition-opacity duration-300 ease-in-out opacity-0 hidden" id="selectorPeriodoModal">
            <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto mt-20">
                <form method="GET" action="/pagar-servicio" class="relative w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white" id="formPeriodo">
                    <div class="my-4 flex flex-col space-y-2">
                        <input type="hidden" name="id" value="<?= $usuario->id ?>">
                        <label for="final" class="block text-sm font-bold uppercase text-gray-500 dark:text-gray-300">Mes-Año: </label>
                        <select name="final" id="final" class="bg-gray-200 py-3 px-6 text-sm rounded dark:bg-gray-700 dark:text-whit uppercase">
                            <option value="">--Seleccione un mes--</option>
                            <?php foreach ($meses as $mes): ?>
                                <option value="<?= $mes['id'] ?>"><?= $mes['name'] . ' - $ ' . formatoMiles($mes['totales']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex flex-col-reverse justify-end sm:flex-row items-center gap-4 mt-5">
                        <button type="button" class="w-full md:w-auto text-gray-700 rounded-lg px-4 py-2 text-sm uppercase dark:text-gray-200 tracking-widest" id="btnClosePeriodoModal">Cerrar</button>
                        <input type="submit" value="Consultar" class="w-full md:w-auto bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm uppercase hover:bg-indigo-700 cursor-pointer tracking-widest">
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="w-full">
            <h3 class="text-center text-4xl font-bold uppercase dark:text-gray-300"><?= $deuda['estado'] ?></h3>
            <p class="text-center text-lg dark:text-white"><?= $deuda['msg'] ?></p>
        </div>
    <?php endif; ?>
</div>