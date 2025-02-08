<?php foreach ($alertas as $key => $alerta) :
    foreach ($alerta as $mensaje) :
        if ($key === 'error') : ?>
            <div class="alert rounded p-4 mb-4 text-red-800 border-l-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800">
                <p class="text-sm font-bold text-red-500 uppercase"><?= $mensaje ?></p>
            </div>
        <?php else : ?>
            <div class="alert rounded p-4 mb-4 text-green-800 border-l-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800 uppercase">
                <p class="text-sm font-bold"><?= $mensaje ?></p>
            </div>
<?php endif;
    endforeach;
endforeach; ?>