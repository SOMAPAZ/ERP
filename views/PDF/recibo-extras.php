<?php
$nombreImagen = "build/img/logo-of.webp";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
</head>
<style>
    .body {
        font-family: Arial, sans-serif;
        color: #333;
        width: auto;
        height: auto;
        margin: -0.2in;
        padding: 0.5in;
    }

    .left {
        width: 50%;
        float: left;
        display: table;
        height: auto;
    }

    .left div {
        margin-top: -68px;
    }

    .titulo {
        text-transform: uppercase;
        text-align: center;
        font-size: 28px;
        margin-left: 75px;
        font-weight: extra-bold;
        font-family: 'Libre Baskerville';
    }

    .folio {
        font-size: 22px;
        text-align: left;
        float: right;
        color: red;
        font-weight: bold;
        margin-right: 15px;
        margin-top: -75px;
        font-family: 'Libre Baskerville';
    }

    .sub-titulo {
        font-size: 14px;
        text-align: left;
        text-transform: uppercase;
        margin-top: -20px;
        margin-left: 45px;
        text-align: center;
        font-weight: bold;
        font-family: 'Playfair Display Variable';
    }

    .img-logo {
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
        margin-top: -105px;
        margin-left: -45px;
    }

    .info-empresa {
        margin-top: -25px;
        margin-left: -55px;
        font-size: 11px;
        text-transform: uppercase;
        text-align: center;
        font-weight: bold;
        font-family: 'Noto Serif JP Variable';
    }

    .linea-divisoria {
        display: block;
        border-top: 5px solid blue;
        width: 106%;
        margin-left: -45px;
        margin-top: -22px;
    }

    .informacion-usuario {
        font-family: 'DM Sans Variable';
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 1px;
    }

    .informacion-usuario span {
        font-size: 14px;
        background-color: blue;
        color: white;
        padding: 5px 50px;
    }

    .desglose-pago {
        font-family: 'DM Sans Variable';
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .pago {
        position: relative;
        margin-top: 5px;
        text-align: center;
    }

    .pago span {
        font-size: 14px;
        background-color: blue;
        color: white;
        padding: 5px 40px;
    }

    .forma-pago {
        margin-top: 15px;
    }

    .forma-pago label {
        display: inline;
        background-color: blue;
        color: white;
        padding: 5px 10px;
        border-radius: 10px;
        margin-left: -45px;
    }

    .forma-pago label+label {
        margin-left: -1px;
        background-color: transparent;
        color: black;
        padding: 0;
        border-radius: 0;
    }

    .forma-pago input[type="checkbox"] {
        vertical-align: bottom;
        margin-left: 5px;
    }

    .periodo-pagado {
        position: relative;
        margin-top: 15px;
        text-align: center;
        margin-right: 25px;
    }

    .periodo-pagado span {
        font-size: 14px;
        background-color: blue;
        color: white;
        padding: 5px 10px;
    }

    .payment-table {
        width: 100%;
        font-size: 10px;
        text-transform: uppercase;
        border-collapse: separate;
        border-spacing: 2px;
        margin-top: 15px;
        margin-left: -25px;
        font-family: 'Courier Prime';
    }

    .payment-table thead .table-header {
        background-color: blue;
        color: white;
        text-align: right;
    }

    .payment-table th,
    .payment-table td {
        padding: 3px 10px;
        text-align: center;
    }

    .payment-table td:first-child {
        text-align: left;
    }

    .note-total-container {
        text-transform: uppercase;
        font-size: 10px;
        margin-top: 15px;
        display: flex;
        font-weight: bold;
        align-items: center;
    }

    .note-label {
        text-transform: uppercase;
        font-size: 12px;
        background-color: blue;
        color: white;
        padding: 5px 10px;
        margin-left: -45px;
        font-family: 'DM Sans Variable', sans-serif;
        border-radius: 10px;
    }

    .total-label {
        background-color: blue;
        color: white;
        padding: 5px 24px;
        margin-left: 95px;
        border-radius: 10px;
        font-weight: bold;
    }

    .total-amount {
        padding: 2px 5px;
        margin-left: 10px;
        font-size: 15px;
        font-family: 'Libre Baskerville', serif;
    }

    .amount-date-container {
        text-transform: uppercase;
        font-size: 9px;
        margin-left: 270px;
        margin-top: 5px;
        font-weight: bold;
        font-family: 'Inconsolata Variable', monospace;
    }

    .amount-text {
        display: inline;
    }

    .date-text {
        text-align: left;
        color: #0ea5e9;
        font-size: 12px;
        margin-left: 15px;
        margin-top: 5px;
        display: inline-block;
    }

    .footer-section {
        text-transform: uppercase;
        font-size: 10px;
        font-weight: bold;
        position: absolute;
        text-align: center;
        bottom: 60px;
    }

    .footer-line {
        display: block;
        border-top: 2px solid blue;
        width: 39%;
        position: absolute;
        top: 5px;
        left: 50%;
        transform: translateX(27%);
        margin-top: -10px;
    }

    .footer-text-left {
        display: inline-block;
        margin-left: 90px;
    }

    .footer-text-right {
        display: inline-block;
        margin-right: 2px;
    }

    .text-uppercase {
        text-transform: uppercase;
        font-size: 10px;
    }

    .highlight {
        color: #0ea5e9;
        position: absolute;
        bottom: 40px;
        width: 50%;
        margin: 0;
        margin-left: -30px;
        margin-top: 5px;
        font-weight: bold;
    }

    .contact-info {
        background-color: blue;
        color: white;
        position: absolute;
        bottom: 10px;
        width: 50%;
        margin: 0;
        margin-left: -40px;
        margin-top: 5px;
    }

    .contact-email {
        text-transform: none;
    }

    .original {
        position: absolute;
        bottom: -20px;
        width: 100%;
        margin: 0;
        margin-left: 240px;
        margin-top: 5px;
    }
</style>

<body class="body">

    <div class="left">
        <div>
            <h1 class="titulo">recibo oficial de cobro</h1>
            <span class="folio">N° <?= $recibo->folio ?></span>
            <p class="sub-titulo">sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</p>
            <img src="<?php echo $imagenBase64; ?>" alt="logo" class="img-logo">
            <p class="info-empresa">r.f.c. soa960227fu6, calle la cooncordia n° 12 col. centro, zacapoaxtla, pue. 73680</p>
        </div>
        <!-- linea divisional -->
        <span class="linea-divisoria"></span>
        <!-- div informacion del usuario -->
        <div class="informacion-usuario" style="margin-top: 1px;">
            <div style="text-align: center; margin-top: 5px;">
                <span>
                    información del usuario
                </span>
            </div>
            <div style="margin-top: 15px; margin-left: -45px;">
                <p style="margin-top: -5px; ">nombre: <?= isset($usuario->user) ? $usuario->user . ' ' . $usuario->lastname : $usuario ?></p>
                <p style="margin-top: -5px;">dirección: <?= $recibo->direccion ?></p>
                <div style="margin-top: -5px;">
                    <p style=" display: inline;">id usuario: <?= isset($usuario->id) ? $usuario->id : 'Sin id registrado' ?> </p>
                    <p style=" display: inline;">rfc: <?= isset($usuario->rfc) ? ($usuario->rfc ? $usuario->rfc : 'Sin RFC registrado') : 'Sin RFC registrado' ?> </p>
                </div>
                <?php if (isset($tipo_toma->name)) : ?>
                    <p style="margin-top: 5px;">tipo de servicio: <?= $tipo_toma->name ?> - clasificación: <?= $tipo_consumo->name ?></p>
                <?php else: ?>
                    <p style="margin-top: 5px;">Tipo de servicio: No pertenece a ninguna clasificación</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- linea divisional -->
        <span class="linea-divisoria" style="margin-top: -10px;"></span>
        <!-- desglose de pago -->
        <div class="desglose-pago" style="margin-top:75px;">
            <div class="pago">
                <span>
                    desglose de pago
                </span>
            </div>
            <div class="forma-pago" style="margin-top: 10px;">
                <label>
                    forma de pago
                </label>

                <label>
                    efectivo
                    <input type="checkbox" <?= $recibo->tipo_pago === "1" ? 'checked' : '' ?>>
                </label>

                <label>
                    cheque
                    <input type="checkbox" <?= $recibo->tipo_pago === "2" ? 'checked' : '' ?>>
                </label>

                <label>
                    depósito
                    <input type="checkbox" <?= $recibo->tipo_pago === "3" ? 'checked' : '' ?>>
                </label>
                <label>
                    transferencia
                    <input type="checkbox" <?= $recibo->tipo_pago === "4" ? 'checked' : '' ?>>
                </label>

                <label>
                    t.p.v
                    <input type="checkbox" <?= $recibo->tipo_pago === "5" ? 'checked' : '' ?>>
                </label>
            </div>
            <div class="periodo-pagado" style="margin-top: 10px;">
                <span>
                    Periodo pagado: Este proceso no contiene periodo
                </span>
            </div>
        </div>
        <!-- tabla de desglose de pago -->
        <table class="payment-table">
            <thead>
                <tr class="table-header">
                    <th>Concepto</th>
                    <th>Real</th>
                    <th>Descuento</th>
                    <th>Cobrado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_iva = 0;
                $total_pago = 0;
                foreach ($listado as $li):
                    $total_iva += $li->cantidad_iva;
                    $total_pago += ($li->total);
                ?>
                    <tr>
                        <td><?= $li->id_cuenta->cuenta ?></td>
                        <td>$ <?= formatoMiles($li->cantidad) ?></td>
                        <td>$ 0.00</td>
                        <td>$ <?= formatoMiles($li->cantidad) ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                <tr>
                    <td>I.V.A</td>
                    <td>$ <?= formatoMiles($total_iva) ?></td>
                    <td>$ 00.00</td>
                    <td>$ <?= formatoMiles($total_iva) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="note-total-container" style="margin-top: auto;">
            <span class="note-label">
                notas: <?= $recibo->nota ?? '' ?>
            </span>

            <span class="total-label">
                total:
            </span>
            <span class="total-amount">
                $ <?= formatoMiles($total_pago) ?>
            </span>
        </div>
        <?php
        $separados = explode('.', $total_pago);
        $texto = numeroALetras($separados[0]);
        $decimales = ($separados[1] ?? 0) . '/100'; ?>

        <div class="amount-date-container" style="margin-top: 10px;">
            <span class="amount-text">(<?= $texto ?> pesos <?= $decimales ?>) MN.</span><br />
            <span class="date-text"><?= $recibo->fecha ?></span>
        </div>

        <div class="footer-section" style=" margin-top: 65px; ">
            <span class="footer-line"></span>
            <span class="footer-text-right">original usuario copia somapaz</span>
            <span class="footer-text-left "><?= $empleado->name . " " . $empleado->lastname; ?></span>
        </div>
        <div class="text-uppercase">
            <p class="highlight">
                somapaz, no la produce, solo la conduce "por un dulce futuro, ¡cuidemos el agua!"
            </p>
            <p class="contact-info">
                Tel. Oficina: 233 314 3148 | WhatsApp: 233 108 53 31 | correo:
                <span class="contact-email">somapaz.zaca@gmail.com</span>
            </p>
            <p class="original">original</p>
        </div>
    </div>
    <!-- segunda hoja -->
    <!-- segunda hoja -->
    <div class="left" style="margin-left: 50px;">
        <div>
            <h1 class="titulo">recibo oficial de cobro</h1>
            <span class="folio">N° <?= $recibo->folio ?></span>
            <p class="sub-titulo">sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</p>
            <img src="<?php echo $imagenBase64; ?>" alt="logo" class="img-logo">
            <p class="info-empresa">r.f.c. soa960227fu6, calle la cooncordia n° 12 col. centro, zacapoaxtla, pue. 73680</p>
        </div>
        <!-- linea divisional -->
        <span class="linea-divisoria"></span>
        <!-- div informacion del usuario -->
        <div class="informacion-usuario" style="margin-top: 1px;">
            <div style="text-align: center; margin-top: 5px;">
                <span>
                    información del usuario
                </span>
            </div>
            <div style="margin-top: 15px; margin-left: -45px;">
                <p style="margin-top: -5px; ">nombre: <?= isset($usuario->user) ? $usuario->user . ' ' . $usuario->lastname : $usuario ?></p>
                <p style="margin-top: -5px;">dirección: <?= $recibo->direccion ?></p>
                <div style="margin-top: -5px;">
                    <p style=" display: inline;">id usuario: <?= isset($usuario->id) ? $usuario->id : 'Sin id registrado' ?> </p>
                    <p style=" display: inline;">rfc: <?= isset($usuario->rfc) ? ($usuario->rfc ? $usuario->rfc : 'Sin RFC registrado') : 'Sin RFC registrado' ?> </p>
                </div>
                <?php if (isset($tipo_toma->name)) : ?>
                    <p style="margin-top: 5px;">tipo de servicio: <?= $tipo_toma->name ?> - clasificación: <?= $tipo_consumo->name ?></p>
                <?php else: ?>
                    <p style="margin-top: 5px;">Tipo de servicio: No pertenece a ninguna clasificación</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- linea divisional -->
        <span class="linea-divisoria" style="margin-top: -10px;"></span>
        <!-- desglose de pago -->
        <div class="desglose-pago" style="margin-top:75px;">
            <div class="pago">
                <span>
                    desglose de pago
                </span>
            </div>
            <div class="forma-pago" style="margin-top: 10px;">
                <label>
                    forma de pago
                </label>

                <label>
                    efectivo
                    <input type="checkbox" <?= $recibo->tipo_pago === "1" ? 'checked' : '' ?>>
                </label>

                <label>
                    cheque
                    <input type="checkbox" <?= $recibo->tipo_pago === "2" ? 'checked' : '' ?>>
                </label>

                <label>
                    depósito
                    <input type="checkbox" <?= $recibo->tipo_pago === "3" ? 'checked' : '' ?>>
                </label>
                <label>
                    transferencia
                    <input type="checkbox" <?= $recibo->tipo_pago === "4" ? 'checked' : '' ?>>
                </label>

                <label>
                    t.p.v
                    <input type="checkbox" <?= $recibo->tipo_pago === "5" ? 'checked' : '' ?>>
                </label>
            </div>
            <div class="periodo-pagado" style="margin-top: 10px;">
                <span>
                    Periodo pagado: Este proceso no contiene periodo
                </span>
            </div>
        </div>
        <!-- tabla de desglose de pago -->
        <table class="payment-table">
            <thead>
                <tr class="table-header">
                    <th>Concepto</th>
                    <th>Real</th>
                    <th>Descuento</th>
                    <th>Cobrado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_iva = 0;
                $total_pago = 0;
                foreach ($listado as $li):
                    $total_iva += $li->cantidad_iva;
                    $total_pago += ($li->cantidad + $li->cantidad_iva);
                ?>
                    <tr>
                        <td><?= $li->id_cuenta->cuenta ?></td>
                        <td>$ <?= formatoMiles($li->cantidad) ?></td>
                        <td>$ 0.00</td>
                        <td>$ <?= formatoMiles($li->cantidad) ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                <tr>
                    <td>I.V.A</td>
                    <td>$ <?= formatoMiles($total_iva) ?></td>
                    <td>$ 00.00</td>
                    <td>$ <?= formatoMiles($total_iva) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="note-total-container" style="margin-top: auto;">
            <span class="note-label">
                notas: <?= $recibo->nota ?? '' ?>
            </span>

            <span class="total-label">
                total:
            </span>
            <span class="total-amount">
                $ <?= formatoMiles($total_pago) ?>
            </span>
        </div>
        <div class="amount-date-container" style="margin-top: 10px;">
            <span class="amount-text">(<?= $texto ?> pesos <?= $decimales ?>) MN.</span><br />
            <span class="date-text"><?= $recibo->fecha ?></span>
        </div>

        <div class="footer-section" style=" margin-top: 65px; ">
            <span class="footer-line"></span>
            <span class="footer-text-right">original usuario copia somapaz</span>
            <span class="footer-text-left "><?= $empleado->name . " " . $empleado->lastname; ?></span>
        </div>
        <div class="text-uppercase">
            <p class="highlight">
                somapaz, no la produce, solo la conduce "por un dulce futuro, ¡cuidemos el agua!"
            </p>
            <p class="contact-info">
                Tel. Oficina: 233 314 3148 | WhatsApp: 233 108 53 31 | correo:
                <span class="contact-email">somapaz.zaca@gmail.com</span>
            </p>
            <p class="original">copia</p>
        </div>
    </div>
</body>

</html>