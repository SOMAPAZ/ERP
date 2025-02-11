<?php

namespace Usuarios;

use Model\ActiveRecord;

class TipoServicio extends ActiveRecord
{
    protected static $tabla = 'service_type';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
    }
}
