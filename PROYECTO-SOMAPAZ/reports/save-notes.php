<?php

session_start();

require("../model/conex.php");

if (isset($_POST['save_notes'])) {

    $folio = trim($_POST['folio']);
    $notes = trim($_POST['notestext']);
    $nota_image_blob = null;

    // Verificar si se ha subido una imagen y no está vacía
    if (isset($_FILES['nota_img']['tmp_name']) && !empty($_FILES['nota_img']['tmp_name'])) {
        $nota_image = $_FILES['nota_img']['tmp_name'];
        $nota_image_blob = addslashes(file_get_contents($nota_image));
    } else {
        // Si no se ha subido una imagen, establecer la imagen por defecto
        $default_image_path = './default.jpg'; // Ruta de la imagen por defecto
        $nota_image_blob = addslashes(file_get_contents($default_image_path));
    }

    // Obtener el nombre de quien inició sesión
    $atendio = isset($_SESSION['nombres']) ? $_SESSION['nombres'] : '';

    // Crear la consulta para insertar la nota en la base de datos
    $consulta = "INSERT INTO notas_reportes(folio, nota, nota_img, time_note, write_note)
                        VALUES ('$folio', '$notes', '$nota_image_blob', NOW() - INTERVAL 6 HOUR, '$atendio')";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Si la inserción fue exitosa, redireccionar a la página de actualización de reportes
        header("Location: update_reports.php?folio=$folio");
    } else {
        // Si ocurrió un error, mostrar un mensaje de error
?>
        <h3 class="error">Ocurrió un error</h3>
<?php
    }
}

?>