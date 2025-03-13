<?php
//Deshabilitar las alertas de deprecated
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Conectarnos a la base de datos
require __DIR__ . '/../vendor/autoload.php';
use Model\ActiveRecord;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';

ActiveRecord::setDB($db);
