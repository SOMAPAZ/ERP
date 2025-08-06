<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Medidores extends ActiveRecord
{
    protected static $tabla = 'medidores';
    protected static $columnasDB = [
        'id',
        'id_user',
        'medidor',
        'fecha_instalacion'
    ];

    public $id;
    public $id_user;
    public $medidor;
    public $fecha_instalacion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->medidor = $args['medidor'] ?? null;
        $this->fecha_instalacion = $args['fecha_instalacion'] ?? null;
    }

    public static function finds($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_user = '{$id}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function crearm()
    {
        $atributos = $this->sanitizarAtributos();

        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->id = self::$db->insert_id;
        }

        return $resultado;
    }
    public static function wheres($condiciones)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";

        $filtros = [];
        foreach ($condiciones as $campo => $valor) {
            $filtros[] = "$campo = '" . self::$db->escape_string($valor) . "'";
        }

        $query .= implode(" AND ", $filtros) . " LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function obtenerPorUsuario($id_user)
    {
        $query = "SELECT * FROM medidores WHERE id_user = $id_user ORDER BY fecha_instalacion DESC LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}
