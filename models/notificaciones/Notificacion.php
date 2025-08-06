<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Notificacion extends ActiveRecord
{
    protected static $tabla = 'notificaciones';
    protected static $columnasDB = [
        'idx',
        'id_user',
        'meses_rezagados',
        'total',
        'id_status',
        'comentarios',
        'id_tiponotificacion',
        'evidencias',
        'fecha_guardada',
        'fecha_reporte',
        'costo',
        'id_employment'
    ];

    public $idx;
    public $id_user;
    public $meses_rezagados;
    public $total;
    public $id_status;
    public $comentarios;
    public $id_tiponotificacion;
    public $evidencias;
    public $fecha_guardada;
    public $fecha_reporte;
    public $costo;
    public $id_employment;

    public function __construct($args = [])
    {
        $this->idx = $args['idx'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->meses_rezagados = $args['meses_rezagados'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->id_status = $args['id_status'] ?? null;
        $this->comentarios = $args['comentarios'] ?? null;
        $this->id_tiponotificacion = $args['id_tiponotificacion'] ?? null;
        $this->evidencias = $args['evidencias'] ?? null;
        $this->fecha_guardada = $args['fecha_guardada'] ?? null;
        $this->fecha_reporte = $args['fecha_reporte'] ?? null;
        $this->costo = $args['costo'] ?? null;
        $this->id_employment = $args['id_employment'] ?? null;
    }
    public function eliminar()
    {
        $query = "DELETE FROM notificaciones WHERE id_user = ? AND id_status = '1'";
        $stmt = self::$db->prepare($query);

        $stmt->bind_param("i", $this->id_user);
        return $stmt->execute();
    }
    public function actualizar()
    {
        if (is_null($this->idx)) {
            throw new \Exception('No se puede actualizar sin el ID de la notificación');
        }

        $anno = date('Y');
        $mes = date('m');
        $this->idx = 'NOT/' . $anno . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-' . str_pad($this->idx, 4, '0', STR_PAD_LEFT);

        $query = "UPDATE notificaciones SET comentarios = ?, id_tiponotificacion = ?, evidencias = ?, fecha_reporte = ?, id_status = ?, costo = ? WHERE idx = ?";

        $stmt = self::$db->prepare($query);

        if ($stmt === false) {
            throw new \Exception('Error en la preparación de la consulta: ' . self::$db->error);
        }

        $stmt->bind_param("ssssiss", $this->comentarios, $this->id_tiponotificacion, $this->evidencias, $this->fecha_reporte, $this->id_status, $this->costo, $this->idx);

        if (!$stmt->execute()) {
            throw new \Exception('Error al ejecutar la actualización: ' . $stmt->error);
        }


        return true;
    }




    public static function obtenerUltimoFolio()
    {
        $query = "SELECT idx FROM " . self::$tabla . " ORDER BY idx DESC LIMIT 1;";
        $resultado = self::consultaJoin($query);

        return $resultado ? (int) substr($resultado[0]->idx, -3) : 0;
    }
    public static function obtenerNombreStatus($id_status)
    {
        $query = "SELECT name FROM status_report WHERE id = ?";
        $stmt = self::$db->prepare($query);

        if ($stmt === false) {
            throw new \Exception('Error en la preparación de la consulta: ' . self::$db->error);
        }

        $stmt->bind_param("i", $id_status);

        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_assoc();

        return $resultado ? $resultado['name'] : 'Desconocido';
    }
    public static function obtenerTipoNotificacion($id_tiponotificacion)
    {
        $query = "SELECT name FROM tipo_notificacion WHERE id = ?";
        $stmt = self::$db->prepare($query);

        if ($stmt === false) {
            throw new \Exception('Error en la preparación de la consulta: ' . self::$db->error);
        }

        $stmt->bind_param("i", $id_tiponotificacion);

        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_assoc();

        return $resultado ? $resultado['name'] : 'Desconocido';
    }
    public static function NotRegistrada($id_user)
    {
        $query = "SELECT * FROM notificaciones WHERE id_user = ? AND fecha_reporte IS NULL";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
    public static function buscar($id_user)
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE id_user = {$id_user}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function buscarPorUsuario($id_user)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_user = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_object();

        return $resultado;
    }
    public static function actualizarFechaReporte($idNotificacion, $fecha)
    {
        $query = "SELECT idx FROM notificaciones 
              WHERE id_user = ? 
              AND (fecha_pago IS NULL OR fecha_pago = '0000-00-00 00:00:00') 
              ORDER BY fecha_reporte DESC 
              LIMIT 1";
        $stmt = self::$db->prepare($query);
        $stmt->execute([$idNotificacion]);
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        if ($fila) {
            $idx = $fila['idx'];
            $update = "UPDATE notificaciones SET fecha_pago = ? WHERE idx = ?";
            $stmtUpdate = self::$db->prepare($update);
            return $stmtUpdate->execute([$fecha, $idx]);
        }

        return false;
    }
     public static function notRealizadas()
    {
        $query = "SELECT * FROM notificaciones WHERE DATE(fecha_reporte) = CURDATE();
";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function finds($idx)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE idx = '" . self::$db->real_escape_string($idx) . "' LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}
