<?php

namespace Convenios;

use Model\ActiveRecord;

class Convenios extends ActiveRecord
{
    protected static $tabla = 'convenios';
    protected static $columnasDB = [
        'id',
        'folio',
        'id_user',
        'id_pagos',
        'id_beneficiario',
        'anticipo',
        'descuento',
        'justificante',
        'deuda_total',
        'meses_rezagados',
        'fecha_registrada',
        'id_employment',
    ];

    public  $id;
    public  $folio;
    public  $id_user;
    public  $id_pagos;
    public  $id_beneficiario;
    public  $anticipo;
    public  $descuento;
    public  $justificante;
    public  $deuda_total;
    public  $meses_rezagados;
    public  $fecha_registrada;
    public  $id_employment;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->folio = $args['folio'] ?? null;
        $this->id_user = $args['id_user'] ?? '';
        $this->id_pagos = $args['id_pagos'] ?? null;
        $this->id_beneficiario = $args['id_beneficiario'] ?? null;
        $this->anticipo = $args['anticipo'] ?? null;
        $this->descuento = $args['descuento'] ?? null;
        $this->justificante = $args['justificante'] ?? null;
        $this->deuda_total = $args['deuda_total'] ?? null;
        $this->meses_rezagados = $args['meses_rezagados'] ?? null;
        $this->fecha_registrada = $args['fecha_registrada'] ?? null;
        $this->id_employment = $args['id_employment'] ?? null;
    }
}
