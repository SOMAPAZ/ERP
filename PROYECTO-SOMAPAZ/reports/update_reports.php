<?php
session_start();
// Conexión a la base de datos
require("../model/conex.php");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el folio de consultar_hist_rep.php
$folio = $_GET['folio'];

// Consulta SQL para buscar el folio en la tabla
$sql = "SELECT r.folio,
               r.sac,
               r.usuario,
               r.telefono,
               r.beneficiario,
               r.domicilio,
               r.categoria,
               r.incidencia,
               r.prioridad,
               r.emision,
               r.atendio,
               r.responsable,
               r.descripcion,
               r.responsable,
               r.atendio,
               r.superviso,
               r.name_changes,
               r.estado,
               r.cerrado,
               n.time_note,
               (SELECT GROUP_CONCAT(CONCAT('✅', mr.material, ' (', mr.cantidad, ' ', mr.unidad, ')') SEPARATOR '\n') 
                FROM materiales_registro mr 
                WHERE mr.folio = r.folio) AS material_concat
        FROM reportes r
        LEFT JOIN notas_reportes n ON r.folio = n.folio
        WHERE r.folio = '$folio'
        GROUP BY r.folio
        ORDER BY n.time_note ASC -- Ordenar por la primera fecha de notas_reportes
        LIMIT 1";


$result = $conexion->query($sql);

