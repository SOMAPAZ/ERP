<?php

namespace APIs;

use Model\ActiveRecord;

class MaterialRepAPI extends ActiveRecord
{
    protected static $tabla = 'material_reports';
    protected static $columnasDB = [
        'cantidad',
        'id_report',
        'unidad',
        'material',
    ];

    public $cantidad;
    public $id_report;
    public $unidad;
    public $material;

    public function __construct($args = [])
    {
        $this->cantidad = $args['cantidad'] ?? '';
        $this->id_report = $args['id_report'] ?? null;
        $this->unidad = $args['unidad'] ?? '';
        $this->material = $args['material'] ?? '';
    }

    public static function obtenerMateriales($folio)
    {
        $query = "SELECT mt.`quantity` as 'cantidad', mt.`id_report`, un.`name` as 'unidad', mat.`name` as 'material'
            FROM material_reports mt 
            LEFT OUTER JOIN unities un ON mt.id_unity = un.id
            LEFT OUTER JOIN materials mat ON mt.id_material = mat.id
            WHERE mt.`id_report` = '{$folio}'";
        $resultado = self::consultaJoin($query);

        return $resultado;
    }
}
