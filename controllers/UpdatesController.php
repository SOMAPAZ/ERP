<?php


namespace Controllers;

use MVC\Router;
use Usuarios\Usuario;
use Classes\Paginacion;
use Usuarios\Colonia;

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

        $colonias = Colonia::all();

        $router->render('updates/crear-usuario', [
            'links' => self::$links,
            'colonias' => $colonias
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
