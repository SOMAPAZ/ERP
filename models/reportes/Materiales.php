<?php

namespace Reportes;

use Model\ActiveRecord;

class Materiales extends ActiveRecord
{
    protected static $tabla = 'materials';
    protected static $columnasDB = [
        'id',
        'name',
    ];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? "";
    }
}
