<?php

namespace Facturacion;

use Model\ActiveRecord;

class Measured extends ActiveRecord {

    protected static $tabla = 'measured';
    protected static $columnasDB = ['id', 'id_intaketype', 'id_consumtype', 'year', 'amount', 'iva', 'liminf', 'limsup', 'excm3', 'iva_exc'];

    public $id;
    public $id_intaketype;
    public $id_consumtype;
    public $year;
    public $amount;
    public $iva;
    public $liminf;
    public $limsup;
    public $excm3;
    public $iva_exc;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_intaketype = $args['id_intaketype'] ?? null;
        $this->id_consumtype = $args['id_consumtype'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->amount = $args['amount'] ?? null;
        $this->iva = $args['iva'] ?? null;
        $this->liminf = $args['liminf'] ?? null;
        $this->limsup = $args['limsup'] ?? null;
        $this->excm3 = $args['excm3'] ?? null;
        $this->iva_exc = $args['iva_exc'] ?? null;
    }

    public static function obtenerLimites($idIntaketype, $idConsumtype, $year){
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_intaketype = '{$idIntaketype}' AND id_consumtype = '{$idConsumtype}' AND year = '{$year}'";

        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}