<?php

namespace Usuarios;

use Model\ActiveRecord;

class Observaciones extends ActiveRecord
{
    protected static $tabla = 'observaciones';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
