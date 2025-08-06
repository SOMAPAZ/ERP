    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información del usuario</h3>
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div>
            <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input
                type="text"
                name="user"
                id="user"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['name']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                placeholder="Nombre"
                value="<?= $usuario->user ?? ''; ?>">
            <?php if (isset($alertas['error']['name'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['name'] ?></p>
            <?php endif; ?>
        </div>
        <div class="w-full">
            <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
            <input
                type="text"
                name="lastname"
                id="lastname"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['lastname']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                placeholder="Apellido"
                value="<?= $usuario->lastname ?? ''; ?>">
            <?php if (isset($alertas['error']['lastname'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['lastname'] ?></p>
            <?php endif; ?>
        </div>
        <div class="w-full">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
            <input type="number" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 23365946862" value="<?= $usuario->phone ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="mail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
            <input type="email" name="mail" id="mail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. email@ejemplo.com" value="<?= $usuario->mail ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="rfc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RFC</label>
            <input type="text" name="rfc" id="rfc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. LOMR9202154Z1" value="<?= $usuario->rfc ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="clave_elector" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clave Elector</label>
            <input type="text" name="clave_elector" id="clave_elector" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. LOMR920215MNLRXT03" value="<?= $usuario->clave_elector ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="id_type_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Persona</label>
            <select id="id_type_person"
                name="id_type_person"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_type_person']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona una tipo --</option>
                <?php foreach ($tipo_persona as $tipo): ?>
                    <option
                        value="<?= $tipo->id ?>" <?= $usuario->id_type_person == $tipo->id ? 'selected' : ''; ?>>
                        <?= $tipo->type ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_type_person'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_type_person'] ?></p>
            <?php endif; ?>
        </div>
    </div>
    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información de ubicación</h3>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 sm:gap-6 mt-2">
        <div class="w-full">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
            <input
                type="text"
                name="address"
                id="address"
                class="bg-gray-50 border <?= isset($alertas['error']['address']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                placeholder="Dirección"
                value="<?= $usuario->address ?? ''; ?>">
            <?php if (isset($alertas['error']['address'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['address'] ?></p>
            <?php endif; ?>
        </div>
        <div class="w-full">
            <label for="int_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Interior</label>
            <input type="text" name="int_num" id="int_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123" min="1" value="<?= $usuario->int_num ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="ext_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Exterior</label>
            <input type="text" name="ext_num" id="ext_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123" min="1" value="<?= $usuario->ext_num ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manzana</label>
            <input type="text" name="block" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 123" min="1" value="<?= $usuario->block ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="lat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitud</label>
            <input type="text" name="lat" id="lat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. 19.873096164251823" value="<?= $usuario->lat ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="lng" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitud</label>
            <input type="text" name="lng" id="lng" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ej. -97.58909488698745" value="<?= $usuario->lng ?? ''; ?>">
        </div>
        <div>
            <label for="id_colony" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colonia</label>
            <select id="id_colony"
                name="id_colony"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_colony']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona una colonia --</option>
                <?php foreach ($colonias as $colonia): ?>
                    <option value="<?= $colonia->id ?>" <?= $usuario->id_colony == $colonia->id ? 'selected' : ''; ?>><?= $colonia->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_colony'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_colony'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="id_locality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localidad</label>
            <select id="id_locality" name="id_locality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona una localidad --</option>
                <?php foreach ($localidades as $localidad): ?>
                    <option value="<?= $localidad->id ?>" <?= $usuario->id_locality == $localidad->id ? 'selected' : ''; ?>><?= $localidad->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="id_zone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zona</label>
            <select
                id="id_zone"
                name="id_zone"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_zone']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona una zona --</option>
                <?php foreach ($zonas as $zona): ?>
                    <option value="<?= $zona->id ?>" <?= $usuario->id_zone == $zona->id ? 'selected' : ''; ?>><?= $zona->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_zone'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_zone'] ?></p>
            <?php endif; ?>
        </div>
        <div class="sm:col-span-3">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágen</label>
            <input id="image" name="image" type="file" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" accept=".jpg, .jpeg, .png" />
        </div>
        <?php if (isset($usuario->image) &&  $usuario->image !== "") : ?>
            <div class="sm:col-span-4 flex flex-col gap-4 justify-center items-center">
                <p class="font-bold text-sm uppercase dark:text-white">Imagen Actual:</p>
                <div class="formulario__imagen">
                    <picture>
                        <img src="image_house_user/<?= $usuario->image ?>" loading="lazy" alt="Foto de casa de <?= $usuario->user . " " . $usuario->lastname ?>" class=" w-full max-h-96 object-cover rounded">
                    </picture>
                </div>
            </div>
        <?php endif; ?>
        <div class="sm:col-span-4">
            <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referencia</label>
            <textarea id="reference" name="reference" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Agregue una referencia"><?= $usuario->reference ?? ''; ?></textarea>
        </div>
    </div>

    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información de servicio</h3>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5 sm:gap-6 mt-2">
        <div>
            <label for="id_usertype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de usuario</label>
            <select id="id_usertype"
                name="id_usertype"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_usertype']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un tipo--</option>
                <?php foreach ($tipo_usuario as $tipo): ?>
                    <option value="<?= $tipo->id ?>" <?= $usuario->id_usertype == $tipo->id ? 'selected' : ''; ?>><?= $tipo->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_usertype'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_usertype'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="id_intaketype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de toma</label>
            <select id="id_intaketype"
                name="id_intaketype"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_intaketype']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un tipo--</option>
                <?php foreach ($tipo_toma as $tipo): ?>
                    <option value="<?= $tipo->id ?>" <?= $usuario->id_intaketype == $tipo->id ? 'selected' : ''; ?>><?= $tipo->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_intaketype'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_intaketype'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="id_servicetype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de servicio</label>
            <select id="id_servicetype"
                name="id_servicetype"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_servicetype']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un tipo--</option>
                <?php foreach ($tipo_servicio as $tipo): ?>
                    <option value="<?= $tipo->id ?>" <?= $usuario->id_servicetype == $tipo->id ? 'selected' : ''; ?>><?= $tipo->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_servicetype'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_servicetype'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="id_servicestatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado de servicio</label>
            <select id="id_servicestatus"
                name="id_servicestatus"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_servicestatus']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un estado--</option>
                <?php foreach ($estado_servicio as $estado): ?>
                    <option value="<?= $estado->id ?>" <?= $usuario->id_servicestatus == $estado->id ? 'selected' : ''; ?>><?= $estado->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_servicestatus'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_servicestatus'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="id_consumtype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Consumo</label>
            <select id="id_consumtype"
                name="id_consumtype"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_consumtype']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un tipo--</option>
                <?php foreach ($tipo_consumo as $tipo): ?>
                    <option value="<?= $tipo->id ?>" <?= $usuario->id_consumtype == $tipo->id ? 'selected' : ''; ?>><?= $tipo->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($alertas['error']['id_consumtype'])) : ?>
                <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_consumtype'] ?></p>
            <?php endif; ?>
        </div>
        <div>
        <label for="id_medidor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Num. Medidor
        </label>
        <div class="flex items-center">
            <input
                type="number"
                name="id_medidor"
                id="id_medidor"
                class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['name']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                placeholder="45851245"
                value="<?= $medidor->medidor ?? ''; ?>"
                disabled>
            <a id="medidor-btn" class="border border-blue-500 bg-blue-100 text-blue-600   space-x-4 rounded-lg block p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 17q.425 0 .713-.288Q13 16.425 13 16q0-.425-.287-.712Q12.425 15 12 15q-.425 0-.712.288Q11 15.575 11 16q0 .425.288.712.287.288.712.288Zm-6 4q-.825 0-1.412-.587Q4 19.825 4 19v-7q0-.825.588-1.413Q5.175 10 6 10h.5V7q0-2.075 1.463-3.538Q9.425 2 11.5 2q2.05 0 3.525 1.462Q16.5 4.925 16.5 7v3H17q.825 0 1.413.587Q19 11.175 19 12v7q0 .825-.587 1.413Q17.825 21 17 21Zm0-2h12v-7H6v7Zm2-9h8V7q0-1.675-1.162-2.838Q13.675 3 12 3q-1.675 0-2.837 1.162Q8 5.325 8 7Z" />
                </svg>
            </a>
        </div>

        <?php if (isset($alertas['error']['name'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2">
                <?= $alertas['error']['name'] ?>
            </p>
        <?php endif; ?>
    </div>
        <div class="mb-4">
        <label for="drain" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-300">¿Tiene drenaje?</label>
        <select id="drain" name="drain" class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white">
            <option value="1" <?= $usuario->drain == 1 ? 'selected' : '' ?>>Sí</option>
            <option value="0" <?= $usuario->drain == 0 ? 'selected' : '' ?>>No</option>
        </select>
    </div>
    </div>
    <h3 class="text-xl font-bold my-4 text-gray-600 dark:text-gray-300">Información extra</h3>
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3 sm:gap-6 mt-2">
        <div class="w-full">
            <label for="id_userStorage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de almacenamiento</label>
            <select id="id_userStorage" name="id_userStorage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="">--Selecciona un tipo--</option>
                <?php foreach ($tipo_almacenamiento as $tipo): ?>
                    <option value="<?= $tipo->id ?>" <?= $usuario->id_userStorage == $tipo->id ? 'selected' : ''; ?>><?= $tipo->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-full">
            <label for="storage_height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacidad de almacenamiento</label>
            <input type="number" name="storage_height" id="storage_height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Capacidad de almacenamiento" min="0" value="<?= $usuario->storage_height ?? ''; ?>">
        </div>
        <div class="w-full">
            <label for="inhabitants" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Habitantes</label>
            <input type="number" name="inhabitants" id="inhabitants" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Habitantes del lugar" min="0" value="<?= $usuario->inhabitants ?? ''; ?>">
        </div>
    </div>
    <?php $scripts = ['usuarios/usermodal.js']; ?>