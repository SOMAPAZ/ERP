<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: <?= $folio ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap');

        * {
            margin: 0;
            font-family: "SUSE", sans-serif;
            text-transform: uppercase;
        }

        .background {
            position: fixed;
            z-index: -1;
            width: 100%;
            height: 1055px;
            top: 0;
            left: 0;
        }

        h1 {
            margin-top: 60px;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            min-width: 700px;
            margin: 0 auto;
            font-size: 10px;
            text-align: center;
        }

        th,
        td {
            border: 1px solid gray;
        }

        .gray {
            background: rgb(206, 205, 219);
        }

        .table2 {
            margin: 20px auto;
        }

        .table2 thead {
            font-size: 14px;
        }

        .div-evidencias {
            border: 1px solid gray;
            max-width: 700px;
            margin: 0 auto;
        }

        .table-ev thead {
            font-size: 14px;
            background-color: rgb(206, 205, 219);
        }

        .table-ev td,
        .table-ev th {
            border: none;
        }

        .materiales {
            text-align: left;
            padding-left: 10px;
        }

        .evidencias {
            height: 120px;
            max-width: 120px;
            border-radius: 0.5rem;
        }

        .imagenes-evidencias {
            padding: 0.2rem;
        }

        .imagenes-evidencias-unavailable {
            padding: 0.2rem;
            height: 200px;
            max-width: 200px;
        }

        .firma {
            padding: 60px 15px 15px 15px;
            border: 1px solid gray;
        }

        .footer {
            margin-top: 1rem;
            border: 1px solid gray;
        }
    </style>
</head>

<body>
    <?php
    $marca_agua = 'data:image/webp;base64,' . base64_encode(file_get_contents('build/img/marca-agua.webp'));
    $unavailable = 'data:image/webp;base64,' . base64_encode(file_get_contents('build/img/unavailable.webp'));
    ?>
    <img src="<?= $marca_agua ?>" alt="initial" class="img-fluid background">
    <h1>Ficha de reportes atendidos</h1>

    <table class="table align-middle" style="font-size: 10px;">
        <thead class="text-center">
            <tr>
                <th scope="col" class="gray">Folio</th>
                <th scope="col" class="gray">Usuario</th>
                <th scope="col">Domicilio</th>
                <th scope="col" class="gray">Teléfono</th>
                <th scope="col">Categoría</th>
                <th scope="col" class="gray">Incidencia</th>
                <th scope="col" class="gray">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <th scope="row" class="gray"><?= $reporte->id ?></th>
            <td class="gray"><?= $reporte->name ?? 'Anonimo' ?></td>
            <td><?= $reporte->address ?></td>
            <td><?= $reporte->phone ?></td>
            <td><?= $reporte->id_category ?></td>
            <td><?= $reporte->id_incidence ?></td>
            <td><?= $reporte->created ?></td>
        </tbody>
    </table>
    <table class="table2">
        <thead>
            <tr>
                <th colspan="6">Proceso de atención del reporte</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="2" scope="row">Descripción</th>
                <th colspan="4">Materiales</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?= wordwrap($reporte->description, 40, "</br>\n") ?>
                </td>
                <td colspan="4" class="materiales">
                    <?php if (count($materiales)): foreach ($materiales as $material): ?>
                            <li><?= $material->quantity . " " . $material->id_unity . " de " . $material->material ?></li>
                        <?php endforeach;
                    else: ?>
                        <li>No hay materiales</li>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="div-evidencias">
        <table class="table-ev">
            <thead>
                <tr>
                    <th colspan="6">Evidencia Fotográfica</th>
                </tr>
            </thead>
            <tbody class="body-evidencias">
                <?php if (count($evidencias)): ?>
                    <tr>
                        <?php
                        $totalEvidencias = count($evidencias);
                        $contador = 0;
                        foreach ($evidencias as $evidencia):
                            $image = base64_encode(file_get_contents("images/" . trim($evidencia->image)));
                            $imagen = 'data:image/jpg;base64,' . $image;
                        ?>
                            <td colspan="2" class="imagenes-evidencias">
                                <img src="<?= $imagen ?>" alt="Evidencia <?= $folio ?>" class="evidencias">
                                <p><?= formatearFechaESLong($evidencia->created) ?></p>
                            </td>
                            <?php
                            $contador++;
                            if ($contador % 3 === 0):
                            ?>
                    </tr>
                    <tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <img class="imagenes-evidencias-unavailable" src="<?= $unavailable ?>" alt="Unavailable Evidencia <?= $folio ?>">
                            <p>No hay evidencias disponibles</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <table class="footer">
        <tbody>
            <tr>
                <th colspan="2">Atendió</th>
                <th colspan="2">Sello</th>
                <th colspan="2">Supervisó</th>
            </tr>
            <tr>
                <td colspan="2" class="firma">
                    <p>____________________________________</p>
                </td>
                <td colspan="2" class="firma">
                    <p>____________________________________</p>
                </td>
                <td colspan="2" class="firma">
                    <p>____________________________________</p>
                </td>
            </tr>
            <tr>
                <th colspan="2"><?= $reporte->employee_id ?></th>
                <th colspan="2">Sello</th>
                <th colspan="2"><?= $reporte->id_employee_sup ?></th>
            </tr>
        </tbody>
    </table>
    </table>
</body>

</html>