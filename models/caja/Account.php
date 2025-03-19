<?php

namespace Facturacion;
use Model\ActiveRecord;

class Account extends ActiveRecord
{
    protected static $tabla = 'account';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}