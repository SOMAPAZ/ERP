<form action="/datos-usuarios-crear" autocomplete="off">
    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información del usuario</h3>
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nombre" required>
        </div>
        <div class="w-full">
            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Apellido" required>
        </div>
        <div class="w-full">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
            <input type="number" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 23365946862" required>
        </div>
        <div class="w-full">
            <label for="mail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
            <input type="email" name="mail" id="mail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. email@ejemplo.com" required>
        </div>
        <div class="w-full">
            <label for="rfc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RFC</label>
            <input type="text" name="rfc" id="rfc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. LOMR9202154Z1" required>
        </div>
        <div class="w-full">
            <label for="clave_elector" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clave Elector</label>
            <input type="text" name="clave_elector" id="clave_elector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. LOMR920215MNLRXT03" required>
        </div>
    </div>
    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información de ubicación</h3>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 sm:gap-6 mt-2">
        <div class="w-full">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
            <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Dirección" required>
        </div>
        <div class="w-full">
            <label for="int_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Interior</label>
            <input type="number" name="int_num" id="int_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123" required>
        </div>
        <div class="w-full">
            <label for="ext_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Exterior</label>
            <input type="number" name="ext_num" id="ext_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123">
        </div>
        <div class="w-full">
            <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manzana</label>
            <input type="number" name="block" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123">
        </div>
        <div class="w-full">
            <label for="lat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitud</label>
            <input type="number" name="lat" id="lat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 19.873096164251823">
        </div>
        <div class="w-full">
            <label for="lng" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitud</label>
            <input type="number" name="lng" id="lng" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. -97.58909488698745">
        </div>
        <div>
            <label for="id_colony" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colonia</label>
            <select id="id_colony" name="id_colony" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona una colonia --</option>
                <?php foreach ($colonias as $colonia): ?>
                    <option value="<?= $colonia->id ?>"><?= $colonia->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="id_locality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localidad</label>
            <select id="id_locality" name="id_locality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona una localidad --</option>
            </select>
        </div>
        <div>
            <label for="id_zone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zona</label>
            <select id="id_zone" name="id_zone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona una zona --</option>
            </select>
        </div>
        <div class="sm:col-span-3">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
            <input id="image" name="image" type="file" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
        </div>
        <div class="sm:col-span-4">
            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referencia</label>
            <textarea id="reference" name="reference" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Agregue una referencia"></textarea>
        </div>
    </div>

    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información de servicio</h3>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 sm:gap-6 mt-2">
        <div>
            <label for="id_usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de usuario</label>
            <select id="id_usertype" name="id_usertype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona un tipo--</option>
            </select>
        </div>
        <div>
            <label for="id_intaketype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de toma</label>
            <select id="id_intaketype" name="id_intaketype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona un tipo--</option>
            </select>
        </div>
        <div>
            <label for="id_servicetype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de servicio</label>
            <select id="id_servicetype" name="id_servicetype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona un tipo--</option>
            </select>
        </div>
        <div>
            <label for="id_servicestatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado de servicio</label>
            <select id="id_servicestatus" name="id_servicestatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona un estado--</option>
            </select>
        </div>
        <div>
            <label for="id_consumtype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Consumo</label>
            <select id="id_consumtype" name="id_consumtype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option selected="">--Selecciona un tipo--</option>
            </select>
        </div>
    </div>
    <button type="submit" class="inline-flex bg-indigo-600 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded hover:bg-indigo-800">
        Agregar Usuario
    </button>
</form>