// Almacenar los resultados en un array
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3e533b6411.js" crossorigin="anonymous"></script>
    <title>Actualizaciones</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css" />
    <link rel="icon" href="/img/icono.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/reports.css">
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
                        <a class="nav-link active btn btn-dark" type="button" href="/reports/create_view_reports.php">Regresar a reportes</a>
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
    <div class="container" style="font-family: 'Poppins', sans-serif;">
        <div class="alert alert-dark mt-2 text-center" role="alert">
            <h4 class="text-warning-emphasis">
                Folio: <?= $folio ?>
            </h4>
            <h4>
                <?php foreach ($rows as $row) { ?>
                    Estado: <strong class="text-primary-emphasis"><?= $row["estado"] ?></strong>
                <?php } ?>
            </h4>
        </div>
        <form action="/reports/change-status.php" method="post">
            <input type='text' name='folio' value=<?= $folio ?> readonly hidden>
            <div class="input-group mb-2">
                <select class="form-select bg-primary-subtle text-primary-emphasis" id="inputGroupSelect04" aria-label="Example select with button addon" name="campo_estado">
                    <option selected disabled>Seleccione el nuevo estado</option>
                    <option value="Proceso">En proceso</option>
                    <option value="Cerrado">Cerrado</option>
                    <option value="Terminado">Terminado</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit" name="status">Cambiar</button>
            </div>
        </form>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Información del reporte
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        foreach ($rows as $row) { ?>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Folio</span>
                                <input type="text" class="form-control" placeholder="Folio" aria-describedby="addon-wrapping" value="<?= $row["folio"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Sac</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["sac"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Usuario</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["usuario"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Teléfono</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["telefono"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Beneficiario</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["beneficiario"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Domicilio</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["domicilio"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Categoría</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["categoria"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Incidencia</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["incidencia"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Prioridad</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["prioridad"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Emisión</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["emision"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Registrado por</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["atendio"] ?>" readonly>
                            </div>
                            <div class="input-group flex-nowrap mt-2">
                                <span class="input-group-text custom-input-group-text" id="addon-wrapping">Responsable</span>
                                <input type="text" class="form-control" placeholder="Sin registro" aria-describedby="addon-wrapping" value="<?= $row["responsable"] ?>" readonly>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text custom-input-group-text">Nota</span>
                                <textarea class="form-control" placeholder="Ingrese una breve descripción" readonly><?= $row["descripcion"] ?></textarea>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Crear nota
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-center">
                        <form method='post' action='save-notes.php' enctype='multipart/form-data' id='upload_changes'>
                            <?php foreach ($rows as $row) { ?>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text custom-input-group-text2" id="addon-wrapping">Folio</span>
                                    <input type="text" name="folio" class="form-control" placeholder="Folio" aria-describedby="addon-wrapping" value="<?= $row["folio"] ?>" readonly>
                                </div>
                                <div class="form-group mt-2 pe-auto">
                                    <textarea class="form-control mt-2" id="otherTextarea" placeholder="Escriba su nota" name="notestext"></textarea>
                                </div>
                                <div class="mt-2">
                                    <input class="form-control" type="file" id="formFile" name='nota_img' accept=".jpg" value="<?= (isset($row["nota_img"]) ? $row["nota_img"] : '') ?>">
                                </div>
                                <button type='submit' name='save_notes' class="btn btn-primary mt-2"><i class="fa-solid fa-comment me-1"></i>Guardar</button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Ver notas
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-center">
                        <div class="container" id="notes-cards">
                            <?php include("notes.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        Añadir material
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form autocomplete="off" method="post" action="/reports/material/save_material.php">
                            <div>
                                <input type='text' name='folio' value=<?= $folio ?> readonly hidden>
                                <div class="input-group flex-nowrap mt-2">
                                    <span class="input-group-text custom-input-group-text" id="addon-wrapping">Cantidades</span>
                                    <input type="number" name="cantidad" class="form-control" placeholder="Ingrese cantidad" aria-describedby="addon-wrapping" required>
                                </div>
                                <div class="input-group mt-2">
                                    <label class="input-group-text custom-input-group-text" for="inputGroupSelect01">Unidades</label>
                                    <select class="form-select" id="inputGroupSelectCantidad" name="unidad" required>
                                        <option selected disabled>Seleccione la unidad</option>
                                        <option value="bultos">bultos</option>
                                        <option value="m">m</option>
                                        <option value="m²">m²</option>
                                        <option value="m³">m³</option>
                                        <option value="pz">pz</option>
                                    </select>
                                </div>
                                <div class="input-group flex-nowrap mt-2" id="material_boton">
                                    <span class="input-group-text custom-input-group-text" id="addon-wrapping">Materiales</span>
                                    <input type="text" id="input_material" name="material" class="form-control" placeholder="Coloque el nombre del material ..." aria-describedby="addon-wrapping" required>
                                    <button type="submit" name="send" class="btn btn-outline-secondary" type="button">Añadir<i class="fa-solid fa-plus ms-2"></i></button>
                                </div>
                            </div>
                            <ul class="list bg-secondary-subtle text-secondary-emphasis"></ul>
                        </form>
                        <script src="/reports/material/script.js"></script>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        Edición Final
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method='post' action='/reports/save-changes.php'>
                            <?php
                            foreach ($rows as $row) { ?>
                                <input type='text' name='folio' value=<?= $folio ?> readonly hidden>
                                <div class="input-group flex-nowrap mt-2">
                                    <span class="input-group-text custom-input-group-text" id="addon-wrapping">Supervisó</span>
                                    <input type="text" class="form-control" name="superviso" placeholder="Sin supervisor" aria-describedby="addon-wrapping" value="<?= $row["superviso"] ?>" required>
                                </div>
                                <div class="input-group flex-nowrap mt-2">
                                    <span class="input-group-text custom-input-group-text" id="addon-wrapping">Fecha/aten</span>
                                    <input type="text" class="form-control" name="firstAtention" placeholder="Sin fecha registrada" aria-describedby="addon-wrapping" value="<?= $row["time_note"] ?>" readonly>
                                </div>
                                <div class="input-group flex-nowrap mt-2">
                                    <span class="input-group-text custom-input-group-text" id="addon-wrapping">Cierre</span>
                                    <input type="text" class="form-control" name="closed" placeholder="Sin fecha registrada" aria-describedby="addon-wrapping" value="<?= $row["cerrado"] ?>" readonly>
                                </div>
                                <div class="input-group mt-2">
                                    <textarea class="form-control" name="materiales" placeholder="Sin material registrado" rows="5" readonly><?= $row["material_concat"] ?></textarea>
                                </div>
                            <?php } ?>
                            <div id='botones2' class="mt-3 text-center">
                                <?php
                                if ($row["superviso"] == '') {
                                    echo "<button type='submit' name='save-final' class='btn btn-primary mt-2'><i class='fa-solid fa-upload me-2'></i>Guardar</button>";
                                } else {
                                    echo "<button type='submit' name='save-final' class='btn btn-primary mt-2' disabled><i class='fa-solid fa-upload me-2'></i>Guardar</button>";
                                }
                                ?>
                                <a href='/reportes/php/formatos/pdf2.php?folio=" . $row["folio"] . "' class='btn btn-primary mt-2 disabled'><i class='fa-solid fa-file-pdf'></i>PDF</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="/js/theme.js"></script>
</body>

</html>