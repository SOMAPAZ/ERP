<?php

namespace Model;

class ActiveRecord
{

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas()
    {
        return static::$alertas;
    }

    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            if ($value !== null) {
                $sanitizado[$key] = self::$db->escape_string($value);
            } else {
                $sanitizado[$key] = $value;
            }
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar()
    {
        $resultado = '';
        if (!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Buscar por colunma y valor
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function offset($limit, $offset)
    {
        $query = "SELECT * FROM " . static::$tabla  . " ORDER BY id ASC LIMIT {$limit} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function total()
    {
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    public static function totalWhere($columna, $valor)
    {
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    //Buscar tadas las coincidencias
    public static function belongsTo($columna, $valor, $orderBy = '')
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}' ";
        if ($orderBy !== '') $query .= " ORDER BY id {$orderBy} ";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function belongsToDeuda($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}' ORDER BY `year`, mes";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function belongsToDesc($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}' ORDER BY id DESC";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function belongsToPaginacion($columna, $valor, $offset, $limit)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE {$columna} = '{$valor}' ORDER BY id DESC LIMIT {$limit} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Consultar datos con Join
    public static function consultaJoin($query)
    {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // crea un nuevo registro
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Actualizar el registro
    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar()
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function obtenerPagosCorte($indice, $empleado, $tipo = "")
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE `{$indice}` = '{$empleado}' AND cancelado = 0 AND (folio_corte IS NULL OR folio_corte = '')";
        if ($tipo) {
            $query .= " AND tipo_pago = '{$tipo}'";
        }
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function asignarFolioCorte($folio, $folio_corte)
    {
        $query = "UPDATE " . static::$tabla . " SET folio_corte = '{$folio_corte}' WHERE folio = '{$folio}'";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function removerFolioCorte($folio)
    {
        $query = "UPDATE " . static::$tabla . " SET folio_corte = null WHERE folio = '{$folio}'";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function eliminarFolios($folio)
    {
        $query = "UPDATE " . static::$tabla . " SET cancelado = 1 WHERE folio = {$folio}";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    
        public static function paginar($por_pagina, $offset, $order = 'DESC')
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$order} LIMIT {$por_pagina} OFFSET {$offset} ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
        public static function whereArray($array = [])
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";
        foreach ($array as $key => $value) {
            if ($key === array_key_last($array)) {
                $query .= "{$key} = '{$value}'";
            } else {
                $query .= "{$key} = '{$value}' AND ";
            }
        };

        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
