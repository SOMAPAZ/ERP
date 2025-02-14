<?php

namespace Controllers;

use Usuarios\Colonia;
use Reportes\Unidades;
use Reportes\Categoria;
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_category = s($_POST['id_category']);
            $existe = Categoria::where('id', $id_category);

            if (!$existe) {
                $respuesta = [
                    'tipo' => 'error',
                    'datos' => 'No existe esa categoría'
                ];

                echo json_encode($respuesta);
                return;
            }

            $incidencias = Incidencias::belongsTo('id_category', $id_category);

            $respuesta = [
                'tipo' => 'exito',
                'datos' => $incidencias
            ];

            echo json_encode($respuesta);
        } else {
            $incidenciasAll = Incidencias::all();
            echo json_encode($incidenciasAll);
        }
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
}
