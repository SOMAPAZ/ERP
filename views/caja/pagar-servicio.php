<section class="py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">
    <article class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 text-xl text-gray-900 dark:text-white sm:text-4xl mt-10 uppercase text-center">
                <span class="font-black">Resumen de pago
            </h2>

            <?php if (date('m') < 3): ?>
                <div class="w-full flex flex-row justify-end">
                    <button class="bg-orange-200 text-orange-800 px-4 py-2 rounded-lg font-black text-xs uppercase hover:bg-orange-300" id="descuento-inicio-year">Descuento por inicio de año</button>
                </div>
            <?php endif; ?>
            <div class="w-full">
                <?php if ($mensaje['tipo'] === 'Exito'): ?>
                    <div class="mt-10">
                        <div class="flex justify-end w-full md:max-w-2xl mx-auto">
                            <a href="/caja-cobro?usuario=<?= $usuario->id ?>" class="w-full md:w-auto text-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white">Volver</a>
                        </div>

                        <form class="w-full md:max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-4 md:p-8 mt-5" id="form-pago">
                            <h3 class="flex flex-row text-center items-center gap-3 text-xl font-medium dark:text-gray-300">
                                Información del Pago
                                <span class="text-xs px-3 py-1 bg-yellow-200 text-yellow-700 rounded-xl border border-yellow-600">
                                    Pendiente
                                </span>
                            </h3>
                            <p class="text-gray-500 text-sm">Detalles del pago</p>
                            <div class="mt-5 space-y-2 p-2 border-b">
                                <h3 class="font-semibold flex flex-row items-center gap-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Información del usuario
                                </h3>
                                <p class="text-gray-500 flex justify-between">
                                    <span>ID Usuario</span>
                                    <span class="font-semibold text-black"><?= $usuario->id ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Tipo</span>
                                    <span class=" uppercase text-black"><?= $usuario->tipoUsuario->name ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between">
                                    <span class="me-4">Usuario</span>
                                    <span class="uppercase text-black text-right"><?= $usuario->user . " " . $usuario->lastname ?></span>
                                </p>
                                <input type="hidden" name="id_user" value="<?= $usuario->id ?>">
                            </div>
                            <div class="space-y-2 p-2 border-b">
                                <h3 class="font-semibold flex flex-row items-center gap-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                    </svg>
                                    Periodo de facturación
                                </h3>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Periodo Incio</span>
                                    <span class=" uppercase text-black"><?= formatearFechaES($deuda['periodo']['inicio']) ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Periodo Final</span>
                                    <span class=" uppercase text-black"><?= formatearFechaES($deuda['periodo']['final']) ?></span>
                                </p>
                                <input type="hidden" name="mes_inicio" value="<?= formatearFecha($deuda['periodo']['inicio']) ?>">
                                <input type="hidden" name="mes_fin" value="<?= formatearFecha($deuda['periodo']['final']) ?>">
                            </div>
                            <div class="space-y-2 p-2 border-b">
                                <h3 class="font-semibold flex flex-row items-center gap-2 ">
                                    <svg class="h-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                                    </svg>
                                    Consumo
                                </h3>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Agua</span>
                                    <span class=" uppercase text-black">$ <?= formatoMiles($deuda['agua_inicial']) ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Drenaje</span>
                                    <span class=" uppercase text-black">$ <?= formatoMiles($deuda['drenaje_inicial']) ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Recargos</span>
                                    <span class=" uppercase text-black">$ <?= formatoMiles($deuda['recargos']['total']) ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>IVA</span>
                                    <span class=" uppercase text-black">$ <?= formatoMiles($deuda['iva']['total']) ?></span>
                                </p>
                                <p class="text-gray-500 flex justify-between gap-3">
                                    <span>Descuento</span>
                                    <span class=" uppercase text-black">$ <?= formatoMiles($deuda['descuentos']['total']) ?></span>
                                </p>
                                <div id="desglose-extras" class="space-y-2">
                                </div>
                                <p class="text-gray-700 flex justify-between gap-3 text-xl font-bold">
                                    <span>Total</span>
                                    <span class=" uppercase text-black font-semibold">
                                        $ <span id="monto-total"><?= formatoMiles($deuda['total']) ?></span>
                                    </span>
                                </p>
                            </div>
                            <div class="border-b p-2">
                                <div class="space-y-2">
                                    <h3 class="font-semibold flex flex-row items-center gap-2 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 text-indigo-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                        Nota
                                    </h3>
                                    <p>No hay nota registrada, <button type="button" class="text-indigo-600 hover:underline font-medium">agregue una</button></p>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="space-y-2">
                                    <label for="tipo_pago" class="block text-sm uppercase font-bold">Método de Pago</label>
                                    <select name="tipo_pago" id="tipo_pago" class="w-full text-sm bg-gray-200 text-gray-700 py-3 px-6 rounded dark:bg-gray-700 dark:text-whit uppercase">
                                        <option class=" text-black" value="">-- Seleccione un método --</option>
                                        <option class=" text-black" value="1">Efectivo</option>
                                        <option class=" text-black" value="3">Cheque</option>
                                        <option class=" text-black" value="2">Depósito</option>
                                        <option class=" text-black" value="4">Transferencia</option>
                                        <option class=" text-black" value="5">T.P.V</option>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" value="Pagar" id="realizar-pago" class="w-full mt-5 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm uppercase hover:bg-indigo-700 cursor-pointer tracking-widest font-semibold">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-5 mt-5">
                                <button
                                    type="button"
                                    class="w-full md:w-auto text-sm uppercase font-semibold hover:text-indigo-600 border py-1 px-3 rounded shadow-lg hover:shadow-indigo-300 hover:border-indigo-600 transition-all duration-300 ease-in-out box-border">
                                    Descuento Subtotal
                                </button>
                                <button
                                    type="button"
                                    class="w-full md:w-auto text-sm uppercase font-semibold hover:text-indigo-600 border py-1 px-3 rounded shadow-lg hover:shadow-indigo-300 hover:border-indigo-600 transition-all duration-300 ease-in-out box-border">
                                    Descuento Recargos
                                </button>
                                <button
                                    type="button"
                                    id="mostrarModalCargosExtras"
                                    class="w-full md:w-auto text-sm uppercase font-semibold hover:text-indigo-600 border py-1 px-3 rounded shadow-lg hover:shadow-indigo-300 hover:border-indigo-600 transition-all duration-300 ease-in-out box-border">
                                    Cargos Adicionales
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php include_once __DIR__ . '/pagarServModal/modalCargosExtras.php'; ?>
                <?php else: ?>
                    <div class="w-full flex flex-col items-center gap-5 my-5">
                        <p class="my-10 px-6 py-2 text-red-700 font-bold text-lg bg-red-200 border-l-4 border-red-500">
                            <?= $mensaje['msg'] ?>
                        </p>
                        <a
                            href="/caja-cobro?usuario=<?= $usuario->id ?>"
                            class="inline w-full md:w-auto text-center bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg text-sm uppercase font-medium tracking-widest text-white">
                            Volver
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </article>
</section>