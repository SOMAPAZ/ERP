<?php

namespace Empleados;

use Model\ActiveRecord;

class Roles extends ActiveRecord
{

    protected static $tabla = 'roles';
    protected static $columnasDB = ['id', 'name', 'description'];

    public $id;
    public $name;
    public $description;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
    }
}
