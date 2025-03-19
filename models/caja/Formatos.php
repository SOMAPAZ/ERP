<?php

namespace Facturacion;
use Model\ActiveRecord;

class Formatos extends ActiveRecord
{
    protected static $tabla = 'formats';
    protected static $columnasDB = ['id', 'id_account', 'year', 'amount', 'iva'];

    public $id;
    public $id_account;
    public $year;
    public $amount;
    public $iva;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_account = $args['id_account'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->amount = $args['amount'] ?? 0;
        $this->iva = $args['iva'] ?? null;
    }
}