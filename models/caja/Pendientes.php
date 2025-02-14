<?php

namespace Facturacion;

use Model\ActiveRecord;

class Pendientes extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasBD = [
        "id",
        "user",
        "lastname",
        "address",
        "id_colony",
        "id_zone",
        "int_num",
        "ext_num",
        "id_usertype",
        "id_intaketype",
        "id_servicetype",
        "id_servicestatus",
        "id_consumtype",
        "drain",
        "adeudos"
    ];

    public $id;
    public $user;
    public $lastname;
    public $address;
    public $id_colony;
    public $id_zone;
    public $int_num;
    public $ext_num;
    public $id_usertype;
    public $id_intaketype;
    public $id_servicetype;
    public $id_servicestatus;
    public $id_consumtype;
    public $drain;
    public $adeudos;

    public function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->user = $arg['user'] ?? "";
        $this->lastname = $arg['lastname'] ?? "";
        $this->address = $arg['address'] ?? "";
        $this->id_colony = $arg['id_colony'] ?? null;
        $this->id_zone = $arg['id_zone'] ?? null;
        $this->int_num = $arg['int_num'] ?? null;
        $this->ext_num = $arg['ext_num'] ?? null;
        $this->id_usertype = $arg['id_usertype'] ?? null;
        $this->id_intaketype = $arg['id_intaketype'] ?? null;
        $this->id_servicetype = $arg['id_servicetype'] ?? null;
        $this->id_servicestatus = $arg['id_servicestatus'] ?? null;
        $this->id_consumtype = $arg['id_consumtype'] ?? null;
        $this->drain = $arg['drain'] ?? null;
        $this->adeudos = $arg['adeudo'] ?? 0;
    }

    public static function whoffset($limit, $offset, $where, $value)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$where} = '{$value}' ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function whtotal($where, $value)
    {
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE {$where} = '{$value}'";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }
}
