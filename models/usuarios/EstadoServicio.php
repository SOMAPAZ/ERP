<?php

namespace Usuarios;

use Model\ActiveRecord;

class EstadoServicio extends ActiveRecord
{
    protected static $tabla = 'service_status';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
