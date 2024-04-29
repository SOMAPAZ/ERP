<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3e533b6411.js" crossorigin="anonymous"></script>
    <title>Incidencias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css" />
    <link rel="icon" href="/img/icono.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css'>
    <style>
        .custom-input-group-text {
            width: 40px;
            font-size: 0.8em;
        }

        .list-items {
            padding: 5px 5px;
            font-size: 0.8em;
            list-style: none;
        }

        .list-items:hover {
            color: #1465bb;
            font-weight: bold;
            font-size: 1em;
        }
    </style>
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
                        <a class="nav-link active btn btn-dark" type="button" href="/main.php">Menú principal</a>
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
    <main>
        <!-- Button trigger modal -->
        <div class="container text-center mt-2 w-50">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="new-report">
                Generar reporte
            </button>
        </div>

        <!-- Modal -->
        <div class="modal-body">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo reporte</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" autocomplete="off">
                                <div class="input-group mb-3">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-file-invoice"></i></span>
                                    <input type="text" name="sac" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Sac" id="sac" oninput="buscar_sac();">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="usuario" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Usuario" id="usuario" onblur="buscar_usuario();">
                                </div>
                                <ul class="list bg-body-secondary"></ul>
                                <div class="input-group mb-3">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" name="domicilio" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Dirección" id="domicilio">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" name="telefono" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Teléfono" id="telefono">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text custom-input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-user-group"></i></span>
                                    <input type="text" name="beneficiario" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Beneficiario" id="beneficiario">
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text custom-input-group-text" for="inputGroupSelect"><i class="fa-solid fa-layer-group"></i></label>
                                    <select class="form-select" id="inputGroupSelect" onchange="cargarSubcategorias()" name="categoria">
                                        <option selected disabled>Categoría</option>
                                        <option value="Agua">Agua</option>
                                        <option value="Drenaje">Drenaje</option>
                                        <option value="ViasPublicas">Vías Públicas</option>
                                        <option value="Visitas">Visitas</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3" id="incidencias">
                                    <label class="input-group-text custom-input-group-text" for="inputGroupSelect01"><i class="fa-solid fa-circle-exclamation"></i></label>
                                    <select class="form-select" id="inputGroupSelect01" name="incidencia">
                                        <script src="/js/options.js"></script>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text custom-input-group-text" for="inputGroupSelect02"><i class="fa-solid fa-turn-up"></i></label>
                                    <select class="form-select" id="inputGroupSelect02" name="prioridad">
                                        <option selected disabled>Prioridad</option>
                                        <option value="Bajo">Bajo</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Alto">Alto</option>
                                        <option value="Crítico">Crítico</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text custom-input-group-text"><i class="fa-solid fa-pen"></i></span>
                                    <textarea name="descripcion" class="form-control" placeholder="Ingrese una breve descripción"></textarea>
                                </div>
                                <div class="d-grid gap-2 mt-2">
                                    <input class="btn btn-primary" type="submit" value="Levantar reporte" name="send">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php include "reports_table.php"; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
    <script src='https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js'></script>
    <script src="/js/theme.js"></script>
    <script src="/js/responsive-table-button.js"></script>
    <script src="/js/autobusquedaSac.js"></script>
    <script src="/js/autobusquedaUsuario.js"></script>
    <script src="/js/data-consult.js"></script>
</body>

</html>

<?php
require("../model/conex.php");

