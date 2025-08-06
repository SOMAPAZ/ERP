<?php
$nombreImagen = "build/img/marca-agua.jpg";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones Realizadas</title>
</head>
<style>
    body {
        font-family: Century Gothic;
        font-size: 12pt;
        margin: 40px;
        position: relative;
        z-index: 1;

    }

    .encabezado {
        text-align: right;
        margin-top: 25px;
        margin-bottom: 12px;
        line-height: 0.5;
        font-size: 10pt;
        margin-left: -15px;
    }



    .img-logo {
        width: 125%;
        margin-left: -75px;
        margin-top: -75px;
        position: absolute;
        z-index: 0;
    }

    .contenido {
        font-size: 15px;
        text-indent: 50px;
        text-align: justify;
        font-family: Century Gothic;
    }

    .tabla-bordes {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Century Gothic', sans-serif;
        font-size: 10pt;
        margin-top: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .tabla-bordes th {
        background-color: #00aaff;
        color: white;
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
    }

    .tabla-bordes td {
        background-color: #f9f9f9;
        padding: 8px;
        border: 1px solid #ccc;
        text-align: center;
    }

    .tabla-bordes tr:hover td {
        background-color: #e0f7ff;
    }


    .firma-director {
        text-align: center;
        font-family: Century Gothic;
        font-size: 10pt;
        line-height: 0.5;
        margin-top: 45%;

    }

    .firma-director a {
        text-align: center;
        font-size: 10pt;
        line-height: 1.5;
        font-family: 'Century Gothic', cursive;
        font-style: italic;
    }

    .firma-director span {
        display: block;
        margin: 30px auto 10px;
        width: 35%;
        border-bottom: 1px solid #000;
    }
</style>

<body class="body">
    <div>
        <img src="<?php echo $imagenBase64; ?>" alt="logo" class="img-logo">
    </div>
    <div>

        <div class="encabezado">
            <p> <strong>Zacapoaxtla, Pue. A. <?php echo $fecha; ?>.</strong></p>
        </div>
        <div class="contenido">
            <p>
                Este documento corresponde al reporte de las notificaciones efectuadas del dia <?php echo $fecha; ?>.
            </p>
        </div>
        <div>
            <table class="tabla-bordes">
                <thead>
                    <tr>
                        <th><strong>Id Notificación</strong></th>
                        <th><strong>Id Usuario</strong></th>
                        <th><strong>Deuda</strong></th>
                        <th><strong>Fecha</strong></th>
                        <th><strong>Costo de Notificación</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notificaciones as $noti): ?>
                        <tr>
                            <td><?php echo $noti->idx; ?></td>
                            <td><?php echo $noti->id_user; ?></td>
                            <td>$ <?php echo number_format($noti->total, 2); ?></td>
                            <td><?php echo $noti->fecha_reporte; ?></td>
                            <td>$ <?php echo number_format($noti->costo, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- contenido 2 -->
        <div class="contenido">
            <p>
                Al mismo tiempo se presenta un reporte del personal quien efectuo las notificaciones
            </p>
        </div>
        <div>
            <table class="tabla-bordes">
                <thead>
                    <tr>
                        <th><strong>Empleado</strong></th>
                        <th><strong>Accion</strong></th>
                        <th><strong>Id Notificación</strong></th>
                        <th><strong>Fecha de Creación</strong></th>
                        <th><strong>Comentario General</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registrosnot as $registros): ?>
                        <tr>
                            <td><?php echo $registros->empleado_nombre; ?></td>
                            <td><?php echo $registros->acciones; ?></td>
                            <td><?php echo $registros->folio_seccion; ?></td>
                            <td><?php echo $registros->created_at; ?></td>
                            <td><?php echo $registros->comentario; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
        <div class="firma-director">
            <p>A T E N T A M E N T E</p>
            <a><strong>SOMAPAZ</strong>, no la conduce, solo la produce.</a>
            <br>
            <a>"Por un dulce futuro, ¡cuidemos el agua!"</a>
            <span></span>
            <p><strong>ING. JUAN BERNARDO AMADOR GONZÁLEZ</strong></p>
            <p><strong>DIRECTOR GENERAL DEL SOMAPAZ</strong></p>
        </div>
    </div>
</body>

</html>