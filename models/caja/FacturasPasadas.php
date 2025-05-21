<?php

namespace Facturacion;

use Model\ActiveRecord;

class FacturasPasadas extends ActiveRecord
{
    protected static $tabla = 'facturas_anterior';
    protected static $columnasDB = ['id', 'id_user', 'folio', 'date_invoice', 'date_initial', 'date_final', 'amount', 'id_cancelado'];

    public $id;
    public $id_user;
    public $folio;
    public $date_invoice;
    public $date_initial;
    public $date_final;
    public $amount;
    public $id_cancelado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->folio = $args['folio'] ?? null;
        $this->date_invoice = $args['date_invoice'] ?? null;
        $this->date_initial = $args['date_initial'] ?? null;
        $this->date_final = $args['date_final'] ?? null;
        $this->amount = $args['amount'] ?? null;
        $this->id_cancelado = $args['id_cancelado'] ?? 0;
    }

    public static function obtenerUltimoFolio()
    {
        $query = "SELECT folio FROM " . self::$tabla . " ORDER BY folio DESC LIMIT 1;";
        $resultado = self::consultaJoin($query);

        return array_shift($resultado);
    }
}
