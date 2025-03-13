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
            width: 700px;
            margin: 0 auto;
            font-size: 10px;
            text-align: center;
        }

        th,
        td {
            border: 1px solid black;
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

        .table-ev thead {
            font-size: 14px;
        }

        .materiales {
            text-align: left;
            padding-left: 10px;
        }

        .evidencias {
            height: 200px;
            max-width: 200px;
        }

        .firma {
            padding: 80px 15px 15px 15px;
        }
    </style>
</head>

<body>
    <?php
        $background64 = base64_encode(file_get_contents('build/img/marca-agua.webp'));
        $img_base64 = 'data:image/webp;base64,' . $background64;
    ?>
    <img src="<?= $img_base64 ?>" alt="initial" class="img-fluid background">
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
                    <?php foreach($materiales as $material): ?>
                        <li><?= $material->quantity . " " . $material->id_unity . " de " . $material->material ?></li>
                    <?php endforeach ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-ev">
        <thead>
            <tr>
                <th colspan="3">Evidencia Fotográfica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Evidencia Incial</th>
                <th>Evidencia Proceso</th>
                <th>Evidencia Final</th>
            </tr>
            <tr>
                <?php foreach($evidencias as $evidencia):
                    $imageName = trim($evidencia->image);
                    $urlName = "images/" . $imageName;
                    $image = base64_encode(file_get_contents($urlName));
                    $evi = 'data:image/jpg;base64,' . $image;
                ?>
                    <td>
                        <img src="<?= $evi ?>" alt="Evidencia Inicial" class="evidencias">
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th>Atendió</th>
                <th>Sello</th>
                <th>Supervisó</th>
            </tr>
            <tr>
                <td class="firma">
                    <hr>
                </td>
                <td class="firma">
                    <hr>
                </td>
                <td class="firma">
                    <hr>
                </td>
            </tr>
            <tr>
                <th>
                    <?= $reporte->employee_id ?>
                </th>
                <th>Sello</th>
                <th>
                    <?= $reporte->id_employee_sup ?>
                </th>
            </tr>
        </tbody>
    </table>
</body>

</html>