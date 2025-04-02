<?php $img_base64 = 'data:image/webp;base64,' . base64_encode(file_get_contents('build/img/marca-agua.webp')); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corte: <?= $folio ?></title>
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
            margin: 5rem auto 2rem auto;
            text-align: center;
            font-size: 1rem;
            max-width: 30rem;
        }

        main {
            margin: 0 auto;
            max-width: 40rem;
        }

        main p {
            margin-bottom: 2rem;
        }

        table {
            max-width: 95%;
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
            text-align: center;
        }

        th,
        td {
            border: 1px solid black;
        }

        .tabla__denominaciones {
            width: 100%;
            margin-top: 2rem;
        }

        .tabla__usuarios {
            width: 100%;
            margin-top: 2rem;
        }

        .tabla__usuarios--nombres {
            font-weight: bold;
            font-size: 0.7rem;
        }
    </style>
</head>

<body>
    <header>
        <img src="<?= $img_base64 ?>" alt="initial" class="background">
        <h1>Sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</h1>
    </header>

    <main>
        <p class="texto-descriptivo">
            <strong><?= $empleado_entrega->name . ' ' . $empleado_entrega->lastname; ?></strong>, entrega el efectivo con el que se cuenta en caja a <strong><?= $empleado_recibe->name . ' ' . $empleado_recibe->lastname; ?></strong> el día <strong><?= $corte->fecha; ?></strong> a las <strong><?= $corte->hora; ?></strong>, importe que se compone de la siquiente manera:
        </p>

        <table>
            <tbody>
                <tr>
                    <td>Total sistema</td>
                    <td>$ <?= formatoMiles($corte->total_sistema); ?></td>
                </tr>
                <tr>
                    <td>Total usuario</td>
                    <td>$ <?= formatoMiles($corte->total_usuario); ?></td>
                </tr>
                <tr>
                    <td>Diferencias</td>
                    <td>$ <?= round($corte->total_sistema - $corte->total_usuario, 2); ?></td>
                </tr>
            </tbody>
        </table>

        <?php $denominaciones = json_decode($corte->denominaciones); ?>

        <section>
            <table class="tabla__denominaciones">
                <thead>
                    <tr>
                        <th>Denominación</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($denominaciones as $key => $value) : ?>
                        <tr>
                            <td>$ <?= formatoMiles($key); ?></td>
                            <td><?= $value !== "" ? $value : "0" ?></td>
                            <td>$ <?= formatoMiles(floatval($key) * floatval($value)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="tabla__usuarios">
                <thead>
                    <tr>
                        <th>Entregó</th>
                        <th>Recibió</th>
                        <th>Testigo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr class="tabla__usuarios--nombres">
                        <td><?= $empleado_entrega->name . " " . $empleado_entrega->lastname ?></td>
                        <td><?= $empleado_recibe->name . " " . $empleado_recibe->lastname ?></td>
                        <td><?= $testigo->name . " " . $testigo->lastname ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>