<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 text-xl text-gray-900 dark:text-white sm:text-4xl mt-10 uppercase text-center">
                <span class="font-black">Usuario:</span> <?= $usuario->user . " " . $usuario->lastname; ?>
            </h2>

            <?php if (date('m') < 3): ?>
                <div class="w-full flex flex-row justify-end">
                    <button class="bg-orange-200 text-orange-800 px-4 py-2 rounded-lg font-black text-xs uppercase hover:bg-orange-300" id="descuento-inicio-year">Descuento por inicio de año</button>
                </div>
            <?php endif; ?>
            <div class="w-full flex flex-row justify-between gap-5 my-5">
                <form action="/caja-cobro" method="GET" autocomplete="off">
                    <input type="text" name="usuario" class="bg-gray-300 dark:bg-gray-700 border dark:border-gray-600 rounded p-2 dark:text-white" placeholder="Ingrese el ID">
                </form>
                <a class="w-full md:w-auto text-center bg-indigo-600 text-white px-6 py-3 rounded font-bold text-sm hover:bg-indigo-700 cursor-pointer uppercase" href="/consultar">Volver</a>
            </div>
            <div class="w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white">
                <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col md:flex-row lg:items-center gap-4 uppercase font-bold">
                        <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?= $usuario->user ?>" alt="Iniciales de <?= $usuario->user ?>" class="rounded-full w-24 h-24 my-4 mx-auto md:mx-0">
                        <div class="space-y-1">
                            <h3 class="text-2xl text-center text-gray-900 dark:text-white">Información del Usuario</h3>
                            <p>Nombre: <span class="font-normal dark:text-gray-300"><?= $usuario->user ?></span></p>
                            <p>Apellidos: <span class="font-normal dark:text-gray-300"><?= $usuario->lastname ?></span></p>
                            <p>ID: <span class="font-normal dark:text-gray-300"><?= $usuario->id ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 font-bold uppercase">
                    <div class="space-y-1">
                        <p>Dirección: <span class="font-normal dark:text-gray-300"><?= $usuario->address ?></span></p>
                        <p>Tipo de Usuario: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoUsuario->name ?></p>
                        <p>Tipo de Toma: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoToma->name . " - " . $usuario->tipoConsumo->name ?></p>
                    </div>
                    <div class="space-y-1">
                        <p>Tipo de Servicio: <span class="font-normal dark:text-gray-300"><?= $usuario->tipoServicio->name ?></span></p>
                        <p>Estado del Servicio: <span class="p-2 rounded text-sm <?= $usuario->estadoServicio->id === "1" ? "bg-green-100 text-green-800" : ($usuario->estadoServicio->id === "2" ? "bg-yellow-100 text-yellow-800" : "bg-red-100 text-red-800") ?>"><?= $usuario->estadoServicio->name ?></span></p>
                        <p>Drenaje: <span class="font-normal dark:text-gray-300"><?= $usuario->drain ? "Con Drenaje" : "Sin Drenaje" ?></span></p>
                    </div>
                </div>
            </div>

            <?php if ($deuda['estado'] === 'debe'): ?>
                <div class="w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800 dark:text-white font-bold">
                    <p class="text-xl md:text-3xl text-center">
                        Periodo: <span class="font-normal uppercase"><?= formatearFechaES($deuda['periodo']['inicio']) ?> -- <?= formatearFechaES($deuda['periodo']['final']) ?></span>
                    </p>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 my-5">
                        <div class="space-y-1">
                            <p>Costo de Agua: <span class="font-normal">$ <?= formatoMiles($deuda['agua_inicial']) ?> MNX</span></p>
                            <?php if ($deuda['m3_excedido_agua'] > 0): ?>
                                <p class="font-normal text-gray-500">Costo de Agua Excedido: <span class="font-normal">$ <?= formatoMiles($deuda['m3_excedido_agua']) ?> MNX</span></p>
                            <?php endif; ?>
                        </div>
                        <div class="space-y-1">
                            <p>Costo de Drenaje: <span class="font-normal">$ <?= formatoMiles($deuda['drenaje_inicial']) ?> MNX</span></p>
                            <?php if ($deuda['m3_excedido_drenaje'] > 0): ?>
                                <p class="font-normal text-gray-500">Costo de Drenaje Excedido: <span class="font-normal">$ <?= formatoMiles($deuda['m3_excedido_drenaje']) ?> MNX</span></p>
                            <?php endif; ?>
                        </div>
                        <div class="space-y-1">
                            <p>Costo de Recargos: <span class="font-normal">$ <?= formatoMiles($deuda['recargos']['total']) ?> MNX</span></p>
                            <p class="font-normal text-gray-500">Recargos Agua: <span class="font-normal">$ <?= $deuda['recargos']['agua'] ?></span></p>
                            <p class="font-normal text-gray-500">Recargos Drenaje: <span class="font-normal">$ <?= $deuda['recargos']['drenaje'] ?></span></p>
                        </div>
                        <div class="space-y-1">
                            <p>Total de Meses: <span class="font-normal"><?= $deuda['meses']['totales'] ?></span></p>
                            <p class="font-normal text-gray-500">Meses Rezagados: <span class="font-normal"><?= $deuda['meses']['rezagados'] ?></span></p>
                            <p class="font-normal text-gray-500">Meses Naturales: <span class="font-normal"><?= $deuda['meses']['naturales'] ?></span></p>
                        </div>
                        <div class="space-y-1">
                            <p>Costo de IVA: <span class="font-normal">$ <?= formatoMiles($deuda['iva']['total']) ?> MNX</span></p>
                            <p class="font-normal text-gray-500">IVA Agua: <span class="font-normal">$ <?= $deuda['iva']['agua'] ?></span></p>
                            <p class="font-normal text-gray-500">IVA Drenaje: <span class="font-normal">$ <?= $deuda['iva']['drenaje'] ?></span></p>
                            <?php if ($deuda['iva']['m3_excedido_agua'] > 0): ?>
                                <p class="font-normal text-gray-500">IVA Drenaje Excedido: <span class="font-normal">$ <?= $deuda['iva']['m3_excedido_agua'] ?></span></p>
                            <?php endif; ?>
                            <?php if ($deuda['iva']['m3_excedido_drenaje'] > 0): ?>
                                <p class="font-normal text-gray-500">IVA Drenaje Excedido: <span class="font-normal">$ <?= $deuda['iva']['m3_excedido_drenaje'] ?></span></p>
                            <?php endif; ?>
                        </div>
                        <p class="text-4xl my-2">Total: <span class="font-normal">$ <?= formatoMiles($deuda['total']) ?> MNX</span></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="w-full bg-white rounded-lg shadow-lg mt-5 p-4 lg:p-8 dark:bg-gray-800">
                    <h3 class="text-center text-4xl font-bold uppercase dark:text-gray-300"><?= $deuda['estado'] ?></h3>
                    <p class="text-center text-lg dark:text-white"><?= $deuda['msg'] ?></p>
                </div>
            <?php endif; ?>

        </div>
    </article>
</section>