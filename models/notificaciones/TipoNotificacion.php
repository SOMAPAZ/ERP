<?php

namespace Notificaciones;

use Model\ActiveRecord;

class TipoNotificacion extends ActiveRecord
{
    protected static $tabla = 'tipo_notificacion';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
