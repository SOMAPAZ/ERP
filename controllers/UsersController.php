<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Usuarios\Colonia;
use Usuarios\EstadoServicio;
use Usuarios\Localidad;
use Usuarios\TipoConsumo;
use Usuarios\TipoServicio;
use Usuarios\TipoToma;
use Usuarios\TipoUsuario;
use Usuarios\Usuario;
use Usuarios\Zona;

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

    public static function usuario()
    {
        isAuth();

        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);

        if (!$id) {
            $res = [
                'tipo' => 'Error',
                'msg' => 'Es requerido el id'
            ];

            echo json_encode($res);
            return;
        }

        $usuario = Usuario::find($id);
        if(!$usuario) {
            echo json_encode($res = [
                'tipo' => 'Error',
                'msg' => 'El usuario no existe'
            ]);
            return;
        }
        
        $usuario->id_colony = Colonia::find($usuario->id_colony)->name;
        $usuario->id_locality = Localidad::find($usuario->id_locality)->name;
        $usuario->id_zone = Zona::find($usuario->id_zone)->name;
        $usuario->id_usertype = TipoUsuario::find($usuario->id_usertype)->name;
        $usuario->id_intaketype = TipoToma::find($usuario->id_intaketype)->name;
        $usuario->id_servicetype = TipoServicio::find($usuario->id_servicetype)->name;
        $usuario->id_servicestatus = EstadoServicio::find($usuario->id_servicestatus)->name;
        $usuario->id_consumtype = TipoConsumo::find($usuario->id_consumtype)->name;

        echo json_encode($usuario);
    }
}
