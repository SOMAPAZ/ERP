<?php

namespace Usuarios;

use Model\ActiveRecord;

class Zona extends ActiveRecord
{
    protected static $tabla = 'zone';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
    }
}
