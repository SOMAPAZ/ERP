<?php

namespace Reportes;

use Model\ActiveRecord;

class Categoria extends ActiveRecord
{
    protected static $tabla = 'category';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
