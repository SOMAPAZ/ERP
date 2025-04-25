<?php $links[] = 'arqueos';
require_once __DIR__ . '/../templates/nav-bar.php'; ?>
<section class=" py-4 antialiased dark:bg-gray-900 md:py-8 h-auto">

    <article class="mx-auto max-w-screen-lg px-4 2xl:px-0">
        <div class="lg:flex lg:flex-col lg:items-center lg:gap-4">
            <h2 class="shrink-0 font-black text-xl text-gray-900 dark:text-white sm:text-4xl uppercase text-center">
                Corte de caja
            </h2>
        </div>

        <div class="mt-10">
            <p class="text-xs text-center uppercase my-5 font-bold bg-red-100 text-red-800 p-3 rounded">Advertencia: Tenga cuidado con los datos ingresados ya que total entregado y total del sistema no coincidiran completamente por el tipo de moneda, además de que esta acción no se puede deshacer</p>

            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            <form action="/crear-corte" method="POST" class="bg-white shadow rounded p-5 dark:bg-gray-800">
                <p class="font-bold dark:text-white">Sesión Activa: <span class="font-normal"><?= $_SESSION['empleado_name']; ?></span></p>
                <input type="hidden" name="entrega" id="id_empleado" value="<?= $_SESSION['empleado_id']; ?>">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mt-5 w-full">
                        <label for="recibe" class="block mb-1 text-sm uppercase text-gray-700 dark:text-gray-200">Recibe</label>
                        <select name="recibe" id="recibe" class="bg-gray-100 p-2 rounded text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full">
                            <option value="">-- Seleccione un receptor --</option>
                        </select>
                    </div>
                    <div class="mt-5 w-full">
                        <label for="testigo" class="block mb-1 text-sm uppercase text-gray-700 dark:text-gray-200">Testigo</label>
                        <select name="testigo" id="testigo" class="bg-gray-100 p-2 rounded text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full">
                            <option value="">-- Seleccione un administrador --</option>
                            <option value="2">C.P. Arnoldo Felix Xocota</option>
                            <option value="1">Juan Bernardo Amador González</option>
                        </select>
                    </div>
                </div>

                <p class=" text-center uppercase my-5 font-bold text-blue-600 p-3 rounded text-cambios">No hay cantidad de billetes y monedas aún</p>
                <div class="mt-5 w-full grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-0">
                    <div>
                        <label for="1000" class="text-xs font-bold text-gray-600 dark:text-gray-400">1,000.00</label>
                        <input type="number" name="denominacion[1000]" id="1000" data-valor="1000" placeholder="Billetes de 1,000.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="500" class="text-xs font-bold text-gray-600 dark:text-gray-400">500.00</label>
                        <input type="number" name="denominacion[500]" id="500" data-valor="500" placeholder="Billetes de 500.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="200" class="text-xs font-bold text-gray-600 dark:text-gray-400">200.00</label>
                        <input type="number" name="denominacion[200]" id="200" data-valor="200" placeholder="Billetes de 200.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="100" class="text-xs font-bold text-gray-600 dark:text-gray-400">100.00</label>
                        <input type="number" name="denominacion[100]" id="100" data-valor="100" placeholder="Billetes de 100.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="50" class="text-xs font-bold text-gray-600 dark:text-gray-400">50.00</label>
                        <input type="number" name="denominacion[50]" id="50" data-valor="50" placeholder="Billetes de 50.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="20" class="text-xs font-bold text-gray-600 dark:text-gray-400">20.00</label>
                        <input type="number" name="denominacion[20]" id="20" data-valor="20" placeholder="Billetes de 20.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="10" class="text-xs font-bold text-gray-600 dark:text-gray-400">10.00</label>
                        <input type="number" name="denominacion[10]" id="10" data-valor="10" placeholder="Monedas de 10.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="5" class="text-xs font-bold text-gray-600 dark:text-gray-400">5.00</label>
                        <input type="number" name="denominacion[5]" id="5" data-valor="5" placeholder="Monedas de 5.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="2" class="text-xs font-bold text-gray-600 dark:text-gray-400">2.00</label>
                        <input type="number" name="denominacion[2]" id="2" data-valor="2" placeholder="Monedas de 2.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="1" class="text-xs font-bold text-gray-600 dark:text-gray-400">1.00</label>
                        <input type="number" name="denominacion[1]" id="1" data-valor="1" placeholder="Monedas de 1.00" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                    <div>
                        <label for="0.50" class="text-xs font-bold text-gray-600 dark:text-gray-400">0.50</label>
                        <input type="number" name="denominacion[0.5]" id="0.5" data-valor="0.5" placeholder="Monedas de 0.50" class="bg-gray-100 p-2 text-sm border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 w-full input-billetes" min="0">
                    </div>
                </div>

                <div class="mt-5">
                    <p class=" text-gray-800 dark:text-white font-bold text-xl flex justify-between border-b border-dashed border-gray-400 pb-5 flex-col md:flex-row">Total entregado por cajera: <span class="font-normal total-cajera">$ 00.00 M.N.</span></p>
                    <input type="hidden" name="total_efectivo_usuario" id="total_usuario">
                    <p class=" text-gray-800 dark:text-white font-bold text-xl flex justify-between pt-5 flex-col md:flex-row">Total efectivo hasta este corte por sistema: <span class="font-normal total-sistema">$ <?= formatoMiles(round($total_efectivo, 2)) ?> M.N.</span></p>
                    <input type="hidden" name="total_sistema_efectivo" id="total" value="<?= $total_efectivo ?>">
                    <input type="hidden" name="total_sistema" id="total" value="<?= $total ?>">
                </div>
                <div class="w-full flex justify-end border-t border-dashed border-gray-400">
                    <ul class="text-xs flex flex-col items-end text-right dark:text-white">
                        <li>Cheques: <span class="font-normal">$ <?= formatoMiles(round($total_cheques, 2)) ?> M.N.</span></li>
                        <li>Depositos: <span class="font-normal">$ <?= formatoMiles(round($total_depositos, 2)) ?> M.N.</span></li>
                        <li>Transferencias: <span class="font-normal">$ <?= formatoMiles(round($total_transferencias, 2)) ?> M.N.</span></li>
                        <li>TPV: <span class="font-normal">$ <?= formatoMiles(round($total_tpv, 2)) ?> M.N.</span></li>
                        <li class="text-lg font-black">Total: <span class="font-semibold">$ <?= formatoMiles(round($total, 2)) ?> M.N.</span></li>
                    </ul>
                </div>

                <input type="submit" value="Generar Arqueo" class="mt-5 text-center bg-blue-700 w-full py-2 rounded text-white text-sm font-bold hover:bg-indigo-800 cursor-pointer uppercase disabled:opacity-10 disabled:cursor-not-allowed" disabled>

                <p class="text-center text-xs font-semibold mt-5 uppercase dark:text-white">
                    Advertencia: Su sesión será cerrada después de realizar el corte
                </p>
            </form>
        </div>
    </article>

</section>

<?php $scripts = [
    'caja-cobro/sumar-billetes_v2.js'
];
