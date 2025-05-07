<?php

namespace Reportes;

use Model\ActiveRecord;

class Material extends ActiveRecord
{
    protected static $tabla = 'material_reports';
    protected static $columnasDB = [
        'id',
        'id_report',
        'quantity',
        'id_report',
        'id_unity',
        'material',
        'id_employee',
        'created'
    ];

    public $id;
    public $id_report;
    public $quantity;
    public $id_unity;
    public $material;
    public $id_employee;
    public $created;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_report = $args['id_report'] ?? null;
        $this->quantity = $args['quantity'] ?? null;
        $this->id_unity = $args['id_unity'] ?? null;
        $this->material = $args['material'] ?? null;
        $this->id_employee = $args['id_employee'] ?? null;
        $this->created = $args['created'] ?? '';
    }

    public function validar()
    {
        if (!$this->material) {
            self::$alertas['error']['material'] = "El material es obligatorio";
        }
        if (!$this->quantity) {
            self::$alertas['error']['quantity'] = "La cantidad es obligatoria";
        }
        if (!$this->id_unity) {
            self::$alertas['error']['id_unity'] = "La unidad es obligatoria";
        }
        return self::$alertas;
    }
}
