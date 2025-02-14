<?php

namespace Controllers;

use MVC\Router;
use Usuarios\Zona;
use Usuarios\Colonia;
use Facturacion\Facturacion;
use Facturacion\Pendientes;
use Usuarios\Usuario;

class NotificationesController
{
    private static $apartado = 'notificaciones';
    private static $links = ['notificaciones', 'lecturas', 'agenda'];
    private static $especiales = 'generar-agenda';

    public static function index(Router $router)
    {
        isAuth();

        $router->render('notifications/deudores', [
            'links' => self::$links,
            'especiales' => self::$especiales,
            'apartado' => self::$apartado
        ]);
    }

    public static function generarAgenda(Router $router)
    {
        isAuth();

        echo "ENDPOINT PARA GENERAR AGENDA";
    }

    public static function agenda(Router $router)
    {
        isAuth();

        $router->render('notifications/agenda', [
            'links' => self::$links,
            'especiales' => self::$especiales,
            'apartado' => self::$apartado
        ]);
    }

    public static function lecturas(Router $router)
    {
        isAuth();

        $router->render('notifications/lecturas', [
            'links' => self::$links,
            'especiales' => self::$especiales,
            'apartado' => self::$apartado
        ]);
    }

    public static function deudores()
    {
        isAuth();

        $getLimite = intval($_GET['limite']);
        $getOffset = intval($_GET['offset']);

        $whoffset = '';
        $id_filter = '';
        $between = null;

        if (isset($_GET['whoffset']) && isset($_GET['id_filter'])) {
            $whoffset = s($_GET['whoffset']);
            $id_filter = s($_GET['id_filter']);
        }

        if (isset($_GET['between'])) {
            $between = s($_GET['between']);
        }

        $limite = $getLimite ?? 10;
        $offset = $getOffset ?? 0;

        if (!is_null($between)) {
            $explode = explode('_', $between);

            if (intval($explode[0]) === 13) {
                $idxs = Facturacion::getIdBetweenUpp($explode[0], $limite, $offset);
                $total = Facturacion::totalIdBetweenUpp($explode[0]);
            } else {
                $idxs = Facturacion::getIdBetween($explode[0], $explode[1], $limite, $offset);
                $total = Facturacion::totalIdBetween($explode[0], $explode[1]);
            }

            $resultado = [];
            foreach ($idxs as $idx) {
                $idx = Usuario::find($idx->id_user);
                $resultado[] = $idx;
            }
        } else if ($whoffset === "" || $id_filter === "") {
            $total = Pendientes::total();
            $resultado = Pendientes::offset($limite, $offset);
        } else {
            $total = Pendientes::whtotal($id_filter, $whoffset);
            $resultado = Pendientes::whoffset($limite, $offset, $id_filter, $whoffset);
        }


        $usuarios = [];

        $usuarios = self::calcularAdeudo($resultado, $usuarios);

        $usuarios = array_values($usuarios);

        echo json_encode([
            'usuarios' => $usuarios,
            'total' => $total
        ]);
    }

    public static function medido()
    {
        isAuth();

        $getLimite = intval($_GET['limite']);
        $getOffset = intval($_GET['offset']);

        $limite = $getLimite ?? 10;
        $offset = $getOffset ?? 0;

        $resultado = Pendientes::whoffset($limite, $offset, 'id_servicetype', 3);
        $total = Pendientes::whtotal('id_servicetype', 3);

        $usuarios = [];
        $usuarios = self::calcularAdeudo($resultado, $usuarios);

        $usuarios = array_values($usuarios);

        echo json_encode([
            'usuarios' => $usuarios,
            'total' => $total
        ]);
    }

    public static function calcular($array)
    {
        $monto = array_reduce($array, function ($acc, $act) {
            return $acc + $act;
        }, 0);

        return $monto;
    }

    private static function calcularAdeudo($arr, $arg = [])
    {
        foreach ($arr as $usuario) {
            $usuario->id_colony = Colonia::find($usuario->id_colony)->name;
            $usuario->id_zone = Zona::find($usuario->id_zone)->name;
            $usuario->adeudos = Facturacion::belongsTo('id_user', $usuario->id);

            $agua = [];
            $drenaje = [];
            $aguaIva = 0;
            $drenajeIva = 0;
            $recargoAgua = [];
            $recargoDrenaje = [];
            $meses = 0;

            foreach ($usuario->adeudos as $adeudo) {
                if (intval($adeudo->if_recargo) === 1) {
                    $meses++;
                    $mesesContador = $meses;

                    array_push($agua, $adeudo->monto_agua);

                    if ($usuario->drain == 1) {
                        array_push($drenaje, ($adeudo->monto_agua) * 0.25);
                        if ($mesesContador > 0) array_push($recargoDrenaje, (($adeudo->monto_agua) * 0.25) * 0.0113 * $mesesContador);
                    }

                    if ($mesesContador > 0) array_push($recargoAgua, ($adeudo->monto_agua) * 0.0113 * $mesesContador);

                    $mesesContador--;
                }
            }

            $montoAgua = self::calcular($agua);
            $montoDrenaje = self::calcular($drenaje);
            $montoRecAgua = self::calcular($recargoAgua);
            $montoRecDren = self::calcular($recargoDrenaje);

            if (intval($usuario->id_consumtype) !== 2) {
                $aguaIva = ($montoAgua) * 0.16;
            }

            $drenajeIva = ($montoDrenaje) * 0.16;

            $sumatoriaNatural = $montoAgua + $montoDrenaje;
            $sumatoriaRecargo = $montoRecAgua + $montoRecDren;
            $sumatoriaIva = $aguaIva + $drenajeIva;
            $sumatoria = $sumatoriaNatural + $sumatoriaRecargo + $sumatoriaIva;

            $usuario->adeudos = [
                'meses_rezagados' => $meses,
                'total' => round($sumatoria, 2),
            ];

            $arg[] = $usuario;
        }

        return $arg;
    }
}
