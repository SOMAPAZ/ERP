    <?php
    $conexion = new mysqli("localhost", "root", "", "dev2.0");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    ?>