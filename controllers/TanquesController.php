<?php

namespace Controllers;

use MVC\Router;
use Tanques\RegistrosTanques;
use Tanques\Tanques;

class TanquesController {
    private static $apartado = 'tanques';
    private static $links = ['graficos', 'generar-registro'];

    public static function index(Router $router)
    {
        isAuth();
        $router->render('tanques/index', [
            'links' => self::$links,
            'apartado' => self::$apartado
        ]);

    }

    public static function tanques() 
    {
        isAuth();
        $tanques = Tanques::all();

        if(count($tanques) === 0) $tanques = [];

        echo json_encode($tanques);
    }

    public static function getInformacion()
    {
        isAuth();

        $mes = $_GET['mes'];
        $year = $_GET['year'];
        $id_tanque = $_GET['id_tanque'];

        if(!isset($mes) || !isset($id_tanque)) {
            echo json_encode([]);
            return;
        }

        $registros = RegistrosTanques::obtenerRegistros('fecha', 'tanque_id', $mes, $year, $id_tanque);

        foreach($registros as $registro) {
            $registro->nivel = floatval($registro->nivel);
            $registro->llegada = intval($registro->llegada);
        }

        echo json_encode($registros);
    }

    public static function generarRegistro(Router $router)
    {
        isAuth();

        $router->render('tanques/registro', [
            'links' => self::$links,
            'apartado' => self::$apartado
        ]);
    }

    public static function guardarRegistro()
    {
        isAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $registro = new RegistrosTanques($_POST);
            $resultado = $registro->guardar();

            if($resultado) {
                $res = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Se realizó el registro correctamente'
                ];
                
                echo json_encode($res);
            }

        }
    }
}