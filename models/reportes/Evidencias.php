<?php

namespace Reportes;

use Model\ActiveRecord;

class Evidencias extends ActiveRecord
{
    protected static $tabla = 'evidences';
    protected static $columnasDB = ['id', 'id_report', 'image'];

    public $id;
    public $id_report;
    public $image;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_report = $args['id_report'] ?? '';
        $this->image = $args['image'] ?? '';
    }
}
