<?php

namespace APIs;

use Model\ActiveRecord;

class EmployeesAPI extends ActiveRecord
{
    protected static $tabla = 'employments';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'correo', 'telefono', 'rol', 'descripcion'];

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $rol;
    public $descripcion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->rol = $args['rol'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function consulta()
    {
        $query = 'SELECT employments.id AS id,
                employments.name AS nombre,
                employments.lastname AS apellido,
                employments.mail AS correo,
                employments.phone AS telefono,
                roles.name AS rol,
                roles.description AS descripcion
                FROM employments
                LEFT OUTER JOIN roles
                ON employments.id_rol = roles.id;';

        $resultado = self::consultaJoin($query);

        return $resultado;
    }
}
