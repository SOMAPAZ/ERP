<?php

namespace APIs;

use Model\ActiveRecord;

class BeneficiarioApi extends ActiveRecord
{
    protected static $tabla = 'beneficiaries';

    protected static $columnasDB = [
        'id',
        'name',
        'lastname',
        'email',
        'phone',
        'relationship',
        'clave_elector',
        'id_user',
    ];


    public $id;
    public $name;
    public $lastname;
    public $email;
    public $phone;
    public $relationship;
    public $clave_elector;
    public $id_user;
    function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->name = $arg['name'] ?? null;
        $this->lastname = $arg['lastname'] ?? null;
        $this->email = $arg['email'] ?? null;
        $this->phone = $arg['phone'] ?? null;
        $this->relationship = $arg['relationship'] ?? null;
        $this->clave_elector = $arg['clave_elector'] ?? null;
        $this->id_user = $arg['id_user'] ?? null;
    }

    public static function obtenerPorUsuario($id_user)
    {
        $query = "SELECT * FROM beneficiario WHERE id_user = ? LIMIT 1";
        $stmt = self::$db->prepare($query);

        if (!$stmt) {
            throw new \Exception('Error preparando la consulta: ' . self::$db->error);
        }

        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        }

        return null;
    }
}
