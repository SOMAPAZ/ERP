<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo Factura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-fondo: #fff;
            --color-texto: #000;
            --color-texto-white: #fff;
            --color-borde: #004aad;
            --color-titulos: #A0B6D4;
            --color-dark: #004AAD;
        }

        * {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 0.9rem;
        }

        table th,
        table td {
            padding: 0;
        }

        main {
            height: 148.5mm;
            font-family: "Courier Prime", monospace;
            font-style: normal;
            font-weight: 700;
        }

        h1 {
            margin-top: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
        }

        h1,
        h2 {
            text-align: center;
            text-transform: uppercase;
        }

        h2 {
            font-size: 1.2rem;
            padding: 0rem 6rem;
            line-height: 0.9rem;
        }

        .logo-empresa {
            position: absolute;
            z-index: 10;
            width: 100%;
            margin: 0 0.7rem;
            max-width: 5rem;
        }

        .datos-empresa {
            text-align: center;
            font-size: 0.8rem;
            margin: 0 auto;
            text-transform: uppercase;
        }

        .datos-empresa td:nth-child(2) {
            padding-left: 1rem;
        }

        header {
            border-bottom: 3px solid var(--color-borde);
        }

        .titulo,
        .subtitulo {
            padding: 0.2rem 0.5rem;
            background-color: var(--color-titulos);
            width: 100%;
            max-width: 20rem;
            border-radius: 0.5rem;
            margin: 0.5rem auto;
        }

        .subtitulo {
            padding: 0 0.5rem 0.1rem 0.5rem;
            max-width: 10rem;
            margin: 0;
            text-align: center;
            text-transform: uppercase;
            font-size: 1rem;
        }

        section {
            padding: 0 1rem;
        }

        .datos-usuario {
            text-transform: uppercase;
            margin: 0 auto;
            font-size: 0.8rem;
        }

        .datos-usuario tr td:nth-child(2),
        .datos-usuario tr td:nth-child(3) {
            padding-left: 2rem;
        }

        .seccion-usuario {
            border-bottom: 3px solid var(--color-borde);
        }

        .seccion-adeudo {
            position: relative;
            margin-bottom: 0.5rem;
        }

        .tabla-main {
            font-size: 0.8rem;
            margin: 0 auto;
            text-transform: uppercase;
        }

        .tabla-main thead {
            font-size: 1rem;
        }

        .tabla-main thead {
            background-color: var(--color-dark);
        }

        .tabla-main th,
        .tabla-main td {
            border-style: none;
            border-collapse: collapse;
            padding: 0 0.5rem 0.2rem 0.5rem;
        }

        .folio1 {
            position: absolute;
            right: 1rem;
            padding: 0.2rem 1.5rem;
            color: red;
            font-size: 1.2rem;
            background-color: #9bfae0;
            text-transform: uppercase;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .folio2 {
            position: absolute;
            top: 0;
            right: 1rem;
            padding: 0.2rem 1.5rem;
            color: red;
            font-size: 1.2rem;
            background-color: #9bfae0;
            text-transform: uppercase;
            border-radius: 0.5rem;
        }

        .forma-pago,
        .contactos {
            background-color: var(--color-titulos);
            border-radius: 0.5rem;
            padding: 0 0.5rem 0.2rem 0.5rem;
        }

        .contactos {
            width: 100%;
            max-width: 10rem;
        }

        .input-check {
            padding-left: 1rem;
        }

        input[type=checkbox] {
            color: #004aad;
            font-size: 1.5rem;
        }

        small {
            font-size: 0.8rem;
        }

        .total {
            font-size: 1rem;
        }

        .total h4 {
            text-align: center;
            background-color: var(--color-dark);
            color: var(--color-texto-white);
            padding: 0 0.5rem 0.2rem 0.5rem;
            border-radius: 0.5rem;
        }

        .cuenta {
            background-color: var(--color-dark);
            color: var(--color-texto-white);
            padding: 0 0.5rem 0.2rem 0.5rem;
        }

        .incio {
            text-align: center;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .fin {
            text-align: center;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        footer {
            padding: 0 1rem;
            position: relative;
        }

        .main1 footer {
            border-bottom: 1px dashed var(--color-borde);
        }

        .contacto {
            font-size: 0.7rem;
            text-align: left;
        }

        .fecha {
            text-transform: uppercase;
            padding-left: 1rem;
            font-size: 0.8rem;
            color: #004aad;
        }

        .slogan {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: #004aad;
        }

        .firma {
            text-align: right;
            text-transform: uppercase;
            margin: 0 auto;
        }

        .primero-tabla td {
            padding: 0.5rem 0.5rem 0 0.5rem;
        }
    </style>
</head>

<body>
    <?php
    $logo = base64_encode(file_get_contents('build/img/logo-of.webp'));
    $img_base64 = 'data:image/webp;base64,' . $logo;
    ?>
    <main class="main1">
        <header>
            <span class="folio1">N° <?= $folio ?></span>
            <img src="<?= $img_base64 ?>" alt="logo" class="logo-empresa">
            <h1>Recibo oficial de cobro</h1>
            <h2>Sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</h2>
            <table class="datos-empresa">
                <tr>
                    <td>R.F.C. SOA960227FU6</td>
                    <td>Calle La Concordia N°12,Col.Centro,Zacapoaxtla,Pue.73680</td>
                </tr>
            </table>
        </header>
        <section class="seccion-usuario">
            <h2 class="titulo">Información del Usuario</h2>
            <table class="datos-usuario">
                <tr>
                    <td colspan="3">Nombre: <?= $usuario->nombre ?></td>
                </tr>
                <tr>
                    <td colspan="3">Dirección: <?= $usuario->direccion ?></td>
                </tr>
                <tr>
                    <td>ID Usuario: <?= $usuario->id ?></td>
                    <td>RFC: <?= empty($usuario->rfc) ? 'Sin RFC' : $usuario->rfc ?></td>
                    <td>Tipo de Servicio: <?= $usuario->toma_consumo ?></td>
                </tr>
            </table>
        </section>
        <section class="seccion-adeudo">
            <h2 class="titulo">Desglose de Pago</h2>
            <span class="folio2">Folio: <?= $recibo->folio ?></span>
            <table class="tabla-main">
                <thead>
                    <tr>
                        <th class="forma-pago" colspan="2">Forma de Pago</th>
                        <th class="cuenta incio">Concepto</th>
                        <th class="cuenta">Real</th>
                        <th class="cuenta">Descuento</th>
                        <th class="cuenta fin">Cobrado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="primero-tabla">
                        <td>Efectivo</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 1 ? 'checked' : '' ?> />
                        </td>
                        <td>Consumo De Agua</td>
                        <td>$ <?= number_format($recibo->monto_agua, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_agua, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_agua - $recibo->monto_descuento_agua, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Cheque</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 2 ? 'checked' : '' ?> />
                        </td>
                        <td>Consumo De Drenaje</td>
                        <td>$ <?= number_format($recibo->monto_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_drenaje - $recibo->monto_descuento_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Depósito</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 3 ? 'checked' : '' ?> />
                        </td>
                        <td>Recargos</td>
                        <td>$ <?= number_format($recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_recargo_agua + $recibo->monto_descuento_recargo_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje - $recibo->monto_descuento_recargo_agua - $recibo->monto_descuento_recargo_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Transferencia</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 4 ? 'checked' : '' ?> />
                        </td>
                        <td>I.V.A</td>
                        <td>$ <?= number_format($recibo->monto_iva_agua + $recibo->monto_iva_drenaje, 2) ?></td>
                        <td> -- -- -- </td>
                        <td>$ <?= number_format($recibo->monto_iva_agua + $recibo->monto_iva_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>T.P.V</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 5 ? 'checked' : '' ?> />
                        </td>
                        <?php
                        $dateIn = new DateTime($recibo->mes_inicio);
                        $dateFin = new DateTime($recibo->mes_fin);
                        ?>
                        <td colspan="3">Periodo Pagado: <?= $dateIn->format('M Y') ?> a <?= $dateFin->format('M Y') ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <small class="subtitulo">Notas</small>
                        </td>
                        <td class="total">
                            <h4>Total</h4>
                        </td>
                        <?php
                        $totalPagar = $recibo->monto_agua + $recibo->monto_drenaje + $recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje + $recibo->monto_iva_agua + $recibo->monto_iva_drenaje;
                        $totalDescuento = $recibo->monto_descuento_agua + $recibo->monto_descuento_drenaje + $recibo->monto_descuento_recargo_agua + $recibo->monto_descuento_recargo_drenaje;
                        ?>
                        <td class="total">
                            <p>$ <?= number_format($totalPagar - $totalDescuento, 2) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                        <td colspan="5"><?= numeroALetras($totalPagar - $totalDescuento) ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <footer>
            <div class="footer">
                <table class="contacto">
                    <tr>
                        <td>Tel. Oficina: 233 314 3148 |</td>
                        <td>WhatsApp: 233 108 5331 |</td>
                        <td>somapaz.zaca@gmail.com</td>
                        <?php $fecha = explode(" ", $recibo->fecha);
                        $mes = explode("-", $fecha[0]) ?>
                        <td colspan="2" class="fecha"><?= $mes[2] . " " . formatearFechas($mes[1]) . " " . $mes[0] . ", " . $fecha[1] ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="slogan">
                            SOMAPAZ, no la produce, solo la conduce. “Por un dulce futuro, ¡Cuidemos el Agua”.
                        </td>
                    </tr>
                </table>
            </div>
            <table class="firma">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="color:#fff"><br>______________________</td>
                        <td>______________________</td>
                    </tr>
                    <tr>
                        <td>Original Usuario</td>
                        <td style="padding-left: 1rem;">Copia Somapaz</td>
                        <td style="color:#fff">______________________</td>
                        <td>Carlos Cabrera Carreón</td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </main>
    <main class="main2">
        <header>
            <span class="folio1">N° <?= $recibo->folio ?></span>
            <img src="<?= $img_base64 ?>" alt="logo" class="logo-empresa">
            <h1>Recibo oficial de cobro</h1>
            <h2>Sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</h2>
            <table class="datos-empresa">
                <tr>
                    <td>R.F.C. SOA960227FU6</td>
                    <td>Calle La Concordia N°12,Col.Centro,Zacapoaxtla,Pue.73680</td>
                </tr>
            </table>
        </header>
        <section class="seccion-usuario">
            <h2 class="titulo">Información del Usuario</h2>
            <table class="datos-usuario">
                <tr>
                    <td colspan="3">Nombre: <?= $usuario->nombre ?></td>
                </tr>
                <tr>
                    <td colspan="3">Dirección: <?= $usuario->direccion ?></td>
                </tr>
                <tr>
                    <td>ID Usuario: <?= $usuario->id ?></td>
                    <td>RFC: <?= empty($usuario->rfc) ? 'Sin RFC' : $usuario->rfc ?></td>
                    <td>Tipo de Servicio: <?= $usuario->toma_consumo ?></td>
                </tr>
            </table>
        </section>
        <section class="seccion-adeudo">
            <h2 class="titulo">Desglose de Pago</h2>
            <span class="folio2">Folio: <?= $recibo->folio ?></span>
            <table class="tabla-main">
                <thead>
                    <tr>
                        <th class="forma-pago" colspan="2">Forma de Pago</th>
                        <th class="cuenta incio">Concepto</th>
                        <th class="cuenta">Real</th>
                        <th class="cuenta">Descuento</th>
                        <th class="cuenta fin">Cobrado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="primero-tabla">
                        <td>Efectivo</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 1 ? 'checked' : '' ?> />
                        </td>
                        <td>Consumo De Agua</td>
                        <td>$ <?= number_format($recibo->monto_agua, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_agua, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_agua - $recibo->monto_descuento_agua, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Cheque</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 2 ? 'checked' : '' ?> />
                        </td>
                        <td>Consumo De Drenaje</td>
                        <td>$ <?= number_format($recibo->monto_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_drenaje - $recibo->monto_descuento_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Depósito</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 3 ? 'checked' : '' ?> />
                        </td>
                        <td>Recargos</td>
                        <td>$ <?= number_format($recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_descuento_recargo_agua + $recibo->monto_descuento_recargo_drenaje, 2) ?></td>
                        <td>$ <?= number_format($recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje - $recibo->monto_descuento_recargo_agua - $recibo->monto_descuento_recargo_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Transferencia</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 4 ? 'checked' : '' ?> />
                        </td>
                        <td>I.V.A</td>
                        <td>$ <?= number_format($recibo->monto_iva_agua + $recibo->monto_iva_drenaje, 2) ?></td>
                        <td> -- -- -- </td>
                        <td>$ <?= number_format($recibo->monto_iva_agua + $recibo->monto_iva_drenaje, 2) ?></td>
                    </tr>
                    <tr>
                        <td>T.P.V</td>
                        <td class="input-check">
                            <input type="checkbox" name="tipo-pago" <?= $recibo->tipo_pago == 5 ? 'checked' : '' ?> />
                        </td>
                        <td colspan="3">Periodo Pagado: <?= $dateIn->format('M Y') ?> a <?= $dateFin->format('M Y') ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <small class="subtitulo">Notas</small>
                        </td>
                        <td class="total">
                            <h4>Total</h4>
                        </td>
                        <?php
                        $totalPagar = $recibo->monto_agua + $recibo->monto_drenaje + $recibo->monto_recargo_agua + $recibo->monto_recargo_drenaje + $recibo->monto_iva_agua + $recibo->monto_iva_drenaje;
                        $totalDescuento = $recibo->monto_descuento_agua + $recibo->monto_descuento_drenaje + $recibo->monto_descuento_recargo_agua + $recibo->monto_descuento_recargo_drenaje;
                        ?>
                        <td class="total">
                            <p>$ <?= number_format($totalPagar - $totalDescuento, 2) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                        <td colspan="5">
                            <?= numeroALetras($totalPagar - $totalDescuento) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <footer>
            <div class="footer">
                <table class="contacto">
                    <tr>
                        <td>Tel. Oficina: 233 314 3148 |</td>
                        <td>WhatsApp: 233 108 5331 |</td>
                        <td>somapaz.zaca@gmail.com</td>
                        <?php $fecha = explode(" ", $recibo->fecha);
                        $mes = explode("-", $fecha[0]) ?>
                        <td colspan="2" class="fecha"><?= $mes[2] . " " . formatearFechas($mes[1]) . " " . $mes[0] . ", " . $fecha[1] ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="slogan">
                            SOMAPAZ, no la produce, solo la conduce. “Por un dulce futuro, ¡Cuidemos el Agua”.
                        </td>
                    </tr>
                </table>
            </div>
            <table class="firma">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="color:#fff"><br>______________________</td>
                        <td>______________________</td>
                    </tr>
                    <tr>
                        <td>Copia Somapaz</td>
                        <td style="padding-left: 1rem;">Original Usuario</td>
                        <td style="color:#fff">______________________</td>
                        <td>Carlos Cabrera Carreón</td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </main>
</body>

</html>