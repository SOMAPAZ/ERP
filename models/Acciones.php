<?php

namespace Model;

class Acciones
{
    protected static $tabla = 'acciones';
    protected static $columnasDB = [
        'id',
        'nombre',
    ];

    public $id;
    public $nombre;
}
