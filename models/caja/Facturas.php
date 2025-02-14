<?php

namespace Facturacion;

use Model\ActiveRecord;

class Facturas extends ActiveRecord
{
    protected static $tabla = 'facturas_historial';
    protected static $columnasDB = ['id', 'id_user', 'folio', 'fecha', 'mes_inicio', 'mes_fin', 'numero_meses', 'cancelado', 'monto_agua', 'monto_drenaje', 'monto_recargo_agua', 'monto_recargo_drenaje', 'monto_descuento_agua', 'monto_descuento_drenaje', 'monto_descuento_recargo_agua', 'monto_descuento_recargo_drenaje', 'monto_iva_agua', 'monto_iva_drenaje', 'total', 'tipo_pago', 'empleado_id'];

    public $id;
    public $id_user;
    public $folio;
    public $fecha;
    public $mes_inicio;
    public $mes_fin;
    public $numero_meses;
    public $cancelado;
    public $monto_agua;
    public $monto_drenaje;
    public $monto_recargo_agua;
    public $monto_recargo_drenaje;
    public $monto_descuento_agua;
    public $monto_descuento_drenaje;
    public $monto_descuento_recargo_agua;
    public $monto_descuento_recargo_drenaje;
    public $monto_iva_agua;
    public $monto_iva_drenaje;
    public $total;
    public $tipo_pago;
    public $empleado_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->folio = $args['folio'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->mes_inicio = $args['mes_inicio'] ?? "";
        $this->mes_fin = $args['mes_fin'] ?? "";
        $this->numero_meses = $args['numero_meses'] ?? "";
        $this->cancelado = $args['cancelado'] ?? 0;
        $this->monto_agua = $args['monto_agua'] ?? 0;
        $this->monto_drenaje = $args['monto_drenaje'] ?? 0;
        $this->monto_recargo_agua = $args['monto_recargo_agua'] ?? 0;
        $this->monto_recargo_drenaje = $args['monto_recargo_drenaje'] ?? 0;
        $this->monto_descuento_agua = $args['monto_descuento_agua'] ?? 0;
        $this->monto_descuento_drenaje = $args['monto_descuento_drenaje'] ?? 0;
        $this->monto_descuento_recargo_agua = $args['monto_descuento_recargo_agua'] ?? 0;
        $this->monto_descuento_recargo_drenaje = $args['monto_descuento_recargo_drenaje'] ?? 0;
        $this->monto_iva_agua = $args['monto_iva_agua'] ?? 0;
        $this->monto_iva_drenaje = $args['monto_iva_drenaje'] ?? 0;
        $this->total = $args['total'] ?? 0;
        $this->tipo_pago = $args['tipo_pago'] ?? null;
        $this->empleado_id = $args['empleado_id'] ?? null;
    }

    public static function obtenerUltimoFolio()
    {
        $query = "SELECT folio FROM " . self::$tabla . " ORDER BY folio DESC LIMIT 1;";
        $resultado = self::consultaJoin($query);

        return array_shift($resultado);
    }
}
