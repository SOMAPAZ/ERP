<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Empleados\Empleado;
use Facturacion\Facturacion;
use Facturacion\FacturasPasadas;
use Facturacion\Facturas;

class CajaController
{
    private static $links = ['consultar', 'crear-corte'];

    public static function index(Router $router)
    {
        isAuth();
        permisosCaja();

        $router->render('caja/index', [
            'links' => self::$links,
        ]);
    }

    public static function viewPagoTotal(Router $router) {
        isAuth();
        permisosCaja();

        $router->render('caja/pago-total', [
            'links' => self::$links,
        ]);
    }

    public static function setPagoTotal()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $histFact = Facturas::obtenerUltimoFolio();

            if ($histFact === null) {
                $factPasada = FacturasPasadas::obtenerUltimoFolio();
                $ultimoFolio = $factPasada->folio;
            } else {
                $ultimoFolio = $histFact->folio;
            }

            $pago = new Facturas($_POST);

            $pago->folio = ++$ultimoFolio;
            $pago->fecha = date('Y-m-d H:i:s');
            $pago->mes_inicio = formatearFecha($_POST['mes_incio']);
            $pago->mes_fin = formatearFecha($_POST['mes_fin']);
            $pago->monto_agua = desformatearMonto($pago->monto_agua);
            $pago->monto_drenaje = desformatearMonto($pago->monto_drenaje);
            $pago->monto_recargo_agua = desformatearMonto($pago->monto_recargo_agua);
            $pago->monto_recargo_drenaje = desformatearMonto($pago->monto_recargo_drenaje);
            $pago->monto_descuento_agua = desformatearMonto($pago->monto_descuento_agua);
            $pago->monto_descuento_drenaje = desformatearMonto($pago->monto_descuento_drenaje);
            $pago->monto_iva_agua = desformatearMonto($pago->monto_iva_agua);
            $pago->monto_iva_drenaje = desformatearMonto($pago->monto_iva_drenaje);
            $pago->total = desformatearMonto($pago->total);

            $responsable = Empleado::find($_SESSION['empleado_id']);
            $pago->empleado_id = intval($responsable->id);

            $resultado = $pago->guardar();

            if ($resultado) {
                $pagado = Facturacion::pagarTodo($pago->id_user, $pago->folio);
            }

            if ($pagado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Pago guardado correctamente',
                    'folio' => $pago->folio,
                ];
            } else {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al guardar el pago',
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function setPagoParciales()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $histFact = Facturas::obtenerUltimoFolio();

            if ($histFact === null) {
                $factPasada = FacturasPasadas::obtenerUltimoFolio();
                $ultimoFolio = $factPasada->folio;
            } else {
                $ultimoFolio = $histFact->folio;
            }

            $pago = new Facturas($_POST);
            $pago->folio = ++$ultimoFolio;
            $pago->fecha = date('Y-m-d H:i:s');
            $pago->mes_inicio = formatearFechaPar($_POST['mes_inicio']);
            $pago->mes_fin = formatearFechaPar($_POST['mes_fin']);

            $responsable = Empleado::find($_SESSION['empleado_id']);
            $pago->empleado_id = $responsable->id;

            $resultado = $pago->guardar();

            if ($resultado) {
                $mes1 = explode("-", $pago->mes_inicio)[1];
                $mes2 = explode("-", $pago->mes_fin)[1];
                $year1 = explode("-", $pago->mes_inicio)[0];
                $year2 = explode("-", $pago->mes_fin)[0];

                $pagado = Facturacion::pagarParcial(intval($pago->folio), intval($pago->id_user), intval($mes1), intval($mes2), intval($year1), intval($year2));
            }

            if ($pagado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Pago guardado correctamente',
                    'folio' => $pago->folio,
                    'mes1' => $mes1,
                    'mes2' => $mes2,
                    'year1' => $year1,
                    'year2' => $year2,
                ];

                echo json_encode($respuesta);
            }
        }
    }

    public static function setPagoUnico()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $histFact = Facturas::obtenerUltimoFolio();

            if ($histFact === null) {
                $factPasada = FacturasPasadas::obtenerUltimoFolio();
                $ultimoFolio = $factPasada->folio;
            } else {
                $ultimoFolio = $histFact->folio;
            }

            $pago = new Facturas($_POST);
            $pago->folio = ++$ultimoFolio;
            $pago->fecha = date('Y-m-d H:i:s');

            $responsable = Empleado::find($_SESSION['empleado_id']);
            $pago->empleado_id = $responsable->id;

            $resultado = $pago->guardar();

            if ($resultado) {
                $mes = explode("-", $pago->mes_inicio)[1];
                $year = explode("-", $pago->mes_inicio)[0];
                $pagado = Facturacion::pagarUno($pago->id_user, $pago->folio, $mes, $year);
            }

            if ($pagado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Pago guardado correctamente',
                    'folio' => $pago->folio,
                    'mes' => $mes,
                    'year' => $year,
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function setCondonaciones()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $explode = explode(',', $_POST['args']);
            $insert = Facturacion::condoneTo($explode);

            if($insert) {
                $res = [
                    'tipo' => 'Exito',
                    'title' => 'Actualizado con exito',
                    'text' => 'Condonación realizada correctamente'
                ];
            } else {
                $res = [
                    'tipo' => 'Error',
                    'title' => 'Hubo un error',
                    'text' => 'No se puedo realizar la condonación'
                ];
            }

            echo json_encode($res);
        }
    }

    public static function setCondonacionUnico()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $resultado = Facturacion::condonarUno(s($_POST['id_user']), $_POST['mes'], $_POST['year']);

            if ($resultado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Condonación guardada correctamente',
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function setCondonacionRecargos()
    {

        isAuth();
        permisosCaja();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = s($_POST['id_user']);

            $resultado = Facturacion::condonarRecargos($id);
            if ($resultado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Se han condonado los recargos correctamente'
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function getAvanzados(Router $router)
    {
        isAuth();
        permisosCaja();
        $usuarioId = s($_GET['usuario']);
        if (!$usuarioId) {
            header('Location: /consultar');
            return;
        }

        $router->render('caja/avanzados', [
            'links' => self::$links,
        ]);
    }
}
