<?php

namespace Empleados;

use Model\ActiveRecord;

class Empleado extends ActiveRecord
{
    protected static $tabla = 'employments';
    protected static $columnasDB = ['id', 'name', 'lastname', 'mail', 'phone', 'password', 'id_rol', 'token', 'validado'];

    public $id;
    public $name;
    public $lastname;
    public $mail;
    public $phone;
    public $password;
    public $password_confirmation;
    public $id_rol;
    public $token;
    public $validado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->mail = $args['mail'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password_confirmation = $args['password_confirmation'] ?? '';
        $this->id_rol = $args['id_rol'] ?? null;
        $this->token = $args['token'] ?? '';
        $this->validado = $args['validado'] ?? null;
    }

    public function validarLogin()
    {
        if (!$this->mail) {
            self::$alertas['error'][] = 'Email es requerido';
        }

        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no es valido';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'Password es requerido';
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->mail) {
            self::$alertas['error'][] = 'Email es requerido';
        }

        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no es valido';
        }

        return self::$alertas;
    }

    public function generarToken()
    {
        $this->token = uniqid();
    }

    public function validarPassword()
    {
        if (!$this->password || !$this->password_confirmation) {
            self::$alertas['error'][] = 'Ambos campos son requeridos';
        }

        if ($this->password !== $this->password_confirmation) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}
