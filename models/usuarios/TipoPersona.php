<?php

namespace Usuarios;

use Model\ActiveRecord;

class TipoPersona extends ActiveRecord
{
    protected static $tabla = 'type_person';
    protected static $columnasDB = ['id', 'type'];

    public $id;
    public $type;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->type = isset($args['type']) ?? '';
    }
}
