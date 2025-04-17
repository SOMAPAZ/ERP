<?php

namespace Usuarios;

use Model\ActiveRecord;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasDB = [
        "id",
        "user",
        "lastname",
        "phone",
        "address",
        "lat",
        "lng",
        "reference",
        "image",
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
        "id_type_person",
        "drain",
        "id_observaciones",
        "token_registro"
    ];

    public $id;
    public $user;
    public $lastname;
    public $phone;
    public $address;
    public $lat;
    public $lng;
    public $reference;
    public $image;
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
    public $id_type_person;
    public $drain;
    public $id_observaciones;
    public $token_registro;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user = $args['user'] ?? "";
        $this->lastname = $args['lastname'] ?? "";
        $this->phone = $args['phone'] ?? "";
        $this->address = $args['address'] ?? "";
        $this->lat = $args['lat'] ?? "";
        $this->lng = $args['lng'] ?? "";
        $this->reference = $args['reference'] ?? "";
        $this->image = $args['image'] ?? "";
        $this->id_colony = $args['id_colony'] ?? "";
        $this->id_locality = $args['id_locality'] ?? "";
        $this->id_zone = $args['id_zone'] ?? "";
        $this->block = $args['block'] ?? "";
        $this->int_num = $args['int_num'] ?? "";
        $this->ext_num = $args['ext_num'] ?? "";
        $this->mail = $args['mail'] ?? "";
        $this->rfc = $args['rfc'] ?? "";
        $this->clave_elector = $args['clave_elector'] ?? "";
        $this->id_usertype = $args['id_usertype'] ?? "";
        $this->id_intaketype = $args['id_intaketype'] ?? "";
        $this->id_servicetype = $args['id_servicetype'] ?? "";
        $this->id_servicestatus = $args['id_servicestatus'] ?? "";
        $this->id_consumtype = $args['id_consumtype'] ?? "";
        $this->id_userStorage = $args['id_userStorage'] ?? 0;
        $this->storage_height = $args['storage_height'] ?? 0;
        $this->inhabitants = $args['inhabitants'] ?? 1;
        $this->stored_water = $args['stored_water'] ?? 0;
        $this->id_type_person = $args['id_type_person'] ?? null;
        $this->drain = $args['drain'] ?? 0;
        $this->id_observaciones = $args['id_observaciones'] ?? 0;
        $this->token_registro = $args['token_registro'] ?? 0;
    }

    public function validar()
    {
        if (!$this->user) {
            self::$alertas['error']['name'] = 'El nombre es obligatorio';
        }
        if (!$this->lastname) {
            self::$alertas['error']['lastname'] = 'El apellido es obligatorio';
        }
        if (!$this->address) {
            self::$alertas['error']['address'] = 'La dirección es obligatoria';
        }
        if (!$this->id_colony) {
            self::$alertas['error']['id_colony'] = 'Colonia requerida';
        }
        if (!$this->id_zone) {
            self::$alertas['error']['id_zone'] = 'Zona requerida';
        }
        if (!$this->id_usertype) {
            self::$alertas['error']['id_usertype'] = 'Tipo de usuario requerido';
        }
        if (!$this->id_intaketype) {
            self::$alertas['error']['id_intaketype'] = 'Tipo de toma requerido';
        }
        if (!$this->id_servicetype) {
            self::$alertas['error']['id_servicetype'] = 'Tipo de servicio requerido';
        }
        if (!$this->id_servicestatus) {
            self::$alertas['error']['id_servicestatus'] = 'Tipo de servicio requerido';
        }
        if (!$this->id_consumtype) {
            self::$alertas['error']['id_consumtype'] = 'Tipo de consumo requerido';
        }
        if (!$this->id_type_person) {
            self::$alertas['error']['id_type_person'] = 'Tipo de persona requerido';
        }

        return self::$alertas;
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

    public function cancelar()
    {
        $query = "UPDATE "  . static::$tabla . " SET id_servicestatus = 3 WHERE id = " . self::$db->escape_string($this->id);
        $resultado = self::$db->query($query);
        return $resultado;
    }
}
