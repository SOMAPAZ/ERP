<?php

namespace Model;

use Model\ActiveRecord;

class Registros extends ActiveRecord
{
    protected static $tabla = 'registros';
    protected static $columnasDB = [
        'id',
        'empleado_id',
        'accion',
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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->empleado_id = $args['empleado_id'] ?? null;
        $this->accion = $args['accion'] ?? null;
        $this->folio_seccion = $args['folio_seccion'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->comentario = $args['comentario'] ?? '';
    }

    public function guardarRegistro($id)
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( id, ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('{$id}', '";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }
}
