<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software de gestión | SOMAPAZ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <?= $cdn ?? '' ?>
    <link rel="stylesheet" href="build/css/app.css">
    <!-- <link rel="stylesheet" href="build/css/v1r.css"> -->
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-rubik">
    <?php $login = isset($login) ? $login : false; ?>
    <?php if (!$login): ?>
        
        
        <?php include_once 'templates/sidebar.php'; ?>
        <main class="md:ml-64" id="main-layout">
            <?= $contenido; ?>
        </main>
        <?php else: ?>
            <?= $contenido; ?>
            <?php endif; ?>
            
            <?php if (!isset($reporte) && $login): ?>
                <footer class="fixed bottom-0 w-full text-center text-sm font-semibold text-neutral-base uppercase">
                    <p>Todos los derechos reservados &copy; <?= date('Y') ?></p>
                </footer>
                <?php endif; ?>
                
    <script src="build/js/menu.js"></script>
    <script src="build/js/darkMode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $src ?? '' ?>
    <?php if (isset($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <script src="build/js/<?= $script ?>" type="module"></script>
        <?php endforeach; ?>
    <?php endif; ?>
            
</body>

</html>