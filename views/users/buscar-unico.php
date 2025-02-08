<?php require_once __DIR__ . '/../templates/nav-bar.php'; ?>

<main class="container mx-auto px-10 mt-10 dark:text-dark-font">

    <?php foreach ($datos as $dato): ?>
        <h1 class="text-center font-black text-4xl mb-5 uppercase">Información de:
            <span class="font-medium">
                <?= $dato->nombre ?>
            </span>
        </h1>
    <?php endforeach; ?>
    <section class="mx-auto w-full relative flex flex-col bg-clip-border bg-background-light rounded-md shadow-md mb-5 p-4 md:px-10 uppercase font-black dark:bg-dark-bg-container">
        <?php foreach ($datos as $dato): ?>
            <div class="mb-4 flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <img src="build/img/user-cash.svg" alt="user-icon" class="w-16 h-16 p-0">
                    <div>
                        <p class="block text-xl leading-normal  mb-1 ">
                            <?= $dato->nombre ?>
                        </p>
                        <p class="block text-sm font-semibold">
                            <span class="font-extrabold">Id usuario: </span>
                            <?= $dato->id ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Dirección:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->direccion ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Colonia:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->colonia === "" ? 'Sin información.' : $dato->colonia ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Localidad:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->localidad === "" ? 'Sin información.' : $dato->localidad ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Zona:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->zona === "" ? 'Sin información.' : $dato->zona ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Email:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->correo === "" ? 'Sin información.' : $dato->correo ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Teléfono:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->telefono === "0" ? 'Sin información.' : $dato->telefono ?>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Clave Elector:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->clave === "" ? 'Sin información.' : $dato->clave ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            RFC:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->rfc === "" ? 'Sin información.' : $dato->rfc ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Estado del servicio:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->estado_servicio === "" ? 'Sin información.' : $dato->estado_servicio ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Tipo de servicio:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->tipo_servicio === "" ? 'Sin información.' : $dato->tipo_servicio ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Tipo de usuario:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->tipo_usuario === "" ? 'Sin información.' : $dato->tipo_usuario ?>
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row mb-2 md:gap-2 md:mb-1">
                        <p class="block font-black md:mb-2">
                            Tipo de toma:
                        </p>
                        <p class="font-semibold ">
                            <?= $dato->toma_consumo === "" ? 'Sin información.' : $dato->toma_consumo ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="mx-auto w-full relative flex flex-col bg-clip-border bg-background-light rounded-md shadow-md mb-5 p-4 md:px-10 uppercase font-black dark:bg-dark-bg-container">

        <h2 class="block text-2xl leading-normal  mb-1 text-center">
            Beneficiarios
        </h2>
        <table class="w-full mx-auto text-sm">
            <thead class="text-primary-dark font-black dark:text-dark-font">
                <tr class="whitespace-nowrap border-b-2 border-secondary-light">
                    <th class="px-6 py-2" scope="col">
                        <div class="flex flex-row gap-2 items-center cursor-pointer">
                            Nombre
                        </div>
                    </th>
                    <th class="px-6 py-2" scope="col">
                        <div class="flex flex-row gap-2 items-center cursor-pointer">
                            Teléfono
                        </div>
                    </th>
                    <th class="px-6 py-2" scope="col">
                        <div class="flex flex-row gap-2 items-center cursor-pointer">
                            Correo
                        </div>
                    </th>
                    <th class="px-6 py-2" scope="col">
                        <div class="flex flex-row gap-2 items-center cursor-pointer">
                            Relación
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="font-semibold text-xs">
                <?php if ($vacio): ?>
                    <tr class="animate-pulse">
                        <td colspan="7" class="text-center py-10 text-gray-500 dark:text-gray-400 text-lg">Sin beneficiarios registrados...</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($beneficiarios as $beneficiario): ?>
                        <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                            <td class="py-2 px-6 font-bold"><?= $beneficiario->name . " " . $beneficiario->lastname  ?></td>
                            <td class="py-2 px-6"><?= $beneficiario->phone ?></td>
                            <td class="py-2 px-6"><?= $beneficiario->email ?></td>
                            <td class="py-2 px-6"><?= $beneficiario->relationship ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </section>

    <div class="grid md:grid-cols-2 gap-4">
        <section class="relative w-full overflow-x-auto mx-auto bg-background-light rounded-md shadow-md py-4 px-10 text-left font-extrabold uppercase dark:bg-dark-bg-container">
            <h2 class="block text-xl leading-normal mb-1">
                Pagos
            </h2>
            <table class="w-full mx-auto text-sm">
                <thead class="text-primary-dark font-black dark:text-dark-font">
                    <tr class="whitespace-nowrap border-b-2 border-secondary-light">
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Folio
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Fecha Pago
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Cantidad
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Acceder
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="font-semibold text-xs">
                    <?php foreach ($facturas as $factura): ?>
                        <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                            <td class="py-2 px-6 font-bold"><?= $factura->folio ?></td>
                            <td class="py-2 px-6"><?= $factura->date_invoice ?></td>
                            <td class="py-2 px-6">$ <?= $factura->amount ?></td>
                            <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <section class="relative w-full overflow-x-auto mx-auto bg-background-light rounded-md shadow-md py-4 px-10 text-left font-extrabold uppercase dark:bg-dark-bg-container">
            <h2 class="block text-xl leading-normal  mb-1 ">
                Reportes
            </h2>
            <table class="w-full mx-auto text-sm">
                <thead class="text-primary-dark font-black dark:text-dark-font">
                    <tr class="whitespace-nowrap border-b-2 border-secondary-light">
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Folio
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Categoría
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Incidencia
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Acceder
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="font-semibold text-xs">
                    <?php foreach ($reportes as $reporte): ?>
                        <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                            <td class="py-2 px-6 font-bold"><?= $reporte->folio ?></td>
                            <td class="py-2 px-6"><?= $reporte->categoria ?></td>
                            <td class="py-2 px-6"><?= $reporte->incidencia ?></td>
                            <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
        <section class="relative w-full overflow-x-auto mx-auto bg-background-light rounded-md shadow-md py-4 px-10 text-left font-extrabold uppercase dark:bg-dark-bg-container">
            <h2 class="block text-xl leading-normal  mb-1 ">
                Notificaciones
            </h2>
            <table class="w-full mx-auto text-sm">
                <thead class="text-primary-dark font-black dark:text-dark-font">
                    <tr class="whitespace-nowrap border-b-2 border-secondary-light">
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Folio
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Tipo entrega
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Observación
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Acceder
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="font-semibold text-xs">
                    <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                        <td class="py-2 px-6 font-bold">NOT-OF-202411</td>
                        <td class="py-2 px-6">No entregada</td>
                        <td class="py-2 px-6">Usuario hostil</td>
                        <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                    </tr>
                    <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                        <td class="py-2 px-6 font-bold">NOT-OF-202411</td>
                        <td class="py-2 px-6">Personal</td>
                        <td class="py-2 px-6">Ninguna</td>
                        <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                    </tr>
                    <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                        <td class="py-2 px-6 font-bold">NOT-OF-202411</td>
                        <td class="py-2 px-6">Domiciliaria</td>
                        <td class="py-2 px-6">Deshabitado</td>
                        <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                    </tr>
                    <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                        <td class="py-2 px-6 font-bold">NOT-OF-202411</td>
                        <td class="py-2 px-6">No entregada</td>
                        <td class="py-2 px-6">Titular sin localizar</td>
                        <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="relative w-full overflow-x-auto mx-auto bg-background-light rounded-md shadow-md py-4 px-10 text-left font-extrabold uppercase dark:bg-dark-bg-container">
            <h2 class="block text-xl leading-normal  mb-1 ">
                Convenios
            </h2>
            <table class="w-full mx-auto text-sm">
                <thead class="text-primary-dark font-black dark:text-dark-font">
                    <tr class="whitespace-nowrap border-b-2 border-secondary-light">
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Folio
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Periodo
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Monto
                            </div>
                        </th>
                        <th class="px-6 py-2" scope="col">
                            <div class="flex flex-row gap-2 items-center cursor-pointer">
                                <img src="build/img/filer_icon.svg" alt="icon filter" class="w-4 h-4">
                                Acceder
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="font-semibold text-xs">
                    <?php foreach ($convenios as $convenio): ?>
                        <tr class="whitespace-nowrap font-medium border-b border-neutral-light">
                            <td class="py-2 px-6 font-bold"><?= $convenio->foliate ?></td>
                            <td class="py-2 px-6"><?= $convenio->period_init . " → " . $convenio->period_end ?></td>
                            <td class="py-2 px-6">$ <?= $convenio->debt ?></td>
                            <td class="py-2 px-6 text-center"><a href="#" class="block bg-primary-dark rounded-full py-1 px-2 text-font-light hover:saturate-50 hover:translate-x-6 ease-in-out delay-150 duration-300 dark:saturate-50">Ver más</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>