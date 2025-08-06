<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Historial_lecturas extends ActiveRecord
{
    protected static $tabla = 'historial_medidores';
    protected static $columnasDB = [
        'id',
        'id_medidor',
        'numero_anterior',
        'numero_nuevo',
        'fecha_cambio',
    ];

    public $id;
    public $id_medidor;
    public $numero_anterior;
    public $numero_nuevo;
    public $fecha_cambio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_medidor = $args['id_medidor'] ?? null;
        $this->numero_anterior = $args['numero_anterior'] ?? null;
        $this->numero_nuevo = $args['numero_nuevo'] ?? null;
        $this->fecha_cambio = $args['fecha_cambio'] ?? null;
    }

    public static function findAlls($id_user)
    {
        $query = "
            SELECT h.* FROM historial_medidores h
            JOIN medidores m ON h.id_medidor = m.id
            WHERE m.id_user = '{$id_user}'
            ORDER BY h.id DESC
        ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
