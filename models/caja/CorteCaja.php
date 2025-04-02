<?php

namespace Facturacion;

use Model\ActiveRecord;

class CorteCaja extends ActiveRecord
{
    protected static $tabla = 'corte_caja';
    protected static $columnasDB = ['id', 'entrega', 'recibe', 'denominaciones', 'total_usuario', 'total_sistema', 'testigo', 'fecha', 'hora', 'folio'];

    public $id;
    public $entrega;
    public $recibe;
    public $denominaciones;
    public $total_usuario;
    public $total_sistema;
    public $testigo;
    public $fecha;
    public $hora;
    public $folio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->entrega = $args['entrega'] ?? '';
        $this->recibe = $args['recibe'] ?? '';
        $this->denominaciones = $args['denominaciones'] ?? '';
        $this->total_usuario = $args['total_usuario'] ?? 0;
        $this->total_sistema = $args['total_sistema'] ?? 0;
        $this->testigo = $args['testigo'] ?? '';
        $this->fecha = $args['fecha'] ?? null;
        $this->hora = $args['hora'] ?? null;
        $this->folio = $args['folio'] ?? null;
    }

    public function validar()
    {
        if (!$this->entrega) {
            self::$alertas['error'][] = 'Es requerido la persona que entrega';
        }

        if (!$this->recibe) {
            self::$alertas['error'][] = 'Es requerido la persona que recibe';
        }

        if (!$this->total_usuario) {
            self::$alertas['error'][] = 'Es requerido la cantidad de denominaciones';
        }

        if (!$this->total_sistema) {
            self::$alertas['error'][] = 'Es requerido el total del sistema';
        }

        if (!$this->testigo) {
            self::$alertas['error'][] = 'Es requerido el testigo';
        }

        return self::$alertas;
    }
}
