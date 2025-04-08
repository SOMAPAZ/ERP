<?php

namespace Usuarios;

use Model\ActiveRecord;

class TipoAlmacenamiento extends ActiveRecord
{
    protected static $tabla = 'user_storage';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}
