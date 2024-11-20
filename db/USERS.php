<?php

namespace Model;

use Model\ActiveRecord;

class Users extends ActiveRecord
{

    protected static $table = 'users';
    protected static $columnasBD = [
        'id',
        'nombre',
        'telefono',
        'direccion',
        'correo',
        'rfc',
        'clave',
        'colonia',
        'localidad',
        'zona',
        'tipo_usuario',
        'toma_consumo',
        'tipo_servicio',
        'estado_servicio',
    ];

    public $id;
    public $nombre;
    public $telefono;
    public $direccion;
    public $correo;
    public $rfc;
    public $clave;
    public $colonia;
    public $localidad;
    public $zona;
    public $tipo_usuario;
    public $toma_consumo;
    public $tipo_servicio;
    public $estado_servicio;

    function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? "";
        $this->telefono = $arg['telefono'] ?? "";
        $this->direccion = $arg['direccion'] ?? "";
        $this->correo = $arg['correo'] ?? "";
        $this->rfc = $arg['rfc'] ?? "";
        $this->clave = $arg['clave'] ?? "";
        $this->colonia = $arg['colonia'] ?? "";
        $this->localidad = $arg['localidad'] ?? "";
        $this->zona = $arg['zona'] ?? "";
        $this->tipo_usuario = $arg['tipo_usuario'] ?? "";
        $this->toma_consumo = $arg['toma_consumo'] ?? "";
        $this->tipo_servicio = $arg['tipo_servicio'] ?? "";
        $this->estado_servicio = $arg['estado_servicio'] ?? "";
    }

    public function consultar()
    {
        $query = "SELECT users.id, CONCAT(users.user , ' ', users.lastname ) AS nombre, users.phone as telefono, users.address as direccion,";
        $query .= "users.mail as correo, users.rfc as rfc, users.clave_elector as clave,";
        $query .= "colony.name as colonia, locality.name as localidad, zone.name as zona,";
        $query .= "user_type.name as tipo_usuario, CONCAT(intake_type.name ,' - ' ,consume_type.name ) as toma_consumo,";
        $query .= "service_type.name as tipo_servicio ,service_status.name as estado_servicio";
        $query .= " FROM users";
        $query .= " LEFT OUTER JOIN colony ON users.id_colony = colony.id";
        $query .= " LEFT OUTER JOIN locality ON users.id_locality = locality.id";
        $query .= " LEFT OUTER JOIN zone ON users.id_zone = zone.id";
        $query .= " LEFT OUTER JOIN user_type ON users.id_usertype = user_type.id";
        $query .= " LEFT OUTER JOIN intake_type ON users.id_intaketype = intake_type.id";
        $query .= " LEFT OUTER JOIN consume_type ON users.id_consumtype = consume_type.id";
        $query .= " LEFT OUTER JOIN service_type ON users.id_servicetype = service_type.id";
        $query .= " LEFT OUTER JOIN service_status ON users.id_servicestatus = service_status.id";

        $resultado = self::consultaJoin($query);

        return $resultado;
    }
}
