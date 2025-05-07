<?php

namespace Reportes;

use Model\ActiveRecord;

class Reporte extends ActiveRecord
{
    protected static $tabla = 'reports';
    protected static $columnasDB = [
        'id',
        'id_user',
        'name',
        'phone',
        'beneficiary',
        'address',
        'id_category',
        'id_incidence',
        'id_priority',
        'employee_id',
        'description',
        'id_employee_sup',
        'id_status',
        'created'
    ];

    public $id;
    public $id_user;
    public $name;
    public $phone;
    public $beneficiary;
    public $address;
    public $id_category;
    public $id_incidence;
    public $id_priority;
    public $employee_id;
    public $description;
    public $id_employee_sup;
    public $id_status;
    public $created;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? '';
        $this->name = $args['name'] ?? "";
        $this->phone = $args['phone'] ?? "";
        $this->beneficiary = $args['beneficiary'] ?? "";
        $this->address = $args['address'] ?? "";
        $this->id_category = $args['id_category'] ?? null;
        $this->id_incidence = $args['id_incidence'] ?? null;
        $this->id_priority = $args['id_priority'] ?? null;
        $this->employee_id = $args['employee_id'] ?? null;
        $this->description = $args['description'] ?? "";
        $this->id_employee_sup = $args['id_employee_sup'] ?? null;
        $this->id_status = $args['id_status'] ?? null;
        $this->created = $args['created'] ?? "";
    }

    public function validar()
    {
        if (!$this->name) {
            self::$alertas['error']['name'] = "El nombre del usuario es obligatorio";
        }
        if (!$this->phone) {
            self::$alertas['error']['phone'] = "El número de teléfono es obligatorio";
        }
        if (!$this->address) {
            self::$alertas['error']['address'] = "La dirección es obligatoria";
        }
        if (!$this->id_category) {
            self::$alertas['error']['id_category'] = "La categoría es obligatoria";
        }
        if (!$this->id_incidence) {
            self::$alertas['error']['id_incidence'] = "La incidencia es obligatoria";
        }
        if (!$this->id_priority) {
            self::$alertas['error']['id_priority'] = "La prioridad es obligatoria";
        }
        if (!$this->description) {
            self::$alertas['error']['description'] = "La descripción es obligatoria";
        }

        return self::$alertas;
    }

    public static function obtenerUltimoFolio()
    {
        $query = "SELECT id FROM " . self::$tabla . " ORDER BY id DESC LIMIT 1;";
        $resultado = self::consultaJoin($query);

        return array_shift($resultado);
    }

    public function crearReporte($id)
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( id, ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('{$id}', '";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminarReporte($id)
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '{$id}'";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function consultarCoincidenciasID($value)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id = '$value';";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarCoincidencias($value)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE name LIKE '%$value%' OR address LIKE '%$value%' OR phone LIKE '%$value%';";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function consultarCoincidenciasIds($id1, $id2)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_category = '$id1' AND id_incidence = '$id2';";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
