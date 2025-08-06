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

function formatearFechaES($fecha): string
{
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'es_VE.UTF-8', 'esp');
    $d = strtotime($fecha);
    $fecha_formateada = strftime('%B de %Y', $d);
    return $fecha_formateada;
}

function formatearFechaESLong($fecha): string
{
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'es_VE.UTF-8', 'esp');
    $d = strtotime($fecha);
    $fecha_formateada = strftime('%d de %B de %Y', $d);
    return $fecha_formateada;
}

function numeroALetras($numero): string
{
    $unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $especiales = ['once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
    $decenas = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    $centenas = ['', 'cien', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

    if ($numero == 0) {
        return 'cero';
    }

    if ($numero < 10) {
        return $unidades[$numero];
    }  elseif ($numero == 10) {
             return 'diez';
    } elseif ($numero < 20) {
        return $especiales[$numero - 11];
    } elseif ($numero < 100) {
        return $decenas[intval($numero / 10)] . (($numero % 10 > 0) ? ' y ' . $unidades[$numero % 10] : '');
    } elseif ($numero < 1000) {
        return ($numero == 100 ? 'cien' : $centenas[intval($numero / 100)] . (($numero % 100 > 0) ? ' ' . numeroALetras($numero % 100) : ''));
    } elseif ($numero < 1000000) {
        return (intval($numero / 1000) == 1 ? 'mil' : numeroALetras(intval($numero / 1000)) . ' mil') . (($numero % 1000 > 0) ? ' ' . numeroALetras($numero % 1000) : '');
    } elseif ($numero < 1000000000) {
        return (intval($numero / 1000000) == 1 ? 'un millón' : numeroALetras(intval($numero / 1000000)) . ' millones') . (($numero % 1000000 > 0) ? ' ' . numeroALetras($numero % 1000000) : '');
    } elseif ($numero < 1000000000000) {
        return (intval($numero / 1000000000) == 1 ? 'mil millones' : numeroALetras(intval($numero / 1000000000)) . ' mil millones') . (($numero % 1000000000 > 0) ? ' ' . numeroALetras($numero % 1000000000) : '');
    }

    return 'Número fuera de rango';
}

function formatoMiles($numero): string
{
    return number_format($numero, 2, '.', ',');
}

function obtenerMesesRestantes(): array
{
    $mesActual = date('n');
    $meses = [];

    for ($i = $mesActual; $i <= 12; $i++) {
        $meses[] = $i;
    }

    return $meses;
}


// Funciones caja

function calcular($array): float
{
    $monto = array_reduce($array, function ($acc, $act) {
        return $acc + $act;
    }, 0);

    return $monto;
}

function calcularTotales($array): float
{
    $monto = array_reduce($array, function ($acc, $act) {
        return $acc + $act->total;
    }, 0);

    return $monto;
}
function uuid(): string
{
    $datos = random_bytes(16);

    // Establecer versión (4) y variante (RFC 4122)
    $datos[6] = chr((ord($datos[6]) & 0x0f) | 0x40); // versión 4
    $datos[8] = chr((ord($datos[8]) & 0x3f) | 0x80); // variante RFC

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($datos), 4));
}
