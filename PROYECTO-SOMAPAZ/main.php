<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: /index.php");
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3e533b6411.js" crossorigin="anonymous"></script>
    <title>Menu</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css" />
    <link rel="icon" href="/img/icono.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>

        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>

        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>
    <nav class="navbar navbar-expand-lg bg-light-subtle py-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img class="rounded-circle" src="/avatars/<?= $_SESSION["id"] ?>.jpg" alt="User-avatar" width="40" height="40">
            </a>
            <a class="navbar-brand">
                <?= $_SESSION["nombres"] ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION["rol"] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active btn btn-dark" type="button" href="controller/controller_close_session.php">Cerrar sesión</a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown w-25" data-bs-theme="dark">
                        <button class="btn btn-link nav-link py-1 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                            <svg class="bi my-1 theme-icon-active" width="16" height="16" fill="currentColor">
                                <use href="#circle-half"></use>
                            </svg>
                            <span class="d-lg-none ms-2">Tema</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end px-1" aria-labelledby="bd-theme">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                                    <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                                        <use href="#sun-fill"></use>
                                    </svg>
                                    Light
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                    <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                                        <use href="#moon-stars-fill"></use>
                                    </svg>
                                    Dark
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                                    <svg class="bi me-2 opacity-50 theme-icon" width="16" height="16" fill="currentColor">
                                        <use href="#circle-half"></use>
                                    </svg>
                                    Auto
                                </button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="mt-1">
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/users.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Revise informacion detallada sobre los usuarios.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/agreements.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Convenios</h5>
                <p class="card-text">Genere convenios sobre personas deudoras.</p>
                <a href="convenios/php/convenios.php" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/not.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Notificaciones</h5>
                <p class="card-text">Genere notificaciones por suspención de toma.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/cash-register.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Caja</h5>
                <p class="card-text">Cobro de adeudos por servicio de agua.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/report.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Incidencias</h5>
                <p class="card-text">Genere y revise reportes por incidencias.</p>
                <a href="/reports/create_view_reports.php" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/tank.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Tanques</h5>
                <p class="card-text">Monitoreo de nivel y llegada de agua.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/tandeo.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Tandeo</h5>
                <p class="card-text">Control de la distribución de agua de la zona.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
        <div class="card text-center" style="width: 20rem;">
            <img src="/icons/update.png" class="card-img-top w-75 mx-auto" alt="users image">
            <div class="card-body">
                <h5 class="card-title">Actualizaciones</h5>
                <p class="card-text">Cambios de constantes o actualización de datos.</p>
                <a href="#" class="btn btn-primary">Continuar</a>
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="/js/theme.js"></script>

</html>