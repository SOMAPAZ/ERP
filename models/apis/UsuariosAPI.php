<?php

namespace APIs;

use Model\ActiveRecord;

class UsuariosAPI extends ActiveRecord
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
        'id_tipo_toma',
        'toma_consumo',
        'tipo_servicio',
        'estado_servicio',
        'estado_servicio_id',
        'drenaje',
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
    public $id_tipo_toma;
    public $toma_consumo;
    public $tipo_servicio;
    public $estado_servicio;
    public $estado_servicio_id;
    public $drenaje;

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
        $this->id_tipo_toma = $arg['id_tipo_toma'] ?? "";
        $this->toma_consumo = $arg['toma_consumo'] ?? "";
        $this->tipo_servicio = $arg['tipo_servicio'] ?? "";
        $this->estado_servicio = $arg['estado_servicio'] ?? "";
        $this->estado_servicio_id = $arg['estado_servicio_id'] ?? null;
        $this->drenaje = $arg['drenaje'] ?? null;
    }

    public function consultar($where = null)
    {
        $query = "SELECT users.id, CONCAT(users.user , ' ', users.lastname ) AS nombre, users.phone as telefono, users.address as direccion,";
        $query .= "users.mail as correo, users.rfc as rfc, users.clave_elector as clave, users.drain as drenaje,";
        $query .= "colony.name as colonia, locality.name as localidad, zone.name as zona,";
        $query .= "user_type.name as tipo_usuario, intake_type.id as id_tipo_toma, CONCAT(intake_type.name ,' - ' ,consume_type.name ) as toma_consumo,";
        $query .= "service_type.name as tipo_servicio, service_status.name as estado_servicio, service_status.id as estado_servicio_id";
        $query .= " FROM users";
        $query .= " LEFT OUTER JOIN colony ON users.id_colony = colony.id";
        $query .= " LEFT OUTER JOIN locality ON users.id_locality = locality.id";
        $query .= " LEFT OUTER JOIN zone ON users.id_zone = zone.id";
        $query .= " LEFT OUTER JOIN user_type ON users.id_usertype = user_type.id";
        $query .= " LEFT OUTER JOIN intake_type ON users.id_intaketype = intake_type.id";
        $query .= " LEFT OUTER JOIN consume_type ON users.id_consumtype = consume_type.id";
        $query .= " LEFT OUTER JOIN service_type ON users.id_servicetype = service_type.id";
        $query .= " LEFT OUTER JOIN service_status ON users.id_servicestatus = service_status.id";

        !is_null($where) ? $query .= " WHERE users.id = $where LIMIT 1" : '';

        $resultado = self::consultaJoin($query);

        return $resultado;
    }

    public function validar()
    {
        if (!$this->id) {
            self::$alertas['error'][] = 'El campo no puede ir vacío';
        }

        if (!is_numeric($this->id)) {
            self::$alertas['error'][] = 'El valor ingresado es incorrecto';
        }

        return self::$alertas;
    }
}
