<?php

session_start();

require("../model/conex.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
    $folio = $_POST['folio'];
    $campo = $_POST['campo_estado'];
    $atendio = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : '';

    if ($campo == "Proceso") {
        $update_sql = "UPDATE reportes SET
        estado = '$campo',
        proceso = NOW() - INTERVAL 6 HOUR,
        proceso_name = '$atendio'
        WHERE folio = '$folio'";
    } else if ($campo == "Cerrado") {
        $update_sql = "UPDATE reportes SET
        estado = '$campo',
        cerrado = NOW() - INTERVAL 6 HOUR,
        cerrado_name = '$atendio'
        WHERE folio = '$folio'";
    } else if ($campo == "Terminado") {
        $update_sql = "UPDATE reportes SET
        estado = '$campo',
        terminado = NOW() - INTERVAL 6 HOUR,
        terminado_name = '$atendio'
        WHERE folio = '$folio'";
    }

    // Verificar si $update_sql está definido antes de ejecutar la consulta
    if (isset($update_sql) && !empty($update_sql)) {
        // Ejecutar la actualización
        if ($conexion->query($update_sql) === TRUE) {
            header("Location: update_reports.php?folio=" . $folio);
            exit(); // Terminar el script después de redireccionar
        } else {
            echo "Error al actualizar el registro: " . $conexion->error;
        }
    } else {
        echo "Error: El estado proporcionado no es válido.";
    }
}

// Cerrar la conexión
$conexion->close();
