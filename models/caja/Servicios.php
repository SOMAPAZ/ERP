<?php

namespace Facturacion;
use Model\ActiveRecord;

class Servicios extends ActiveRecord
{
    protected static $tabla = 'services';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}