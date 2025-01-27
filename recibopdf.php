<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
ob_start();
?>
<?php
$nombreImagen = "./img/logo.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333; width: auto; height: auto; margin:-0.2in; padding:0.5in ">

    <div style="width:50%; float:left; border-right: 2px dashed #ccc; display: table; height: auto;">
        <div style=" margin-top: -68px;">
            <h1 style="text-transform: uppercase;  text-align:center;font-size: 28px; margin-left:75px; font-weight: extra-bold;   font-family: 'Libre Baskerville'; ">recibo oficial de cobro</h1>
            <span style="font-size: 22px; text-align: left; float: right; color: red; font-weight: bold;  margin-right: 15px; margin-top: -75px;font-family: 'Libre Baskerville'">N° 87913</span>
            <p style="font-size:14px; text-align: left; text-transform: uppercase; margin-top: -20px; margin-left: 45px; text-align: center; font-weight:bold;  font-family: 'Playfair Display Variable';">sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</p>
            <img src="<?php echo $imagenBase64; ?>" alt="logo" style="width: 100px; height: 100px; margin-bottom: 10px; margin-top: -105px; margin-left: -45px;">
            <p style="margin-top:-25px; margin-left: -55px; font-size: 11px; text-transform: uppercase; text-align: center; font-weight: bold;   font-family: 'Noto Serif JP Variable';">r.f.c. soa960227fu6, calle la cooncordia n° 12 col. centro, zacapoaxtla, pue. 73680</p>
        </div>
        <!-- linea divisional -->
        <span style="display: block; border-top: 5px solid blue; width: 106%; margin-left: -45px; margin-top: -22px;"></span>
        <!-- div informacion del usuario -->
        <div style="font-family: 'DM Sans Variable'; font-size: 12px; font-weight: bold; text-transform: uppercase;">
            <div style="text-align: center; margin-top: 5px;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 50px;">
                    información del usuario
                </span>
            </div>
            <div style="margin-top: 15px; margin-left: -45px;">
                <p style="margin-top: -5px; ">nombre: salvador garcía garcía</p>
                <p style="margin-top: -5px;">dirección: el porvenir</p>
                <div style="margin-top: -5px;">
                    <p style=" display: inline;">id usuario: 23 </p>
                    <p style=" display: inline;">rfc: sin rfc </p>
                </div>
                <p style="margin-top: 5px;">tipo de servicio: comercial - clasificación: ii</p>
            </div>
        </div>
        <!-- linea divisional -->
        <span style="display: block; border-top: 5px solid blue; width: 106%; margin-left: -45px; margin-top: -10px;"></span>
        <!-- desglose de pago -->
        <div style="font-family: 'DM Sans Variable'; font-size: 10px; font-weight: bold; text-transform: uppercase;">
            <div style="position: relative; margin-top: 5px; text-align: center;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 40px;">
                    desglose de pago
                </span>
            </div>
            <div style="margin-top: 15px;">
                <label style="display: inline; background-color: blue; color: white; padding: 5px 10px; border-radius: 10px; margin-left: -45px;">
                    forma de pago
                </label>

                <label style="display: inline; margin-left: -1px;">
                    efectivo
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    cheque
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    depósito
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>
                <label style="display: inline; margin-left: -1px;">
                    transferencia
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    t.p.v
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>
            </div>
            <div style="position: relative; margin-top: 15px; text-align: center;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 40px;">
                    periodo pagado: jul 2024 a dic 2024
                </span>
            </div>
        </div>
        <!-- tabla de desglose de pago -->
        <table style="width: 100%; font-size: 10px; text-transform: uppercase; border-collapse: separate; border-spacing: 2px; margin-top:15px; margin-left: -25px;">
            <thead>
                <tr style="background-color: blue; color: white; text-align: right;">
                    <th style="padding: 3px 10px;">Concepto</th>
                    <th style="padding: 3px 10px;">Real</th>
                    <th style="padding: 3px 10px;">Cobrado</th>
                    <th style="padding: 3px 10px;">Descuento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Consumo de agua</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 249.30</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 249.30</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Consumo de drenaje</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 249.30</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 249.30</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Recargos</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 249.30</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 249.30</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Derechos de conexión de agua</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Derechos de conexión de drenaje</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Micromedidor y piezas especiales</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Trabajos extras para toma</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Constancias de no adeudo</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Constancias de no servicio</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">I.V.A</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
            </tbody>
        </table>
        <div style="text-transform: uppercase; font-size: 10px; margin-top: 15px; display: flex; font-weight: bold;">
            <span style="text-transform: uppercase; font-size: 12px; background-color: blue; color: white; padding: 5px 10px; margin-left: -45px;   font-family: 'DM Sans Variable';border-radius: 10px;">
                notas: segu of zmz-ca-0003/24
            </span>

            <span style="background-color: blue; color: white; padding: 5px 24px; margin-left: 95px; border-radius: 10px;font-weight: bold;">
                total:
            </span>
            <span style="padding: 2px 5px; margin-left:5px; font-size:15px; margin-left: 10px;   font-family: 'Libre Baskerville';">$ 3, 201.89</span>
        </div>
        <div style="text-transform: uppercase; font-size: 9px; margin-left: 270px; margin-top: 5px; font-weight: bold;   font-family: 'Inconsolata Variable';">
            <span>(tres mil doscientos uno pesos 89/100).</span>

            <span style="text-align:left; color:#0ea5e9; font-size:12px; margin-top:5px; margin-left: 15px;">13 enero 2025, 09:56:07</span>
        </div>
        <div style="text-transform: uppercase; font-size: 10px; font-weight: bold; position: absolute; margin-top: 65px; text-align: center; bottom: 60px;">
            <span style="display: block; border-top: 2px solid blue; width: 39%; margin: 0 auto; position: absolute; top: 5px; left: 50%; transform: translateX(-1%); margin-top:-10px ;margin-left:10px; margin-left:50px;"></span>
            <span style="display: inline-block; margin-right: 90px;">original usuario copia somapaz</span>
            <span style="display: inline-block; margin-left: 2px;">beatriz elizabeth rodriguez.g.</span>
        </div>
        <div style="text-transform: uppercase;">
            <p style="font-size: 10px;  color: #0ea5e9; text-align: left;  text-transform: uppercase; position: absolute; bottom: 40px; width: 50%; margin: 0; margin-left: -30px; margin-top: 5px; font-weight: bold;">
                somapaz, no la produce, solo la conduce "por un dulce futuro, ¡cuidemos el agua!"
            </p>
            <p style="font-size: 11px; background-color: blue; color: white; text-align: left;  text-transform: uppercase; position: absolute; bottom: 10px; width: 50%; margin: 0; margin-left: -40px; margin-top: 5px;">
                Tel. Oficina: 233 314 3148 | WhatsApp: 233 108 53 31 | correo:
                <span style="text-transform: none;">
                    somapaz.zaca@gmail.com
                </span>
            </p>
            <!-- Aquí se asegura que el "original" quede en la parte inferior -->
            <p style="text-align: left; font-size: 10px; text-transform: uppercase; position: absolute; bottom: -20px; width: 100%; margin: 0; margin-left: 240px; margin-top: 5px;">
                original
            </p>
        </div>
    </div>
    <!-- segunda hoja -->
    <!-- segunda hoja -->
    <div style=" width:50%; float:left; margin-left: 60px; ">
        <!-- div titulo -->
        <div style="margin-top: -68px;">
            <h1 style="text-transform: uppercase;  text-align:center;font-size: 28px; margin-left:75px; font-weight: extra-bold;   font-family: 'Libre Baskerville'; ">recibo oficial de cobro</h1>
            <span style="font-size: 22px; text-align: left; float: right; color: red; font-weight: bold;  margin-right: 15px; margin-top: -75px;font-family: 'Libre Baskerville'">N° 87913</span>
            <p style="font-size:14px; text-align: left; text-transform: uppercase; margin-top: -20px; margin-left: 45px; text-align: center; font-weight:bold;  font-family: 'Playfair Display Variable';">sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</p>
            <img src="<?php echo $imagenBase64; ?>" alt="logo" style="width: 100px; height: 100px; margin-bottom: 10px; margin-top: -105px; margin-left: -45px;">
            <p style="margin-top:-25px; margin-left: -55px; font-size: 11px; text-transform: uppercase; text-align: center; font-weight: bold;   font-family: 'Noto Serif JP Variable';">r.f.c. soa960227fu6, calle la cooncordia n° 12 col. centro, zacapoaxtla, pue. 73680</p>
        </div>
        <!-- linea divisional -->
        <span style="display: block; border-top: 5px solid blue; width: 106%; margin-left: -45px; margin-top: -22px;"></span>
        <!-- div informacion del usuario -->
        <div style="font-family: 'DM Sans Variable'; font-size: 12px; font-weight: bold; text-transform: uppercase;">
            <div style="text-align: center; margin-top: 5px;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 50px;">
                    información del usuario
                </span>
            </div>
            <div style="margin-top: 15px; margin-left: -45px;">
                <p style="margin-top: -5px; ">nombre: salvador garcía garcía</p>
                <p style="margin-top: -5px;">dirección: el porvenir</p>
                <div style="margin-top: -5px;">
                    <p style=" display: inline;">id usuario: 23 </p>
                    <p style=" display: inline;">rfc: sin rfc </p>
                </div>
                <p style="margin-top: 5px;">tipo de servicio: comercial - clasificación: ii</p>
            </div>
        </div>
        <!-- linea divisional -->
        <span style="display: block; border-top: 5px solid blue; width: 106%; margin-left: -45px; margin-top: -10px;"></span>
        <!-- desglose de pago -->
        <div style="font-family: 'DM Sans Variable'; font-size: 10px; font-weight: bold; text-transform: uppercase;">
            <div style="position: relative; margin-top: 5px; text-align: center;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 40px;">
                    desglose de pago
                </span>
            </div>
            <div style="margin-top: 15px;">
                <label style="display: inline; background-color: blue; color: white; padding: 5px 10px; border-radius: 10px; margin-left: -45px;">
                    forma de pago
                </label>

                <label style="display: inline; margin-left: -1px;">
                    efectivo
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    cheque
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    depósito
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    transferencia
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>

                <label style="display: inline; margin-left: -1px;">
                    t.p.v
                    <input type="checkbox" style="vertical-align: bottom; margin-left: 5px;">
                </label>
            </div>
            <div style="position: relative; margin-top: 15px; text-align: center;">
                <span style="font-size: 14px; background-color: blue; color: white; padding: 5px 40px;">
                    periodo pagado: jul 2024 a dic 2024
                </span>
            </div>
        </div>
        <!-- tabla de desglose de pago -->
        <table style="width: 100%; font-size: 10px; text-transform: uppercase; border-collapse: separate; border-spacing: 2px; margin-top:15px; margin-left: -25px;">
            <thead>
                <tr style="background-color: blue; color: white; text-align: right;">
                    <th style="padding: 3px 10px;">Concepto</th>
                    <th style="padding: 3px 10px;">Real</th>
                    <th style="padding: 3px 10px;">Cobrado</th>
                    <th style="padding: 3px 10px;">Descuento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Consumo de agua</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 249.30</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align: center;  font-family: 'Courier Prime'; ">$ 249.30</td>

                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Consumo de drenaje</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 249.30</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime';  ">$ 249.30</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Recargos</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 249.30</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 249.30</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Derechos de conexión de agua</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Derechos de conexión de drenaje</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Micromedidor y piezas especiales</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Trabajos extras para toma</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Constancias de no adeudo</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">Constancias de no servicio</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
                <tr>
                    <td style="padding: 2px;   font-family: 'Courier Prime'; ">I.V.A</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 00.00</td>
                    <td style="padding: 2px; text-align:center;   font-family: 'Courier Prime'; ">$ 997.20</td>
                </tr>
            </tbody>
        </table>
        <div style="text-transform: uppercase; font-size: 10px; margin-top: 15px; display: flex; font-weight: bold;">
            <span style="text-transform: uppercase; font-size: 12px; background-color: blue; color: white; padding: 5px 10px; margin-left: -45px;   font-family: 'DM Sans Variable';border-radius: 10px;">
                notas: segu of zmz-ca-0003/24
            </span>
            <span style="background-color: blue; color: white; padding: 5px 24px; margin-left: 95px; border-radius: 10px;font-weight: bold;">
                total:
            </span>
            <span style="padding: 2px 5px; margin-left:5px; font-size:15px; margin-left: 10px;   font-family: 'Libre Baskerville';">$ 3, 201.89</span>
        </div>
        <div style="text-transform: uppercase; font-size: 9px; margin-left: 270px; margin-top: 5px; font-weight: bold;   font-family: 'Inconsolata Variable';">
            <span>(tres mil doscientos uno pesos 89/100).</span>

            <span style="text-align:left; color:#0ea5e9; font-size:12px; margin-top:5px; margin-left: 15px;">13 enero 2025, 09:56:07</span>
        </div>
        <div style="text-transform: uppercase; font-size: 10px; font-weight: bold; position: absolute; margin-top: 65px; text-align: center; bottom: 60px;">
            <span style="display: block; border-top: 2px solid blue; width: 39%; margin: 0 auto; position: absolute; top: 5px; left: 50%; transform: translateX(-1%); margin-top:-10px ;margin-left:10px; margin-left:50px;"></span>
            <span style="display: inline-block; margin-right: 90px;">original usuario copia somapaz</span>
            <span style="display: inline-block; margin-left: 2px;">beatriz elizabeth rodriguez.g.</span>
        </div>
        <div style="text-transform: uppercase;">
            <p style="font-size: 10px;  color: #0ea5e9; text-align: left;  text-transform: uppercase; position: absolute; bottom: 40px; width: 50%; margin: 0; margin-left: -30px; margin-top: 5px; font-weight: bold;">
                somapaz, no la produce, solo la conduce "por un dulce futuro, ¡cuidemos el agua!"
            </p>
            <p style="font-size: 11px; background-color: blue; color: white; text-align: left;  text-transform: uppercase; position: absolute; bottom: 10px; width: 50%; margin: 0; margin-left: -40px; margin-top: 5px;">
                Tel. Oficina: 233 314 3148 | WhatsApp: 233 108 53 31 | correo:
                <span style="text-transform: none;">
                    somapaz.zaca@gmail.com
                </span>
            </p>
            <!-- Aquí se asegura que el "original" quede en la parte inferior -->
            <p style="text-align: left; font-size: 10px; text-transform: uppercase; position: absolute; bottom: -20px; width: 100%; margin: 0; margin-left: 240px; margin-top: 5px;">
                copia
            </p>
        </div>
    </div>
</body>

</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("recibo_pago.pdf", ["Attachment" => false]);
?>
