<?php

namespace Controllers;

use MVC\Router;
use Usuarios\Zona;
use APIs\UsuariosAPI;
use Reportes\Reporte;
use Usuarios\Colonia;
use Usuarios\Usuario;
use Usuarios\TipoToma;
use Classes\Paginacion;
use Reportes\Categoria;
use Usuarios\Localidad;
use Facturacion\Facturas;
use Reportes\Incidencias;
use Usuarios\TipoConsumo;
use Usuarios\TipoUsuario;
use Usuarios\TipoServicio;
use Usuarios\Beneficiarios;
use Usuarios\EstadoServicio;
use Facturacion\FacturasPasadas;
use Notificaciones\Notificacion;
use Usuarios\TipoAlmacenamiento;
use Facturacion\PagosAdicionales;
use Notificaciones\TipoNotificacion;

class UsersController
{
    private static $apartado = 'usuarios';
    private static $links = ['usuarios'];

    public static function index(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /usuarios?page=1');
        }

        $por_pagina = 100;
        $total = Usuario::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $usuarios = Usuario::paginar($por_pagina, $paginacion->offset(), 'ASC');

        foreach ($usuarios as $usuario) {
            $usuario->zona = Zona::find($usuario->id_zone);
        }

        $router->render('users/index', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'usuarios' => $usuarios,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function buscarUsuario(Router $router)
    {

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /usuarios');
            return;
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /usuarios');
            return;
        }

        $usuario->zona = Zona::find($usuario->id_zone);
        $usuario->colonia = Colonia::find($usuario->id_colony);
        $usuario->tipo_usuario = TipoUsuario::find($usuario->id_usertype);
        $usuario->tipo_consumo = TipoConsumo::find($usuario->id_consumtype);
        $usuario->tipo_servicio = TipoServicio::find($usuario->id_servicetype);
        $usuario->estado_servicio = EstadoServicio::find($usuario->id_servicestatus);
        $usuario->tipo_toma = TipoToma::find($usuario->id_intaketype);
        $usuario->tipo_almacenamiento = TipoAlmacenamiento::find($usuario->id_userStorage);

        $beneficiarios = Beneficiarios::belongsTo('id_user', $id);

        $reportes = Reporte::belongsTo('id_user', $id);
        foreach ($reportes as $reporte) {
            $reporte->categoria = Categoria::find($reporte->id_category);
            $reporte->incidencia = Incidencias::find($reporte->id_incidence);
        }

        $notificaciones = Notificacion::belongsTo('id_user', $id);
        foreach ($notificaciones as $notificacion) {
            $notificacion->tipo = TipoNotificacion::find($notificacion->id_tiponotificacion);
        }

        $recibos_anterior = FacturasPasadas::belongsTo('id_user', $id);
        $recibos_actuales = Facturas::belongsTo('id_user', $id);
        $recibos_pagos_adicionales = PagosAdicionales::belongsTo('id_user', $id);

        $router->render('users/buscar-usuario', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'usuario' => $usuario,
            'beneficiarios' => $beneficiarios,
            'reportes' => $reportes,
            'notificaciones' => $notificaciones,
            'recibos_anterior' => $recibos_anterior,
            'recibos_actuales' => $recibos_actuales,
            'recibos_pagos_adicionales' => $recibos_pagos_adicionales
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
        if (!$usuario) {
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
