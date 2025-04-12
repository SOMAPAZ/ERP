<?php

namespace Usuarios;

use Model\ActiveRecord;

class AltaUsuario extends ActiveRecord
{
    protected static $tabla = 'altas_usuario';
    protected static $columnasDB = ['id', 'folio', 'id_user', 'fecha'];

    public $id;
    public $folio;
    public $id_user;
    public $fecha;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio = $args['folio'] ?? '';
        $this->id_user = $args['id_user'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
    }

    public static function obtenerFolio()
    {
        $query = "SELECT folio FROM " . self::$tabla . " ORDER BY id DESC LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}
