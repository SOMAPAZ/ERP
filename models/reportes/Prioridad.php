<?php

namespace Reportes;

use Model\ActiveRecord;

class Prioridad extends ActiveRecord
{
    protected static $tabla = 'priority';
    protected static $columnasDB = ['id', 'name', 'color'];

    public $id;
    public $name;
    public $color;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->color = $args['color'] ?? '';
    }
}
