<?php

namespace Usuarios;

use Model\ActiveRecord;

class Localidad extends ActiveRecord
{
    protected static $tabla = 'locality';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
