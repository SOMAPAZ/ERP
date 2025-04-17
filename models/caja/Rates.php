<?php

namespace Facturacion;

use Model\ActiveRecord;

class Rates extends ActiveRecord
{

    protected static $tabla = 'rates';
    protected static $columnasDB = ['id', 'id_consum_intake', 'year', 'amount', 'iva'];

    public $id;
    public $id_consum_intake;
    public $year;
    public $amount;
    public $iva;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_consum_intake = $args['id_consum_intake'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->amount = $args['amount'] ?? 0;
        $this->iva = $args['iva'] ?? null;
    }
}
