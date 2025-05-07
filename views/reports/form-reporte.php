<div class=" grid gap-6 mb-6 md:grid-cols-2">
    <div class="relative">
        <label for="input-nombre" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Nombre del Usuario</label>
        <input type="text" id="input-nombre" name="name" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['name']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Ingrese el nombre de usuario" value="<?= $reporte->name ?? '' ?>" />
        <ul id="coincidencias-usuario" class="flex flex-col gap-2 mt-2"></ul>
        <?php if (isset($alertas['error']['name'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['name'] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="id_user-input" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">ID User</label>
        <input type="number" id="id_user-input" name="id_user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ingrese el ID" value="<?= $reporte->id_user ?? '' ?>" />
        <ul id="coincidencias-ID" class="flex flex-col gap-2 mt-2"></ul>
    </div>
    <div>
        <label for="direccion" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Dirección</label>
        <input type="text" id="direccion" name="address" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['address']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Ej: La Concordia #42" value="<?= $reporte->address ?? '' ?>" />
        <?php if (isset($alertas['error']['address'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['address'] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="telefono" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Número de Teléfono</label>
        <input type="tel" id="telefono" name="phone" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['phone']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Ej: 123 456 78 90" value="<?= $reporte->phone ?? '' ?>" />
        <?php if (isset($alertas['error']['phone'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['phone'] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="beneficiario" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Beneficiario</label>
        <input type="text" id="beneficiario" name="beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase input-report" placeholder="Ingrese nombre de beneficiario" value="<?= $reporte->beneficiary ?? '' ?>" />
    </div>

</div>
<div class="grid gap-6 md:grid-cols-3">
    <div class="sm:mb-6">
        <label for="categoria" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Categoría</label>
        <select name="id_category" id="categoria" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_category']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
            <option value="">-Seleccione una categoría</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria->id ?>" <?= $reporte->id_category === $categoria->id ? 'selected' : ''; ?>><?= $categoria->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($alertas['error']['id_category'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_category'] ?></p>
        <?php endif; ?>
    </div>
    <div class="sm:mb-6">
        <label for="incidencia" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Incidencia</label>
        <select name="id_incidence" id="incidencia" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_incidence']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
            <option value="">-Seleccione una incidencia</option>
        </select>
        <?php if (isset($alertas['error']['id_incidence'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_incidence'] ?></p>
        <?php endif; ?>
        <input type="hidden" id="incidencia_actual" value="<?= $reporte->id_incidence ?>">
    </div>
    <div class="mb-6">
        <label for="prioridad" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Prioridad</label>
        <select name="id_priority" id="prioridad" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['id_priority']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
            <option value="">-Seleccione la prioridad</option>
            <?php foreach ($prioridades as $prioridad) : ?>
                <option value="<?= $prioridad->id ?>" <?= $reporte->id_priority === $prioridad->id ? 'selected' : ''; ?>><?= $prioridad->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($alertas['error']['id_priority'])) : ?>
            <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['id_priority'] ?></p>
        <?php endif; ?>
    </div>
</div>


<div>
    <label for="descripcion" class="block mb-2 text-sm uppercase font-medium text-gray-900 dark:text-white">Tu descripción</label>
    <textarea id="descripcion" name="description" rows="4" class="bg-gray-50 border text-gray-900 <?= isset($alertas['error']['description']) ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' ?> text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Escribe tu descripción aquí..."><?= $reporte->description ?? '' ?></textarea>
    <?php if (isset($alertas['error']['description'])) : ?>
        <p class="text-xs uppercase bg-red-600 p-2 text-white text-center font-bold rounded mt-2"><?= $alertas['error']['description'] ?></p>
    <?php endif; ?>
</div>