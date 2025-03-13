<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Lecturas extends ActiveRecord
{
    protected static $tabla = 'medido';
    protected static $columnasDB = [
        'id',
        'id_user',
        'id_status',
        'evidencias',
        'year',
        'mes',
        'lectura',
        'fecha_guardada',
        'fecha_reporte',
    ];

    public $id;
    public $id_user;
    public $evidencias;
    public $year;
    public $mes;
    public $lectura;
    public $fecha_guardada;
    public $fecha_reporte;
    public $id_status;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->evidencias = $args['evidencias'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->mes = $args['mes'] ?? null;
        $this->lectura = $args['lectura'] ?? null;
        $this->fecha_guardada = $args['fecha_guardada'] ?? null;
        $this->fecha_reporte = $args['fecha_reporte'] ?? null;
        $this->id_status = $args['id_status'] ?? null;
    }

    public static function getLecturaDate($id_user, $year, $mes)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_user = '{$id_user}' AND year = '{$year}' AND mes = '{$mes}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}