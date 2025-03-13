<?php

namespace APIs;

use Model\ActiveRecord;

class ReportesAPI extends ActiveRecord
{
    protected static $tabla = 'reports';
    protected static $columnasBD = [
        'folio',
        'id_user',
        'usuario',
        'telefono',
        'direccion',
        'statusID',
        'categoryID',
        'incidenceID',
        'priorityID',
        'priorityColor',
        'categoria',
        'incidencia',
        'prioridad',
        'respondio',
        'estado',
        'emision'
    ];

    public $folio;
    public $id_user;
    public $usuario;
    public $telefono;
    public $direccion;
    public $statusID;
    public $categoryID;
    public $incidenceID;
    public $priorityID;
    public $priorityColor;
    public $categoria;
    public $incidencia;
    public $prioridad;
    public $respondio;
    public $estado;
    public $emision;

    public function __construct($arg = [])
    {
        $this->folio = $arg['folio'] ?? null;
        $this->id_user = $arg['id_user'] ?? "";
        $this->usuario = $arg['usuario'] ?? "";
        $this->telefono = $arg['telefono'] ?? "";
        $this->direccion = $arg['direccion'] ?? "";
        $this->statusID = $arg['statusID'] ?? null;
        $this->categoryID = $arg['categoryID'] ?? null;
        $this->incidenceID = $arg['incidenceID'] ?? null;
        $this->priorityID = $arg['priorityID'] ?? null;
        $this->priorityColor = $arg['priorityColor'] ?? null;
        $this->categoria = $arg['categoria'] ?? "";
        $this->incidencia = $arg['incidencia'] ?? "";
        $this->prioridad = $arg['prioridad'] ?? "";
        $this->respondio = $arg['respondio'] ?? "";
        $this->estado = $arg['estado'] ?? "";
        $this->emision = $arg['emision'] ?? "";
    }

    public static function obtenerReportes()
    {
        $query = "SELECT reports.id as folio, 
                    reports.id_user, 
                    reports.name as usuario, 
                    reports.phone as telefono, 
                    reports.address as direccion, 
                    reports.id_status as statusID, 
                    reports.id_category as categoryID, 
                    reports.id_incidence as incidenceID, 
                    reports.id_priority as priorityID, 
                    category.name as categoria, 
                    incidence.name as incidencia, 
                    priority.name as prioridad, 
                    priority.color as priorityColor, 
                    CONCAT(aten.name, ' ', aten.lastname) as respondio,
                    status_report.name as estado, reports.created as emision 
                    FROM reports 
                    LEFT OUTER JOIN category ON reports.id_category = category.id 
                    LEFT OUTER JOIN incidence ON reports.id_incidence = incidence.id 
                    LEFT OUTER JOIN priority ON reports.id_priority = priority.id 
                    LEFT OUTER JOIN employments as aten ON reports.employee_id = aten.id 
                    LEFT OUTER JOIN employments as sup ON reports.id_employee_sup = sup.id 
                    LEFT OUTER JOIN status_report ON reports.id_status = status_report.id 
                    ORDER BY  reports.id DESC";

        $resultado = self::consultaJoin($query);

        return $resultado;
    }
}
