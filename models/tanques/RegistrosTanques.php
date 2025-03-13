<?php

namespace Tanques;

use Model\ActiveRecord;

class RegistrosTanques extends ActiveRecord {
    protected static $tabla = 'registro_tanque';
    protected static $columnasDB = ['id', 'nivel', 'llegada', 'imagen', 'fecha', 'tanque_id'];

    public $id;
    public $nivel;
    public $llegada;
    public $imagen;
    public $fecha;
    public $tanque_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nivel = $args['nivel'] ?? '';
        $this->llegada = $args['llegada'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->tanque_id = $args['tanque_id'] ?? null;
    }

    public static function obtenerRegistros($column1, $column2, $value1, $value2, $value3)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE MONTH({$column1}) = $value1 AND YEAR({$column1}) = $value2 AND {$column2} = $value3 ORDER BY fecha ASC";
        $result = self::consultarSQL($query);

        return $result;
    }
}