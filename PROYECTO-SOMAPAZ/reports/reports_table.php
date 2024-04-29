<style>
    .form-control-sm {
        max-width: 200px;
    }

    #responsive_length {
        margin-bottom: 5px;
    }

    @media screen and (max-width: 590px) {
        td {
            font-size: 10px;
        }

        #editar_rep {
            font-size: 2em;
        }

        .trace {
            font-size: 9px;
        }
    }
</style>
<div id='tabla-container' style="font-family: 'Poppins', sans-serif;">
    <?php
    require("../model/conex.php");
    
    // Verifica si el usuario tiene una sesión válida
    if (!isset($_SESSION['nombres']) || empty($_SESSION['nombres'])) {
        header("Location: /index.php");
        exit();
    }

    $rolUsuario = $_SESSION['rol'];

    // Definir consultas SQL para cada rol
    $consultasPorRol = [
        'Fontanero' => "SELECT * FROM reportes WHERE estado != 'Cerrado' AND estado != 'Terminado' ORDER BY folio DESC",
        'Campo' => "SELECT * FROM reportes WHERE estado != 'Terminado' AND estado != 'Terminado' ORDER BY folio DESC",
        'Office' => "SELECT * FROM reportes WHERE estado != 'Terminado' ORDER BY folio DESC",
        'Administrador' => "SELECT * FROM reportes ORDER BY folio DESC"
    ];

    // Verificar si el rol del usuario existe en las consultas definidas
    if (array_key_exists($rolUsuario, $consultasPorRol)) {
        $sql = $consultasPorRol[$rolUsuario];
    } else { ?>
        <div class='alert alert-warning text-center mt-2 w-75 mx-auto' role='alert'>
            Acceso no autorizado, por favor vuelva al
            <a href='/main.php' class='alert-link'>menú principal.</a>
        </div>
    <?php exit();
    } ?>

    <?php
    // Realiza la consulta
    $result = $conexion->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
    ?>
        <div class='container bg-body-secondary p-3 rounded mt-2' style='font-size:0.8em;'>
            <table id='responsive' class='table table-striped display nowrap'>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Prioridad</th>
                        <th>Fecha Reg.</th>
                        <th>Usuario</th>
                        <th>Telefono</th>
                        <th>Domicilio</th>
                        <th>Categoria</th>
                        <th>Incidencia</th>
                        <th>Sac</th>
                        <th>Folio</th>
                        <th>Edit</th>
                        <th><i class='fa-solid fa-eye me-2'></i>Trace</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        // Itera sobre los resultados y muestra cada fila
                        while ($row = $result->fetch_assoc()) {
                            $priority_classes = array(
                                "Crítico" => "bg-black text-warning",
                                "Alto" => "bg-danger text-white",
                                "Medio" => "bg-warning text-white",
                                "Bajo" => "bg-success text-white",
                                "default" => ""
                            );

                            $priority = $row["prioridad"];
                            $priority_class = isset($priority_classes[$priority]) ? $priority_classes[$priority] : $priority_classes["default"];

                            $incidence_classes = array(
                                "Suspensión" => "bg-secondary text-white",
                                "Sin servicio" => "bg-primary text-white",
                                "default" => ""
                            );

                            if ($row["prioridad"] == "Crítico") {
                                $prioridadCritica = "<td class='$priority_class'>⚠️ " . $row["prioridad"] . "</td>";
                            } else {
                                $prioridadCritica = "<td class='$priority_class'>" . $row["prioridad"] . "</td>";
                            }

                            // Obtener la clase basada en la incidencia
                            $incidence = $row["incidencia"];
                            $incidence_class = isset($incidence_classes[$incidence]) ? $incidence_classes[$incidence] : $incidence_classes["default"];
                            echo "<td class='$incidence_class'>" . $row["estado"] . "</td>";
                            echo $prioridadCritica;
                            echo "<td>" . $row["emision"] . "</td>";
                            echo "<td>" . wordwrap($row["usuario"], 30, "<br>", true) . "</td>";
                            echo "<td>" . $row["telefono"] . "</td>";
                            echo "<td>" . wordwrap($row["domicilio"], 30, "<br>", true) . "</td>";
                            echo "<td>" . $row["categoria"] . "</td>";
                            echo "<td>" . $row["incidencia"] . "</td>";
                            echo "<td>" . $row["sac"] . "</td>";
                            echo "<td>" . $row["folio"] . "</td>";
                            echo "<td><a href='/reports/update_reports.php?folio=" . $row["folio"] . "' class='link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover'><i class='fa-regular fa-folder-open me-2'></i>Abrir</a></td>";
                            echo "<td>";
                            echo "<p class='trace'>";
                            echo "Reportado por: " . $row["atendio"] . " <br> --> At: " . $row["time_reporte"] . " <br>";

                            if (!empty($row["name_media"])) {
                                echo "Primer nota: " . $row["name_media"] . " <br> --> At: " . $row["time_media"] . " <br>";
                            }
                            if (!empty($row["proceso"])) {
                                echo "Cambio a <strong>En proceso</strong>: " . $row["proceso_name"] . " <br> --> At: " . $row["proceso"] . " <br>";
                            }
                            if (!empty($row["cerrado"])) {
                                echo "Cambio a <strong>Cerrado</strong>: " . $row["cerrado_name"] . " <br> --> At: " . $row["cerrado"] . " <br>";
                            }
                            if (!empty($row["terminado"])) {
                                echo "Cambio a <strong>Terminado</strong>: " . $row["terminado_name"] . " <br> --> At: " . $row["terminado"] . " <br>";
                            }
                            echo "</p></td></tr>";
                        }

                        ?>
                </tbody>
            </table>
        </div>
    <?php } else {
        echo "<div class='alert alert-dark text-center mt-2 w-75 mx-auto' role='alert'>
        No hay reportes registrados
        </div>";
    }
    $conexion->close(); ?>
</div>