if (isset($_POST['send'])) {
    // Validar si los campos necesarios están presentes y no están vacíos
    $required_fields = ['categoria', 'incidencia', 'prioridad', 'descripcion'];

    $fields_present = true;
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || strlen(trim($_POST[$field])) < 1) {
            $fields_present = false; // Cambiado de true a false
            break;
        }
    }

    if ($fields_present) {
        // Ahora podemos acceder a los valores de 'categoria' y 'prioridad' de manera segura
        $verfPrioridad = trim($_POST['prioridad']);
        $verfCategoria = trim($_POST['categoria']);

        // Obtener el año actual
        $anno_actual = date("ym");

        // Consultar el último número de folio para el año actual
        $consultaUltimoFolio = "SELECT MAX(CAST(SUBSTRING(folio, 6) AS UNSIGNED)) AS ultimo_numero FROM reportes WHERE folio LIKE '$anno_actual%'";
        $resultadoUltimoFolio = mysqli_query($conexion, $consultaUltimoFolio);
        $filaUltimoFolio = mysqli_fetch_assoc($resultadoUltimoFolio);
        $ultimo_numero = $filaUltimoFolio['ultimo_numero'];

        // Incrementar el número y completar con ceros a la izquierda
        $nuevo_numero = str_pad($ultimo_numero + 1, 4, '0', STR_PAD_LEFT);

        // Construir el nuevo valor de folio
        $folio = $anno_actual . "-" . $nuevo_numero;

        // Verificar si el folio ya existe en la base de datos
        $consultaExistencia = "SELECT * FROM reportes WHERE folio = '$anno_actual-$nuevo_numero'";
        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

        if (mysqli_num_rows($resultadoExistencia) > 0) {
            $_SESSION['error'] = "Folio duplicado: $folio";
        } else {
            // Continuar con el resto de la lógica de inserción en la base de datos
            $sac = trim($_POST['sac']);
            $usuario = trim($_POST['usuario']);
            $domicilio = trim($_POST['domicilio']);
            $telefono = trim($_POST['telefono']);
            $beneficiario = trim($_POST['beneficiario']);
            $categoria = trim($_POST['categoria']);
            $incidencia = trim($_POST['incidencia']);
            $prioridad = trim($_POST['prioridad']);
            $atendio = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : ''; // nombre de quien inicio sesion
            $descripcion = trim($_POST['descripcion']);
            $estado = "Abierto";

            $consultar = "INSERT INTO reportes(folio, sac, usuario, telefono, beneficiario, domicilio, categoria, incidencia, prioridad, emision, atendio, descripcion, estado, time_reporte)
                                    VALUES ('$folio', '$sac', '$usuario','$telefono', '$beneficiario', '$domicilio', '$categoria', '$incidencia', '$prioridad',  NOW() - INTERVAL 6 HOUR, '$atendio', '$descripcion', '$estado', NOW() - INTERVAL 6 HOUR)";

            $resultado = mysqli_query($conexion, $consultar);

            if (!$resultado) {
                $_SESSION['error'] = "Ocurrió un error al guardar el reporte.";
            } else {
                echo "<div class='modal fade' id='staticBackdropS' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Reporte guardado exitosamente</h5>
                                    </div>
                                    <div class='modal-body d-flex justify-content-center' id='modalContent'>
                                            <div class='list-group'>
                                                <button type='button' class='list-group-item list-group-item-action active' aria-current='true'>
                                                    Folio: $folio
                                                </button>
                                                <button type='button' class='list-group-item list-group-item-action'>Usuario: $usuario</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Dirección: $domicilio</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Teléfono: $telefono</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Categoría: $categoria</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Incidencia: $incidencia</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Prioridad: $prioridad</button>
                                                <button type='button' class='list-group-item list-group-item-action'>Descripción: $descripcion</button>
                                            </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <a href='/reports/create_view_reports.php' class='btn btn-primary'>Listo!</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                echo "<script>
                        var myModal = new bootstrap.Modal(document.getElementById('staticBackdropS'), {
                            keyboard: false
                        });
                        myModal.show();
                    </script>";
                exit();
            }
        }
    } else {
        // Manejar el caso donde los datos no están presentes o son vacíos
        echo "<div class='modal fade' id='staticBackdropE' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Valores faltantes</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Por favor seleccione los parámetros requeridos.
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>";
        echo "<script>
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdropE'), {
        keyboard: false
    });
    myModal.show();
</script>";
    }
    exit();
}

