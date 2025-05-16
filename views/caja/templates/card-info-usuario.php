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
            <p>Estado del Servicio: <span class="py-1 px-3 rounded <?= $usuario->estadoServicio->id === "1" ? "bg-green-200 text-green-800" : ($usuario->estadoServicio->id === "2" ? "bg-yellow-200 text-yellow-800" : "bg-red-200 text-red-800") ?>"><?= $usuario->estadoServicio->name ?></span></p>
            <p>Drenaje: <span class="font-normal dark:text-gray-300"><?= $usuario->drain ? "Con Drenaje" : "Sin Drenaje" ?></span></p>
        </div>
    </div>
</div>