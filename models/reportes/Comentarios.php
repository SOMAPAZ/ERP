<?php

namespace Reportes;

use Model\ActiveRecord;

class Comentarios extends ActiveRecord
{
    protected static $tabla = 'comentarios_reportes';
    protected static $columnasDB = ['id', 'comentario', 'id_empleado', 'created_at', 'reporte_id'];

    public $id;
    public $comentario;
    public $id_empleado;
    public $created_at;
    public $reporte_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->comentario = $args['comentario'] ?? '';
        $this->id_empleado = $args['id_empleado'] ?? null;
        $this->created_at = $args['created_at'] ?? '';
        $this->reporte_id = $args['reporte_id'] ?? null;
    }

    public function validar()
    {
        if (!$this->comentario) {
            self::$alertas['error']['comentario'] = 'El comentario es obligatorio';
        }

        return self::$alertas;
    }
}
