<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Usuarios\Usuario;

class UsersController
{
    private static $apartado = 'usuarios';
    private static $links = ['usuarios'];

    public static function index(Router $router)
    {
        $router->render('users/index', [
            'links' => self::$links,
            'apartado' => self::$apartado
        ]);
    }

    public static function usersAPI()
    {
        $users = new UsuariosAPI();
        $resultado = $users->consultar();

        echo json_encode($resultado);
    }

    public static function datosBusqueda()
    {
        isAuth();
        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);

        $usuarios = Usuario::getAllUniques($id);
        echo json_encode($usuarios);
    }
}
