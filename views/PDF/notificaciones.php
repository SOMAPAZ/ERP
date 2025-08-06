<?php
$nombreImagen = "build/img/marca-agua.jpg";
$imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación</title>
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

        .info-usuario p {
            text-transform: uppercase;
        }

        .img-logo {
            width: 125%;
            margin-left: -75px;
            margin-top: -75px;
            position: absolute;
            z-index: 0;
        }

        .img-logo_copia {
            width: 125%;
            margin-left: -75px;
            margin-top: 250px;
            position: absolute;
            z-index: 0;
        }

        .info-usuario {
            font-size: 12px;
        }

        .contenido {
            font-size: 15px;
            text-indent: 50px;
            text-align: justify;
            font-family: Century Gothic;
        }



        .tabla-bordes {
            border: 2px solid skyblue;
            border-collapse: separate;
            border-spacing: 5px;
            width: 100%;
            font-size: 10px;
            text-align: center;
            font-weight: bold;

        }

        .tabla-bordes th,
        .tabla-bordes td {
            border: 2px solid skyblue;
            padding: 8px;
            text-align: center;
        }

        .tabla-bordes th {
            border-top: 2px solid skyblue;
            border-bottom: 2px solid skyblue;
        }

        .tabla-bordes td {
            border-top: 2px solid skyblue;
            border-bottom: 2px solid skyblue;

        }

        .firma-director {
            text-align: center;
            font-family: Century Gothic;
            font-size: 10pt;
            line-height: 0.5;
            margin-top: 50px;

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

        .entregado-por {
            text-align: center;
            font-family: Century Gothic;
            margin-right: 65%;
            margin-top: 30px;
            line-height: 0.5;

        }

        .entregado-por p {

            font-family: Century Gothic;
            font-size: 10px;
            text-transform: uppercase;
        }



        .firma-usuario {
            text-align: right;
            position: relative;
            margin-top: -40px;
            margin-right: 40px;

        }

        .firma-usuario span {
            text-align: center;
            display: inline-block;
            width: 150px;
            border-bottom: 0.5px solid #000;
            margin-right: -150px;
        }


        .firma-usuario p {
            text-align: right;
            font-weight: bold;
            margin-left: 40px;
            margin-top: 10px;
        }

        .firma-usuario .nombre {
            margin-top: -10px;
            margin-right: 80px;
        }



        .folio {
            text-align: right;
            font-family: Century Gothic;
            font-size: 12px;
            margin-right: 5px;
            margin-top: -10px;
        }

        .pagos-transferencia {
            width: 20%;
            border-collapse: collapse;
            font-size: 8px;
            margin-left: -50px;
            margin-top: -200px;
        }

        .pagos-transferencia th,
        .pagos-transferencia td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
        }

        .pagos-transferencia thead tr th {
            background-color: #0000FF;
            color: #ffffff;
            text-align: center;
            width: 100%;
        }



        .pagos-transferencia .titulo-transferencia {
            background-color: #339fff;
            color: black;
            text-align: center;
            font-weight: bold;
            padding: 15px 0;
            width: 100%;
        }

        .pagos-transferencia tbody tr td {
            border-top: 1px solid #000;
        }
    </style>
</head>

