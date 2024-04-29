    <?php

    require("../../model/conex.php");

    if ($conexion->connect_errno) {
        echo "Nuestro sitio experimenta fallos....";
        exit();
    };

    if (isset($_POST['buscar'])) {

        $sac = $_POST['sac']; // Obtiene el valor de 'sac' del formulario POST.
        $valores = array(); // Inicializa un arreglo para almacenar los resultados.
        $valores['existe'] = "0";  // Inicialmente, no existe el usuario.

        // Realiza la consulta a la base de datos.
        $resultados = mysqli_query($conexion, "SELECT * FROM info_usuarios WHERE sac = '$sac'");

        while ($consulta = mysqli_fetch_array($resultados)) {       // Recorre los resultados y los agrega al arreglo.
            $valores['existe'] = "1";  // Cambia a 1 si encuentra el usuario.
            $valores['usuario'] = $consulta['usuario'];
            $valores['calle'] = $consulta['calle'];
            $valores['telefono'] = $consulta['telefono'];
            $valores['beneficiario_1'] = $consulta['beneficiario_1'];
        }

        // Convierte el arreglo a formato JSON.
        $valores = json_encode($valores);

        // Imprime el JSON para que pueda ser procesado por JavaScript
        echo $valores;
    }

    ?>