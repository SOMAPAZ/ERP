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

function formatearFechaES($fecha)
{
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'es_VE.UTF-8', 'esp');
    $d = strtotime($fecha);
    $fecha_formateada = strftime('%B de %Y', $d);
    return $fecha_formateada;
}


// Funciones caja

function calcular($array): float
{
    $monto = array_reduce($array, function ($acc, $act) {
        return $acc + $act;
    }, 0);

    return $monto;
}
