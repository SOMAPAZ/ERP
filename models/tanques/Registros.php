<?php

namespace Model;

use Model\ActiveRecord;

class Registros extends ActiveRecord
{
    protected static $tabla = 'registros';
    protected static $columnasDB = [
        'id',
        'empleado_id',
        'nombre_empleado',
        'accion',
        'acciones',
        'folio_seccion',
        'created_at',
        'comentario'
    ];

    public $id;
    public $empleado_id;
    public $accion;
    public $folio_seccion;
    public $created_at;
    public $comentario;
    public $empleado_nombre;
    public $acciones;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->empleado_id = $args['empleado_id'] ?? null;
        $this->accion = $args['accion'] ?? null;
        $this->folio_seccion = $args['folio_seccion'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->comentario = $args['comentario'] ?? '';
        $this->empleado_nombre = $args['empleado_nombre'] ?? '';
        $this->acciones = $args['acciones'] ?? '';
    }

    public function guardarRegistro($id)
    {

        $atributos = $this->sanitizarAtributos();

        $query = " INSERT INTO " . static::$tabla . " ( id, ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('{$id}', '";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }
    public static function registrosNot()
    {
        $query = "SELECT r.id, r.empleado_id, r.accion, CONCAT(es.name, ' ', es.lastname) AS empleado_nombre, ac.nombre AS acciones, r.folio_seccion, r.created_at, r.comentario 
                  FROM registros r 
                  INNER JOIN employments es ON r.empleado_id = es.id 
                  INNER JOIN acciones ac ON r.accion = ac.id 
                  WHERE folio_seccion LIKE 'NOT/%' AND DATE(created_at) = CURRENT_DATE() 
                  ORDER BY created_at DESC";

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function Empleadosid()
    {
        $query = "SELECT empleado_id FROM registros";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
