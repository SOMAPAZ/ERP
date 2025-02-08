<?php

define('URL',  realpath('../'));
define('CARPETA_IMAGENES_REPORTES', $_SERVER['DOCUMENT_ROOT'] . '/images/');

function dd($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function permisosAPI(): void
{
    $auth = intval($_SESSION['empleado_rol']);

    if ($auth !== 1 && $auth !== 3) {
        $respuesta = [
            'mensaje' => 'Usted no puede acceder a este contenido'
        ];

        echo json_encode($respuesta);
        return;
    }
}

function permisosCaja(): void
{
    $auth = intval($_SESSION['empleado_rol']);

    if ($auth !== 1 && $auth !== 3 && $auth !== 2 && $auth !== 8) {
        header('Location: /welcome');
    }
}

function s($html): string
{
    if ($html === null) {
        return '';
    };

    $s = htmlspecialchars($html);
    return $s;
}

function formatearFechas($fecha): string
{
    $arrayFechas = array(
        'January' => 'enero',
        'February' => 'febrero',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'mayo',
        'June' => 'junio',
        'July' => 'julio',
        'August' => 'agosto',
        'September' => 'septiembre',
        'October' => 'octubre',
        'November' => 'noviembre',
        'December' => 'diciembre',
    );

    $resultado = DateTime::createFromFormat('!m', $fecha)->format('F');

    return $arrayFechas[$resultado];
}

function esUltimo(string $actual, string $proximo): bool
{
    if ($actual !== $proximo) {
        return true;
    }
    return false;
}

function numeroALetras($numero)
{
    $textoInt = '';
    $textoDec = 'cero';

    $numeros = array(
        0 => 'cero',
        1 => 'uno',
        2 => 'dos',
        3 => 'tres',
        4 => 'cuatro',
        5 => 'cinco',
        6 => 'seis',
        7 => 'siete',
        8 => 'ocho',
        9 => 'nueve',
        10 => 'diez',
        11 => 'once',
        12 => 'doce',
        13 => 'trece',
        14 => 'catorce',
        15 => 'quince',
        16 => 'dieciséis',
        17 => 'diecisiete',
        18 => 'dieciocho',
        19 => 'diecinueve',
        20 => 'veinte',
        30 => 'treinta',
        40 => 'cuarenta',
        50 => 'cincuenta',
        60 => 'sesenta',
        70 => 'setenta',
        80 => 'ochenta',
        90 => 'noventa',
        100 => 'ciento',
        200 => 'doscientos',
        300 => 'trescientos',
        400 => 'cuatrocientos',
        500 => 'quinientos',
        600 => 'seiscientos',
        700 => 'setecientos',
        800 => 'ochocientos',
        900 => 'novecientos',
        1000 => 'mil',
    );

    $separacion = explode(".", strval($numero));
    $entero = intval($separacion[0]);
    $decimales = intval($separacion[1]);

    $textoInt = coincidirCasos($entero, $numeros);
    $textoDec = coincidirCasos($decimales, $numeros);

    $textoCantidad = $textoInt . " pesos con " . $textoDec . " centavos";

    $veinti = "veinte y";
    $isVeinte = strpos($textoCantidad, $veinti);

    if ($isVeinte !== false) {
        $textoCantidad = str_replace($veinti, "veinti", $textoCantidad);
    }


    if (strpos($textoCantidad, "y uno")) {
        $textoCantidad = str_replace("y uno", "y un", $textoCantidad);
    }

    if (strpos($textoCantidad, " uno")) {
        $textoCantidad = str_replace(" uno", "un", $textoCantidad);
    }

    if (strpos($textoCantidad, "veinti ")) {
        $textoCantidad = str_replace("veinti ", "veinti", $textoCantidad);
    }
    return $textoCantidad;
}

function coincidirCasos($num, $array)
{
    if ($num < 21) {
        $text = $array[$num];
    }

    if ($num >= 21 && $num < 100) {
        $text = menor100($num, $array);
    }

    if ($num >= 100 && $num < 1000) {
        $text = menor1000($num, $array);
    }

    if ($num < 10000 && $num >= 1000) {
        $text = menor10000($num, $array);
    }

    if ($num >= 10000 && $num < 100000) {
        $text = mayor10000($num, $array);
    }

    return $text;
}

function menor100($numero, $arrayNum)
{
    $div = $numero / 10;
    $sep = explode(".", $div);
    $textFormat = $arrayNum[intval($sep[0]) * 10] . " y " . $arrayNum[$sep[1]];

    return $textFormat;
}

function menor1000($numero, $arrayNum)
{
    $div = $numero / 100;
    $sep = explode(".", $div);
    $textFormat = $arrayNum[intval($sep[0]) * 100] . " " . menor100($sep[1], $arrayNum);

    return $textFormat;
}

function menor10000($numero, $arrayNum)
{
    $div = $numero / 1000;

    $sep = explode(".", $div);
    if ($div === 1) {
        $textFormat = $arrayNum[intval($sep[0]) * 1000] . " " . menor1000($sep[1], $arrayNum);
    }

    $textFormat = $arrayNum[intval($sep[0])] . " mil " . menor1000($sep[1], $arrayNum);


    return $textFormat;
}

function mayor10000($numero, $arrayNum)
{
    $div = $numero / 1000;
    $sep = explode(".", $div);

    $textFormat = menor100($sep[0], $arrayNum) . " mil " . menor1000($sep[1], $arrayNum);

    return $textFormat;
}

function formatearFecha(string $fecha): string
{
    $fechaOriginal = s($fecha);
    $timestamp = strtotime(str_replace('/', '-', $fechaOriginal));

    return date("Y-d-m", $timestamp);
}

function formatearFechaPar(string $fecha): string
{
    $fechaOriginal = s($fecha);
    $timestamp = strtotime(str_replace('/', '-', $fechaOriginal));

    return date("Y-m-d", $timestamp);
}

function desformatearMonto(string|null $monto): float
{
    if ($monto === '' || $monto === null) {
        return 0;
    }
    $monto = str_replace(',', '', $monto);
    $monto = str_replace(' ', '', $monto);

    return floatval($monto);
}
