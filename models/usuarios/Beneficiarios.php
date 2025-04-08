<?php

namespace Usuarios;

use Model\ActiveRecord;

class Beneficiarios extends ActiveRecord
{
    protected static $tabla = 'beneficiaries';
    protected static $columnasDB = ['id', 'name', 'lastname', 'email', 'phone', 'relationship', 'clave_elector', 'id_user'];

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $phone;
    public $relationship;
    public $clave_elector;
    public $id_user;

    public function __construct($args = [])
    {
        $this->id = isset($args['id']) ?? null;
        $this->name = isset($args['name']) ?? '';
        $this->lastname = isset($args['lastname']) ?? '';
        $this->email = isset($args['email']) ?? '';
        $this->phone = isset($args['phone']) ?? '';
        $this->relationship = isset($args['relationship']) ?? '';
        $this->clave_elector = isset($args['clave_elector']) ?? '';
        $this->id_user = isset($args['id_user']) ?? '';
    }
}
