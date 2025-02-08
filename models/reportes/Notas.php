<?php

namespace Reportes;

use Model\ActiveRecord;

class Notas extends ActiveRecord
{
    protected static $tabla = 'notes_reports';
    protected static $columnasDB = ['id', 'id_report', 'note', 'image', 'employee_id', 'created'];

    public $id;
    public $id_report;
    public $note;
    public $image;
    public $employee_id;
    public $created;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_report = $args['id_report'] ?? null;
        $this->note = $args['note'] ?? "";
        $this->image = $args['image'] ?? "";
        $this->employee_id = $args['employee_id'] ?? null;
        $this->created = $args['created'] ?? "";
    }
}
