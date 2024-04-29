    <?php
    // Conexión a la base de datos
    require("../../model/conex.php");

    $search = $_GET['search'];

    $sql = "SELECT * FROM info_usuarios WHERE usuario LIKE '%$search%'";
    $result = $conexion->query($sql);

    $materials = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $materials[] = $row;
        }
    }

    $conexion->close();

    echo json_encode($materials);
    ?>