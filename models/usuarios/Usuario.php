<?php

namespace Usuarios;

use Model\ActiveRecord;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasBD = [
        "id",
        "user",
        "lastname",
        "phone",
        "address",
        "reference",
        "id_colony",
        "id_locality",
        "id_zone",
        "block",
        "int_num",
        "ext_num",
        "mail",
        "rfc",
        "clave_elector",
        "id_usertype",
        "id_intaketype",
        "id_servicetype",
        "id_servicestatus",
        "id_consumtype",
        "id_userStorage",
        "storage_height",
        "inhabitants",
        "stored_water",
        "id_type_peson",
        "drain",
        "adeudos"
    ];

    public $id;
    public $user;
    public $lastname;
    public $phone;
    public $address;
    public $reference;
    public $id_colony;
    public $id_locality;
    public $id_zone;
    public $block;
    public $int_num;
    public $ext_num;
    public $mail;
    public $rfc;
    public $clave_elector;
    public $id_usertype;
    public $id_intaketype;
    public $id_servicetype;
    public $id_servicestatus;
    public $id_consumtype;
    public $id_userStorage;
    public $storage_height;
    public $inhabitants;
    public $stored_water;
    public $id_type_peson;
    public $drain;
    public $adeudos;

    public function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->user = $arg['user'] ?? "";
        $this->lastname = $arg['lastname'] ?? "";
        $this->phone = $arg['phone'] ?? "";
        $this->address = $arg['address'] ?? "";
        $this->reference = $arg['reference'] ?? "";
        $this->id_colony = $arg['id_colony'] ?? "";
        $this->id_locality = $arg['id_locality'] ?? "";
        $this->id_zone = $arg['id_zone'] ?? "";
        $this->block = $arg['block'] ?? "";
        $this->int_num = $arg['int_num'] ?? "";
        $this->ext_num = $arg['ext_num'] ?? "";
        $this->mail = $arg['mail'] ?? "";
        $this->rfc = $arg['rfc'] ?? "";
        $this->clave_elector = $arg['clave_elector'] ?? "";
        $this->id_usertype = $arg['id_usertype'] ?? "";
        $this->id_intaketype = $arg['id_intaketype'] ?? "";
        $this->id_servicetype = $arg['id_servicetype'] ?? "";
        $this->id_servicestatus = $arg['id_servicestatus'] ?? "";
        $this->id_consumtype = $arg['id_consumtype'] ?? "";
        $this->id_userStorage = $arg['id_userStorage'] ?? "";
        $this->storage_height = $arg['storage_height'] ?? "";
        $this->inhabitants = $arg['inhabitants'] ?? "";
        $this->stored_water = $arg['stored_water'] ?? "";
        $this->id_type_peson = $arg['id_type_peson'] ?? "";
        $this->drain = $arg['drain'] ?? null;
        $this->adeudos = $arg['adeudo'] ?? 0;
    }

    public static function getAllUniques($id = '')
    {
        $query = "SELECT `id`, CONCAT(`user` , ' ' , `lastname`) AS nombre, `address` as direccion FROM " . self::$tabla;
        $id ? $query .= " WHERE id = $id LIMIT 1" : '';
        $consulta = self::$db->query($query);

        $res = [];
        while ($row = $consulta->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }
}
