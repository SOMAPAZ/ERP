<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 text-xl text-gray-900 dark:text-white sm:text-4xl mt-10 uppercase text-center">
                <span class="font-black">Usuario:</span> <?= $usuario->user . " " . $usuario->lastname; ?>
            </h2>

            <?php if (date('m') < 3): ?>
                <div class="w-full flex flex-row justify-end">
                    <button class="bg-orange-200 text-orange-800 px-4 py-2 rounded-lg font-black text-xs uppercase hover:bg-orange-300" id="descuento-inicio-year">Descuento por inicio de año</button>
                </div>
            <?php endif; ?>
            <div class=" w-full flex flex-col sm:flex-row justify-between gap-5 my-5">
                <form action="/caja-cobro" method="GET" autocomplete="off" id="formConsultarSig" class="w-full">
                    <input type="number" name="usuario" class="w-full md:w-72 bg-gray-300 dark:bg-gray-700 border dark:border-gray-600 rounded py-2 px-4 dark:text-white" placeholder="Ingrese el ID">
                </form>
                <a class="w-full md:w-auto flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white" href="/consultar">Volver</a>
            </div>
            <div class="w-full flex flex-col md:flex-row justify-between gap-5 my-5">
                <div class="w-full md:w-1/2 flex flex-col lg:flex-row items-center gap-5 bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white">
                    <div class="w-full lg:w-1/3">
                        <img
                            src="https://api.dicebear.com/6.x/initials/svg?seed=<?= $usuario->user ?>"
                            alt="Iniciales de <?= $usuario->user ?>"
                            class="rounded-full h-36 mx-auto">
                    </div>
                    <div class="w-full lg:w-2/3 flex flex-col font-bold uppercase space-y-4">
                        <div class="space-y-2">
                            <h3 class="text-2xl text-gray-900 dark:text-white font-black text-center">Información del Usuario</h3>
                            <p>Nombre: <span class="font-normal dark:text-gray-300"><?= $usuario->user ?></span></p>
                            <p>Apellidos: <span class="font-normal dark:text-gray-300"><?= $usuario->lastname ?></span></p>
                            <p>ID: <span class="font-normal dark:text-gray-300"><?= $usuario->id ?></span></p>
                        </div>
                        <div class="space-y-2">
                            <p>Dirección: <span class="font-normal dark:text-gray-300"><?= $usuario->address ?></span></p>
                            <p>Tipo de Usuario: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoUsuario->name ?></p>
                            <p>Tipo de Toma: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoToma->name . " - " . $usuario->tipoConsumo->name ?></p>
                        </div>
                        <div class="space-y-2">
                            <p>Tipo de Servicio: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoServicio->name ?></span></p>
                            <p>Estado del Servicio: <span class="p-2 rounded <?= $usuario->estadoServicio->id === "1" ? "bg-green-100 text-green-800" : ($usuario->estadoServicio->id === "2" ? "bg-yellow-100 text-yellow-800" : "bg-red-100 text-red-800") ?>"><?= $usuario->estadoServicio->name ?></span></p>
                            <p>Drenaje: <span class="font-normal dark:text-gray-300"><?= $usuario->drain ? "Con Drenaje" : "Sin Drenaje" ?></span></p>
                        </div>
                    </div>
                </div>

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
                                                <option value="<?= $mes['id'] ?>"><?= $mes['name'] ?></option>
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
                        <div class="w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800">
                            <h3 class="text-center text-4xl font-bold uppercase dark:text-gray-300"><?= $deuda['estado'] ?></h3>
                            <p class="text-center text-lg dark:text-white"><?= $deuda['msg'] ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </article>
</section>