<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Notificacion extends ActiveRecord
{
    protected static $tabla = 'notificaciones';
    protected static $columnasDB = [
        'idx',
        'id_user',
        'meses_rezagados',
        'total',
        'id_status',
        'comentarios',
        'id_tiponotificacion',
        'evidencias',
        'fecha_guardada',
        'fecha_reporte',
        'costo',
        'id_employment'
    ];

    public $idx;
    public $id_user;
    public $meses_rezagados;
    public $total;
    public $id_status;
    public $comentarios;
    public $id_tiponotificacion;
    public $evidencias;
    public $fecha_guardada;
    public $fecha_reporte;
    public $costo;
    public $id_employment;

    public function __construct($args = [])
    {
        $this->idx = $args['idx'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->meses_rezagados = $args['meses_rezagados'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->id_status = $args['id_status'] ?? null;
        $this->comentarios = $args['comentarios'] ?? null;
        $this->id_tiponotificacion = $args['id_tiponotificacion'] ?? null;
        $this->evidencias = $args['evidencias'] ?? null;
        $this->fecha_guardada = $args['fecha_guardada'] ?? null;
        $this->fecha_reporte = $args['fecha_reporte'] ?? null;
        $this->costo = $args['costo'] ?? null;
        $this->id_employment = $args['id_employment'] ?? null;
    }
}
