<?php


namespace Controllers;

use MVC\Router;
use Usuarios\Zona;
use Usuarios\Colonia;
use Usuarios\Usuario;
use Usuarios\TipoToma;
use Classes\Paginacion;
use Usuarios\Localidad;
use Usuarios\TipoConsumo;
use Usuarios\TipoUsuario;
use Usuarios\TipoServicio;
use Usuarios\EstadoServicio;
use Usuarios\TipoAlmacenamiento;

class UpdatesController
{
    private static $links = ['datos-usuarios', 'datos-tarifas', 'datos-generales'];

    public static function index(Router $router)
    {
        isAuth();

        if (
            $_SESSION['empleado_rol'] === "1" ||
            $_SESSION['empleado_rol'] === "3" ||
            $_SESSION['empleado_rol'] === "2"
        ) {
            $pagina_actual = $_GET['page'];
            $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /datos-usuarios?page=1');
            }

            $por_pagina = 100;
            $total = Usuario::total();
            $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

            $usuarios = Usuario::paginar($por_pagina, $paginacion->offset(), 'ASC');

            $router->render('updates/index', [
                'links' => self::$links,
                'usuarios' => $usuarios,
                'paginacion' => $paginacion->paginacion()
            ]);

            return;
        }

        header('Location: /welcome');
    }

    public static function crearUsuario(Router $router)
    {
        isAuth();

        $alertas = [];

        $colonias = Colonia::all();
        $localidades = Localidad::all();
        $zonas = Zona::all();
        $tipo_usuario = TipoUsuario::all();
        $tipo_toma = TipoToma::all();
        $tipo_servicio = TipoServicio::all();
        $estado_servicio = EstadoServicio::all();
        $tipo_consumo = TipoConsumo::all();
        $tipo_almacenamiento = TipoAlmacenamiento::all();

        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();
            // dd($usuario);

            if (empty($alertas)) {
                $resultado = $usuario->guardar();
                // dd($resultado);
                header('Location: /datos-usuarios');
            }
        }

        $router->render('updates/crear-usuario', [
            'links' => self::$links,
            'colonias' => $colonias,
            'localidades' => $localidades,
            'zonas' => $zonas,
            'tipo_usuario' => $tipo_usuario,
            'tipo_toma' => $tipo_toma,
            'tipo_servicio' => $tipo_servicio,
            'estado_servicio' => $estado_servicio,
            'tipo_consumo' => $tipo_consumo,
            'tipo_almacenamiento' => $tipo_almacenamiento,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function editarUsuario(Router $router)
    {
        isAuth();

        $router->render('updates/editar-usuario', [
            'links' => self::$links,
        ]);
    }
}
