<?php


namespace Controllers;

use MVC\Router;

class UpdatesController
{
    private static $links = ['consultar', 'crear-corte'];

    public static function index(Router $router)
    {
        isAuth();

        if( $_SESSION['empleado_rol'] === "1" ||
            $_SESSION['empleado_rol'] === "3" || 
            $_SESSION['empleado_rol'] === "2") {
            $router->render('updates/index', [
                'links' => self::$links,
            ]);

            return;
        }

        header('Location: /welcome');
    }
}