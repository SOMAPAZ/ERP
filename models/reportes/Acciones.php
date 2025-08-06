<?php

namespace Model;

use Model\ActiveRecord;

class Acciones extends ActiveRecord
{
    protected static $tabla = 'acciones';
    protected static $columnasDB = [
        'id',
        'nombre',
    ];

    public $id;
    public $nombre;
}
