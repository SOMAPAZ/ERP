<?php

namespace Tanques;

use Model\ActiveRecord;

class Tanques extends ActiveRecord {
    protected static $tabla = 'tanques';
    protected static $columnasDB = ['id', 'nombre', 'lng', 'lat'];

    public $id;
    public $nombre;
    public $lng;
    public $lat;

    public function __construct($args = []) 
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->lng = $args['lng'] ?? null;
        $this->lat = $args['lat'] ?? '';
    }
}