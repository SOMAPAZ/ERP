<?php

namespace Reportes;

use Model\ActiveRecord;

class Unidades extends ActiveRecord
{
    protected static $tabla = 'unities';
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
