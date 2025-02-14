<?php

namespace Usuarios;

use Model\ActiveRecord;

class Colonia extends ActiveRecord
{
    protected static $tabla = 'colony';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
    }
}
