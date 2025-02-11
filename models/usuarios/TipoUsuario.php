<?php

namespace Usuarios;

use Model\ActiveRecord;

class TipoUsuario extends ActiveRecord
{
    protected static $tabla = 'user_type';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
    }
}
