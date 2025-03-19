<?php

namespace Facturacion;

use Model\ActiveRecord;

class Facturacion extends ActiveRecord
{
    protected static $tabla = 'facturacion';
    protected static $columnasDB = ['id', 'id_user', 'year', 'mes', 'monto_agua', 'estado', 'folio', 'if_recargo'];

    public $id;
    public $id_user;
    public $year;
    public $mes;
    public $monto_agua;
    public $estado;
    public $folio;
    public $if_recargo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->year = $args['year'] ?? "";
        $this->mes = $args['mes'] ?? "";
        $this->monto_agua = $args['monto_agua'] ?? "";
        $this->estado = $args['estado'] ?? null;
        $this->folio = $args['folio'] ?? null;
        $this->if_recargo = $args['if_recargo'] ?? null;
    }

    public static function pagarTodo($id_user, $folio)
    {
        $query = "UPDATE " . self::$tabla . " SET estado = '1', folio = '{$folio}' WHERE id_user = '{$id_user}' AND estado = '0'";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function pagarParcial($folio, $id_user, $mesI, $mesF, $year1, $year2)
    {
        if ($year1 == $year2) {
            $query = "UPDATE facturacion 
                      SET estado = '1', folio = {$folio} 
                      WHERE id_user = {$id_user} 
                      AND `year` = {$year1} 
                      AND `mes` BETWEEN {$mesI} AND {$mesF};";
        } else {
            $query = "UPDATE facturacion 
                      SET estado = '1', folio = {$folio} 
                      WHERE id_user = {$id_user} 
                      AND ((`year` = {$year1} AND `mes` >= {$mesI}) 
                      OR (`year` = {$year2} AND `mes` <= {$mesF}));";
        }

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function pagarUno($id_user, $folio, $mes, $year)
    {
        $query = "UPDATE " . self::$tabla . " SET estado = '1', folio = '{$folio}' WHERE id_user = '{$id_user}' AND estado = '0' AND mes = '{$mes}' AND year = '{$year}'";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function condoneTo($arguments)
    {
        $processSuccess = true;
        foreach($arguments as &$arg) :
            $query = "UPDATE " .self::$tabla. " SET estado = 4 WHERE id = {$arg};";
            $resultado = self::$db->query($query);

            !$resultado ? $processSuccess = false : $processSuccess = true;
        endforeach;

        return $processSuccess;
    }

    public static function condonarUno($id_user, $mes, $year)
    {
        $query = "UPDATE facturacion SET estado = '4' WHERE id_user = {$id_user} AND `mes` = {$mes} AND `year` = {$year};";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function getIdBetween($start, $end, $limit, $offset)
    {
        $query = "SELECT id_user FROM " . self::$tabla . " GROUP BY id_user HAVING SUM(if_recargo) BETWEEN {$start} AND {$end} LIMIT {$limit} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function getIdBetweenUpp($top, $limit, $offset)
    {
        $query = "SELECT id_user FROM " . self::$tabla . " GROUP BY id_user HAVING SUM(if_recargo) > {$top} LIMIT {$limit} OFFSET {$offset}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function totalIdBetween($start, $end)
    {
        $query = "SELECT COUNT(*) AS total FROM (SELECT id_user FROM " . self::$tabla . " GROUP BY id_user HAVING SUM(if_recargo) BETWEEN {$start} AND {$end}) AS subConsulta";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    public static function totalIdBetweenUpp($top)
    {
        $query = "SELECT COUNT(*) AS total FROM (SELECT id_user FROM " . self::$tabla . " GROUP BY id_user HAVING SUM(if_recargo) > {$top}) AS subConsulta";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    public static function actualizarRezago($year, $mes)
    {
        $m = intval($mes) - 1;
        $query = "UPDATE " . self::$tabla . " SET if_recargo = 1 WHERE `year` = $year AND mes = $m AND estado = 0 AND if_recargo != 1";
        $res = self::$db->query($query);

        $filas = self::$db->affected_rows;
        return [$res, $filas];
    }

    public static function validarRezagados($mes, $year) {
        $query = "SELECT COUNT(*) FROM " . self::$tabla . " WHERE `year` = $year AND mes = $mes AND if_recargo = 0";
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    public static function obtenerCondonaciones($id) {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_user = $id AND estado = 4 ORDER BY id DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function deshacerCondonaciones($id) {
        $query = "UPDATE " . self::$tabla . " SET estado = 0 WHERE id = $id";
        $resultado = self::$db->query($query);

        return $resultado;
    }
}
