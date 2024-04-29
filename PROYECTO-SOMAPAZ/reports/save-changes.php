<?php

session_start();

require("../model/conex.php");

if (isset($_POST['save-final'])) {
    // Obtener los datos del formulario
    $folio = trim($_POST['folio']);
    $atendio = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : '';
    $superviso = $_POST['superviso'];
    $atencionf = $_POST['firstAtention'];
    $cierref = $_POST['closed'];
    $materiales = $_POST['materiales'];

    // Sentencia SQL para actualizar los datos
    $update_sql = "UPDATE reportes SET
        superviso = '$superviso',
        atencionf = '$atencionf',
        cierref = '$cierref',
        materiales = '$materiales',
        name_changes = '$atendio',
        time_changes = NOW() - INTERVAL 6 HOUR
        WHERE folio = '$folio'";

    // Ejecutar la actualización
    if ($conexion->query($update_sql) === TRUE) {
        // Redirigir a update_report.php si se presiona 'guardar_segunda_parte'
        header("Location: update_reports.php?folio=$folio");
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

$conexion->close();
