<?php

namespace Reportes;

use Model\ActiveRecord;

class Incidencias extends ActiveRecord
{
    protected static $tabla = 'incidence';
    protected static $columnasDB = ['id', 'name', 'id_category'];

    public $id;
    public $name;
    public $id_category;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->id_category = $args['id_category'] ?? null;
    }
}
