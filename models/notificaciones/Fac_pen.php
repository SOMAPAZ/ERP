<?php

namespace Notificaciones;

use Model\ActiveRecord;

class Fac_pen extends ActiveRecord
{
    protected static $tabla = 'fac_pen';
    protected static $columnasDB = [
        'id',
        'nombre',
        'direccion',
        'zona',
        'colonia',
        'tipo_toma',
        'tipo_consumo',
        'meses_rezagados',
        'observaciones',
        'monto',
        'ultimo_pago',
        'dias_ultima_notificacion',
        'id_notificacion'
    ];

    public $id;
    public $nombre;
    public $direccion;
    public $zona;
    public $colonia;
    public $tipo_toma;
    public $tipo_consumo;
    public $meses_rezagados;
    public $observaciones;
    public $monto;
    public $ultimo_pago;
    public $dias_ultima_notificacion;
    public $id_notificacion;


    function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->direccion = $args['direccion'] ?? null;
        $this->zona = $args['zona'] ?? null;
        $this->colonia = $args['colonia'] ?? null;
        $this->tipo_toma = $args['tipo_toma'] ?? null;
        $this->tipo_consumo = $args['tipo_consumo'] ?? null;
        $this->meses_rezagados = $args['meses_rezagados'] ?? null;
        $this->observaciones = $args['observaciones'] ?? null;
        $this->monto = $args['monto'] ?? null;
        $this->ultimo_pago = $args['ultimo_pago'] ?? null;
        $this->dias_ultima_notificacion = $args['dias_ultima_notificacion'] ?? null;
        $this->id_notificacion = $args['id_notificacion'] ?? null;
    }

    public static function total($texto = '')
    {
        $query = "
    SELECT COUNT(DISTINCT f.id_user) as total
    FROM facturacion f
    JOIN users p ON f.id_user = p.id
    JOIN zone z ON p.id_zone = z.id
    JOIN colony c ON p.id_colony = c.id
    JOIN intake_type tt ON p.id_intaketype = tt.id
    JOIN consume_type tc ON p.id_consumtype = tc.id  
    WHERE f.folio = 0 AND f.estado = 0
    ";

        if (!empty($texto)) {
            $query .= " AND ($texto)";
        }

        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }



    public static function obtenerUsuariosPaginados($limite, $offset, $texto = '', $columna = 'id', $orden = 'asc')
    {
        $columnasPermitidas = ['id', 'nombre', 'direccion', 'zona', 'colonia', 'tipo_toma', 'tipo_consumo', 'meses_rezagados', 'observaciones', 'monto', 'ultimo_pago'];
        $ordenesPermitidos = ['asc', 'desc'];

        if (!in_array($columna, $columnasPermitidas)) {
            $columna = 'id';
        }

        if (!in_array($orden, $ordenesPermitidos)) {
            $orden = 'asc';
        }

        $query = "SELECT 
    f.id_user AS id, 
    CONCAT(p.user, ' ', p.lastname) AS nombre, 
    p.address AS direccion, 
    z.id AS id_zona, 
    z.name AS zona, 
    c.id AS id_colony, 
    c.name AS colonia, 
    tt.id AS id_tipotoma, 
    tt.name AS tipo_toma, 
    tc.id AS id_tipoconsumo, 
    tc.name AS tipo_consumo, 
    COUNT(f.mes) AS meses_rezagados, 
    p.id_observaciones AS observaciones, 
    SUM(f.monto_agua) AS monto, 
    fa.ultimo_pago,
    n.id_notificacion,
    CASE 
        WHEN n.fecha_pago IS NULL OR n.fecha_pago = '0000-00-00 00:00:00'
        THEN DATEDIFF(NOW(), n.fecha_reporte) 
        ELSE 0 
    END AS dias_ultima_notificacion
FROM facturacion f 
JOIN users p ON f.id_user = p.id 
JOIN zone z ON p.id_zone = z.id 
JOIN colony c ON p.id_colony = c.id 
JOIN intake_type tt ON p.id_intaketype = tt.id 
JOIN consume_type tc ON p.id_consumtype = tc.id 
LEFT JOIN (
    SELECT id_user, MAX(date_invoice) AS ultimo_pago 
    FROM facturas_anterior 
    GROUP BY id_user
) fa ON fa.id_user = f.id_user 
LEFT JOIN (
    SELECT n1.id_user, n1.fecha_reporte, n1.fecha_pago, n1.idx AS id_notificacion
    FROM notificaciones n1
    INNER JOIN (
        SELECT id_user, MAX(fecha_reporte) AS fecha_reporte
        FROM notificaciones
        WHERE fecha_reporte IS NOT NULL AND fecha_reporte != '0000-00-00 00:00:00'
        GROUP BY id_user
    ) n2 ON n1.id_user = n2.id_user AND n1.fecha_reporte = n2.fecha_reporte
) n ON n.id_user = f.id_user
WHERE f.folio = 0 AND f.estado = 0 and f.if_recargo = 1
";

        if (!empty($texto)) {
            $query .= " AND ($texto)";
        }

        $query .= " GROUP BY f.id_user ORDER BY $columna $orden LIMIT $limite OFFSET $offset";

        return self::consultarSQL($query);
    }



    public static function ObtenerUsuariosPaginadosLec($limite, $offset, $texto = '')
    {
        $query = "SELECT u.id, CONCAT(u.user, ' ', u.lastname) AS nombre,
             u.address as direccion, z.id AS id_zone,
             z.name AS zona,
             c.id AS id_colony,
             c.name AS colonia
             FROM users u 
             JOIN zone z ON u.id_zone = z.id 
             JOIN colony c ON u.id_colony = c.id 
             WHERE u.id_servicetype = 3";
        if (!empty($texto)) {
            $query .= " AND ($texto)";
        }
        $query .= " ORDER BY u.id ASC 
               LIMIT $limite OFFSET $offset";

        return self::consultarSQL($query);
    }

    public static function totallec($texto = '')
    {
        $query = "SELECT COUNT(DISTINCT u.id) as total
        FROM users u 
        JOIN zone z ON u.id_zone = z.id 
        JOIN colony c ON u.id_colony = c.id 
        WHERE u.id_servicetype = 3";

        if (!empty($texto)) {
            $query .= " AND ($texto)";
        }

        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }

    public function obtenerUsuarioDesdeNotificacion($idNotificacion)
    {
        $query = "SELECT * FROM 'notificaciones' WHERE 'idx' = '$idNotificacion'";

        return self::consultarSQL($query);
    }
}
