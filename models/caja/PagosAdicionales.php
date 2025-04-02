<?php

namespace Facturacion;

use Model\ActiveRecord;

class PagosAdicionales extends ActiveRecord
{
    protected static $tabla = 'pagos_adicionales';
    protected static $columnasDB = ['id', 'id_user', 'nombre', 'direccion', 'id_cuenta', 'cantidad', 'cantidad_iva', 'tipo_pago', 'fecha', 'folio', 'id_empleado', 'cancelado', 'total', 'folio_corte'];

    public $id;
    public $id_user;
    public $nombre;
    public $direccion;
    public $id_cuenta;
    public $cantidad;
    public $cantidad_iva;
    public $tipo_pago;
    public $fecha;
    public $folio;
    public $id_empleado;
    public $cancelado;
    public $total;
    public $folio_corte;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->id_cuenta = $args['id_cuenta'] ?? null;
        $this->cantidad = $args['cantidad'] ?? '';
        $this->cantidad_iva = $args['cantidad_iva'] ?? '';
        $this->tipo_pago = $args['tipo_pago'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->folio = $args['folio'] ?? null;
        $this->id_empleado = $args['id_empleado'] ?? null;
        $this->cancelado = $args['cancelado'] ?? 0;
        $this->total = $args['total'] ?? 0;
        $this->folio_corte = $args['folio_corte'] ?? null;
    }

    public static function obtenerUltimoFolio()
    {
        $query = "SELECT folio FROM " . self::$tabla . " ORDER BY folio DESC LIMIT 1;";
        $resultado = self::consultaJoin($query);

        return array_shift($resultado);
    }
}
