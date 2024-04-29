    <?php

    require("../../model/conex.php");

    // Verifica si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Obtiene los valores del formulario
        $folio = trim($_POST['folio']);
        $cantidad = trim($_POST['cantidad']);
        if (trim($_POST['unidad']) != "") {
            $unidad = trim($_POST['unidad']);
        } else {
            $unidad = "undf";
        }

        $material = trim($_POST['material']);

        // Prepara la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO materiales_registro (folio, material, cantidad, unidad) 
                VALUES ('$folio', '$material', $cantidad, '$unidad')";

        // Ejecuta la consulta
        if ($conexion->query($sql) === TRUE) {
            header("Location: /reports/update_reports.php?folio=$folio");
        } else {
            echo "Error al guardar los datos: " . $conexion->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
    ?>
