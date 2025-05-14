<?php

namespace Facturacion;

use Model\ActiveRecord;

class PercentajeDrain extends ActiveRecord
{
    protected static $tabla = 'percentaje_drain';
    protected static $columnasDB = ['id', 'year', 'percentaje'];

    public $id;
    public $year;
    public $percentaje;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->year = $args['year'] ?? date('Y');
        $this->percentaje = $args['percentaje'] ?? '';
    }
}
