<?php

namespace Facturacion;
use Model\ActiveRecord;

class Cuentas extends ActiveRecord
{
    protected static $tabla = 'cuentas';
    protected static $columnasDB = ['id', 'cuenta', 'cantidad', 'iva'];

    public $id;
    public $cuenta;
    public $cantidad;
    public $iva;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cuenta = $args['cuenta'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->year = $args['iva'] ?? null;
    }
}