<body class="body">

    <div>
        <div>

            <img src="<?php echo $imagenBase64; ?>" alt="logo" class="img-logo">
        </div>
        <div class="encabezado">
            <p> <strong>Zacapoaxtla, Pue. A <?php echo $fecha ?>.</strong></p>
            <p><strong>ASUNTO:</strong> Notificación Única por adeudo</p>
            <p> de agua potable y/o drenaje.</p>
        </div>
        <!-- datos de usuario -->
        <div class="info-usuario">
            <p><strong>
                    C. <?php echo $usuario->user ?> <?php echo $usuario->lastname ?><br>
                    Dirección: <?php echo $usuario->address ?><br>
                    N.° de SIAC: <?= $idUsuario ?><br>
                    ESTIMADO USUARIO
                </strong>
            </p>
        </div>
        <!-- contenido -->
        <div class="contenido">
            <p>
                El SOMAPAZ, con base a lo señalado por los artículos 1, 2 fracción II, IV y V, artículo 3 inciso B del Decreto de Creación del Sistema Operador de Agua Potable y Alcantarillado del Municipio de Zacapoaxtla; así como; artículos 1, 10 fracción III, 23 fracción VII y IX, 99 fracción I de la Ley del Agua para el Estado de Puebla tiene la responsabilidad de prestar servicios de Agua Potable y Alcantarillado. Ello implica que los usuarios como es su caso, que reciben los servicios, tienen la obligación de pagarlos. Adeudo que a continuación se detalla:
            </p>
        </div>
        <!-- tabla -->
        <div>
            <table class="tabla-bordes">
                <thead>
                    <tr>
                        <th><strong>PERIODO COMPRENDIDO</strong></th>
                        <th><strong>IMPORTE:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $rangoFechas; ?></td>

                        <td><strong><?= '$' . number_format($total_suma, 2) ?></strong></td>

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- contenido 2 -->
        <div class="contenido">
            El SOMAPAZ pone a su disposición la viabilidad de solicitar un convenio de pago a plazos derivado de su rezago, el cual puede solicitar al momento de recibir esta notificación en las oficinas centrales. En caso de hacer caso omiso a la presente notificación en un <strong>término de 5 días hábiles</strong> se le comunica que el sistema operador cuenta con las facultades suficientes para reducirle el servicio del agua potable, con base al artículo Segundo fracción IV y V del decreto de creación del Organismo Operador aprobado por el H. Congreso del Estado de Puebla, al artículo 99, fracción 1 de la Ley de Agua para el Estado de Puebla, y por acuerdos tomados por el Consejo de Administración. Así mismo, le comunico que una vez hecha la reducción de suministro a su toma de agua y posteriormente solicite se le reinstale, tendrá que liquidar su adeudo más recargos y todos los gastos que se hayan originado con motivo de la reducción del servicio y por la reinstalación.
        </div>
        <br>
        <div class="contenido">
            Cabe hacer mención que el pago por el consumo de agua es para <strong>dar Mantenimiento tanto a la línea de conducción como a la red de distribución y así brindarle a usted un buen servicio.</strong>
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

        <div class="firma-usuario">
            <p class="nombre"><span></span></p>
            <p><strong>Recibio</strong></p>
            <p class="nombre">C. <span></span></p>
        </div>

        <div class="folio">
            <p><strong>FOLIO</strong>: <?php echo $folio; ?></p>
        </div>
        <div class="entregado-por">
            <span></span>
            <p><strong>Entregado por:</strong></p>
            <p><?php echo $empleadoNombre; ?></p>
        </div>
        <div>
            <table class="pagos-transferencia">
                <thead>
                    <tr>
                        <th class="titulo-transferencia" colspan="2">
                            <strong>PAGOS POR TRANSFERENCIA (BBVA BANCOMER)</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NO CUENTA:</td>
                        <td>0450061786</td>
                    </tr>
                    <tr>
                        <td>CLABE INTERBANCARIA:</td>
                        <td>012650004500617861</td>
                    </tr>
                    <tr>
                        <td>ENVIAR COMPROBANTE AL CELULAR:</td>
                        <td>233 108 55 81</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- copia -->
        <div>
        <div>

            <img src="<?php echo $imagenBase64; ?>" alt="logo" class="img-logo">
        </div>
        <div class="encabezado">
            <p> <strong>Zacapoaxtla, Pue. A <?php echo $fecha ?>.</strong></p>
            <p><strong>ASUNTO:</strong> Notificación Única por adeudo</p>
            <p> de agua potable y/o drenaje.</p>
        </div>
        <!-- datos de usuario -->
        <div class="info-usuario">
            <p><strong>
                    C. <?php echo $usuario->user ?> <?php echo $usuario->lastname ?><br>
                    Dirección: <?php echo $usuario->address ?><br>
                    N.° de SIAC: <?= $idUsuario ?><br>
                    ESTIMADO USUARIO
                </strong>
            </p>
        </div>
        <!-- contenido -->
        <div class="contenido">
            <p>
                El SOMAPAZ, con base a lo señalado por los artículos 1, 2 fracción II, IV y V, artículo 3 inciso B del Decreto de Creación del Sistema Operador de Agua Potable y Alcantarillado del Municipio de Zacapoaxtla; así como; artículos 1, 10 fracción III, 23 fracción VII y IX, 99 fracción I de la Ley del Agua para el Estado de Puebla tiene la responsabilidad de prestar servicios de Agua Potable y Alcantarillado. Ello implica que los usuarios como es su caso, que reciben los servicios, tienen la obligación de pagarlos. Adeudo que a continuación se detalla:
            </p>
        </div>
        <!-- tabla -->
        <div>
            <table class="tabla-bordes">
                <thead>
                    <tr>
                        <th><strong>PERIODO COMPRENDIDO</strong></th>
                        <th><strong>IMPORTE:</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $rangoFechas; ?></td>

                        <td><strong><?= '$' . number_format($total_suma, 2) ?></strong></td>

                    </tr>

                </tbody>
            </table>
        </div>
        <!-- contenido 2 -->
        <div class="contenido">
            El SOMAPAZ pone a su disposición la viabilidad de solicitar un convenio de pago a plazos derivado de su rezago, el cual puede solicitar al momento de recibir esta notificación en las oficinas centrales. En caso de hacer caso omiso a la presente notificación en un <strong>término de 5 días hábiles</strong> se le comunica que el sistema operador cuenta con las facultades suficientes para reducirle el servicio del agua potable, con base al artículo Segundo fracción IV y V del decreto de creación del Organismo Operador aprobado por el H. Congreso del Estado de Puebla, al artículo 99, fracción 1 de la Ley de Agua para el Estado de Puebla, y por acuerdos tomados por el Consejo de Administración. Así mismo, le comunico que una vez hecha la reducción de suministro a su toma de agua y posteriormente solicite se le reinstale, tendrá que liquidar su adeudo más recargos y todos los gastos que se hayan originado con motivo de la reducción del servicio y por la reinstalación.
        </div>
        <br>
        <div class="contenido">
            Cabe hacer mención que el pago por el consumo de agua es para <strong>dar Mantenimiento tanto a la línea de conducción como a la red de distribución y así brindarle a usted un buen servicio.</strong>
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

        <div class="firma-usuario">
            <p class="nombre"><span></span></p>
            <p><strong>Recibio</strong></p>
            <p class="nombre">C. <span></span></p>
        </div>

        <div class="folio">
            <p><strong>FOLIO</strong>: <?php echo $folio; ?></p>
        </div>
        <div class="entregado-por">
            <span></span>
            <p><strong>Entregado por:</strong></p>
            <p><?php echo $empleadoNombre; ?></p>
        </div>
        <div>
            <table class="pagos-transferencia">
                <thead>
                    <tr>
                        <th class="titulo-transferencia" colspan="2">
                            <strong>PAGOS POR TRANSFERENCIA (BBVA BANCOMER)</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NO CUENTA:</td>
                        <td>0450061786</td>
                    </tr>
                    <tr>
                        <td>CLABE INTERBANCARIA:</td>
                        <td>012650004500617861</td>
                    </tr>
                    <tr>
                        <td>ENVIAR COMPROBANTE AL CELULAR:</td>
                        <td>233 108 55 81</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>