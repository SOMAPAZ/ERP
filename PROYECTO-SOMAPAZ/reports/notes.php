<?php

require("../model/conex.php");

$folio = $_GET['folio'];
$sql = "SELECT * FROM notas_reportes WHERE folio = '$folio'";

// Realiza la consulta
$result = $conexion->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <div class="card" style="width: 12rem; font-size: 0.8em;">
            <img src="data:image/jpg;base64,<?php echo base64_encode($row["nota_img"]); ?>" class="card-img-top" alt="Sin imagen">
            <div class="card-body">
                <p class="card-text"><?php echo $row["nota"]; ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $row["time_note"]; ?></li>
                <li class="list-group-item"><?php echo $row["write_note"]; ?></li>
            </ul>
        </div>
    <?php }
} else { ?>
    <div class="alert alert-info" role="alert">
        No hay notas registradas
    </div>
<?php }

$conexion->close(); ?>