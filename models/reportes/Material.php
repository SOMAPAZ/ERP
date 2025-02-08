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
        'id_material',
        'id_employee',
        'created'
    ];

    public $id;
    public $id_report;
    public $quantity;
    public $id_unity;
    public $id_material;
    public $id_employee;
    public $created;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_report = $args['id_report'] ?? null;
        $this->quantity = $args['quantity'] ?? null;
        $this->id_unity = $args['id_unity'] ?? null;
        $this->id_material = $args['id_material'] ?? null;
        $this->id_employee = $args['id_employee'] ?? null;
        $this->created = $args['created'] ?? '';
    }
}
