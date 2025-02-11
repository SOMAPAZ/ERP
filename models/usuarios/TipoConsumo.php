<?php

namespace Usuarios;

use Model\ActiveRecord;

class TipoConsumo extends ActiveRecord
{
    protected static $tabla = 'consume_type';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
    }
}
