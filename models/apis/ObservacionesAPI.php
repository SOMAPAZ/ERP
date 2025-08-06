<?php

namespace APIs;

use Model\ActiveRecord;

class ObservacionesApi extends ActiveRecord
{
    protected static $tabla = 'observaciones';
    protected static $columnasBD = [
        'id',
        'name'
    ];
    public $id;
    public $name;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? null;
    }
}
