<?php

namespace Facturacion;

use Model\ActiveRecord;

class TomaConsumo extends ActiveRecord
{

    protected static $tabla = 'consume_intake';
    protected static $columnasDB = ['id', 'id_intaketype', 'id_consumtype'];

    public $id;
    public $id_intaketype;
    public $id_consumtype;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_intaketype = $args['id_intaketype'] ?? null;
        $this->id_consumtype = $args['id_consumtype'] ?? null;
    }
}
