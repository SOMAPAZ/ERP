<?php

namespace Controllers;

use Facturacion\Cuentas;
use Usuarios\Colonia;
use Reportes\Unidades;
use Reportes\Categoria;
use Reportes\Estado;
use Reportes\Prioridad;
use Reportes\Materiales;
use Reportes\Incidencias;
use Usuarios\Zona;

class GenericasController
{
    public static function categorias()
    {
        isAuth();

        $categorias = Categoria::all();
        echo json_encode($categorias);
    }

    public static function incidenciasCat()
    {
        isAuth();

        $cat_id = s($_GET['id']);
        $cat_id = filter_var($cat_id, FILTER_VALIDATE_INT);

        if (!$cat_id) {
            $incidencias = [[
                'id' => "",
                'id_category' => "0",
                'name' => "--Seleccione una incidencia--"
            ]];
            echo json_encode($incidencias);
            return;
        }

        $incidencias = Incidencias::belongsTo('id_category', $cat_id);
        echo json_encode($incidencias);
    }

    public static function prioridadesRep()
    {
        isAuth();

        $prioridades = Prioridad::all();
        echo json_encode($prioridades);
    }

    public static function materialesRep()
    {
        isAuth();

        $materiales = Materiales::all();
        echo json_encode($materiales);
    }

    public static function unidadesRep()
    {
        isAuth();

        $unidades = Unidades::all();
        echo json_encode($unidades);
    }

    public static function colonias()
    {
        isAuth();

        $colonias = Colonia::all();
        echo json_encode($colonias);
    }
    public static function zonas()
    {
        isAuth();

        $zonas = Zona::all();
        echo json_encode($zonas);
    }
    public static function cuentasAdicionales()
    {
        isAuth();

        $cuentas = Cuentas::all();

        echo json_encode($cuentas);
    }

    public static function estadosReportes()
    {
        isAuth();

        $estados = Estado::all();

        echo json_encode($estados);
    }
}
