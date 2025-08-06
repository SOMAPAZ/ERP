<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Lecturas extends ActiveRecord
{
    protected static $tabla = 'medido';
    protected static $columnasDB = [
        'id',
        'id_user',
        'id_medidor',
        'id_status',
        'evidencias',
        'year',
        'mes',
        'lectura',
        'fecha_guardada',
        'fecha_reporte',
        'id_employment',
        'consumo_global'
    ];

    public $id;
    public $id_user;
    public $id_medidor;
    public $evidencias;
    public $year;
    public $mes;
    public $lectura;
    public $fecha_guardada;
    public $fecha_reporte;
    public $id_status;
    public $id_employment;
    public $consumo_global;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_user = $args['id_user'] ?? null;
        $this->id_medidor = $args['id_medidor'] ?? null;
        $this->evidencias = $args['evidencias'] ?? null;
        $this->year = $args['year'] ?? null;
        $this->mes = $args['mes'] ?? null;
        $this->lectura = $args['lectura'] ?? null;
        $this->fecha_guardada = $args['fecha_guardada'] ?? null;
        $this->fecha_reporte = $args['fecha_reporte'] ?? null;
        $this->id_status = $args['id_status'] ?? null;
        $this->id_employment = $args['id_employment'] ?? null;
        $this->consumo_global = $args['consumo_global'] ?? null;
    }

    public static function getLecturaDate($id_user, $year, $mes)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_user = '{$id_user}' AND year = '{$year}' AND mes = '{$mes}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function eliminarMedido()
    {
        $query = "DELETE FROM medido WHERE id_user = ? AND id_status = '1'";
        $stmt = self::$db->prepare($query);

        $stmt->bind_param("i", $this->id_user);
        return $stmt->execute();
    }

    public function actualizarMedido()
    {
        if (is_null($this->id)) {
            throw new \Exception('No se puede actualizar sin el ID de la lectura');
        }

        // Obtener medidor actual
        $consulta = "SELECT id_medidor FROM medido WHERE id = ?";
        $stmt = self::$db->prepare($consulta);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $registroActual = $resultado->fetch_assoc();

        if ($registroActual) {
            $this->id_medidor = $registroActual['id_medidor'];
        } else {
            throw new \Exception('No se encontró el registro a actualizar');
        }

        // Mes y año anterior
        if ($this->mes == 1) {
            $mesAnterior = 12;
            $yearAnterior = $this->year - 1;
        } else {
            $mesAnterior = $this->mes - 1;
            $yearAnterior = $this->year;
        }

        // Obtener lectura y medidor anterior
        $consulta = "SELECT lectura, id_medidor FROM medido WHERE id_user = ? AND mes = ? AND year = ? ORDER BY id DESC LIMIT 1";
        $stmt = self::$db->prepare($consulta);
        $stmt->bind_param("iii", $this->id_user, $mesAnterior, $yearAnterior);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        $lecturaAnterior = 0;
        $idMedidorAnterior = null;
        $consumoAnterior = 0;

        if ($fila) {
            $idMedidorAnterior = (int)$fila['id_medidor'];
            $lecturaAnterior = (float)$fila['lectura'];

            if ($this->id_medidor === $idMedidorAnterior && $this->lectura < $lecturaAnterior) {
                throw new \Exception('La lectura debe ser mayor que la del mes anterior si el medidor es el mismo.');
            }

            // Obtener consumo_global anterior
            $consulta = "SELECT consumo_global FROM medido WHERE id_user = ? AND mes = ? AND year = ? ORDER BY id DESC LIMIT 1";
            $stmt = self::$db->prepare($consulta);
            $stmt->bind_param("iii", $this->id_user, $mesAnterior, $yearAnterior);
            $stmt->execute();
            $resAc = $stmt->get_result();
            $filaAc = $resAc->fetch_assoc();
            if ($filaAc) $consumoAnterior = (float)$filaAc['consumo_global'];
        }

        // Calcular diferencia
        $diferencia = ($this->id_medidor === $idMedidorAnterior && $this->lectura >= $lecturaAnterior)
            ? $this->lectura - $lecturaAnterior
            : $this->lectura;
        // dd($diferencia);

        $this->consumo_global = $consumoAnterior + $diferencia;

        // Actualizar lectura
        $query = "UPDATE medido SET evidencias = ?, lectura = ?, fecha_reporte = ?, id_status = ?, year = ?, mes = ?, consumo_global = ? WHERE id = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("ssssisdi", $this->evidencias, $this->lectura, $this->fecha_reporte, $this->id_status, $this->year, $this->mes, $this->consumo_global, $this->id);

        return $stmt->execute();
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
    public static function LecRegistrada($id_user)
    {
        $query = "SELECT * FROM medido  WHERE id_user = ? AND fecha_reporte IS NULL";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
    public static function actualizarLectura($id_user, $year, $mes, $lectura)
    {
        $meses = [
            "ENERO" => 1,
            "FEBRERO" => 2,
            "MARZO" => 3,
            "ABRIL" => 4,
            "MAYO" => 5,
            "JUNIO" => 6,
            "JULIO" => 7,
            "AGOSTO" => 8,
            "SEPTIEMBRE" => 9,
            "OCTUBRE" => 10,
            "NOVIEMBRE" => 11,
            "DICIEMBRE" => 12
        ];

        $mesNumerico = $meses[strtoupper($mes)] ?? null;
        if ($mesNumerico === null) return false;

        $siguienteMes = $mesNumerico + 1;
        $siguienteYear = $year;
        if ($siguienteMes > 12) {
            $siguienteMes = 1;
            $siguienteYear++;
        }

        $stmtVerif = self::$db->prepare("SELECT lectura FROM medido WHERE id_user = ? AND year = ? AND mes = ?");
        $stmtVerif->bind_param("sii", $id_user, $siguienteYear, $siguienteMes);
        $stmtVerif->execute();
        $res = $stmtVerif->get_result();
        $row = $res->fetch_assoc();

        if ($row && $lectura > $row['lectura']) {
            return false;
        }

        $stmt = self::$db->prepare("UPDATE medido SET lectura = ? WHERE id_user = ? AND year = ? AND mes = ?");
        $stmt->bind_param("diss", $lectura, $id_user, $year, $mesNumerico);
        return $stmt->execute();
    }

    public static function obtenerMedidosSinMesAño()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE mes = '' OR year = ''";
        return self::consultarSQL($query);
    }
    public static function obtenerTodosLosMedidos()
    {
        return self::all();
    }
    public static function obtenerMesesConLectura($id_user, $año)
    {
        $query = "SELECT DISTINCT mes, lectura FROM " . self::$tabla . " WHERE id_user = ? AND year = ? ORDER BY mes ASC";

        $stmt = self::$db->prepare($query);

        $stmt->bind_param("ii", $id_user, $año);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $mesesConLectura = [];

        while ($row = $resultado->fetch_assoc()) {
            $mesesConLectura[] = [
                'mes' => $row['mes'],
                'lectura' => $row['lectura']
            ];
        }

        return $mesesConLectura;
    }
    public static function finds($id_user, $mes = null, $year = null)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id_user = '" . self::$db->real_escape_string($id_user) . "'";
        if ($mes) {
            $query .= " AND mes = '" . self::$db->real_escape_string($mes) . "'";
        }
        if ($year) {
            $query .= " AND year = '" . self::$db->real_escape_string($year) . "'";
        }
        return self::consultarSQL($query);
    }
}
