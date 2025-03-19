<?php

namespace Facturacion;
use Model\ActiveRecord;

class DerechosServicios extends ActiveRecord
{
    protected static $tabla = 'service_rights';
    protected static $columnasDB = ['id', 'id_service', 'id_intaketype', 'year', 'iva', 'amount'];

    public $id;
    public $id_service;
    public $id_intaketype;
    public $year;
    public $iva;
    public $amount;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_service = $args['id_service'] ?? null;
        $this->id_intaketype = $args['id_intaketype'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->iva = $args['iva'] ?? null;
        $this->amount = $args['amount'] ?? 0;
    }
}