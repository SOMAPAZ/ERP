<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Empleados\Empleado;
use Facturacion\Facturacion;
use Facturacion\FacturasPasadas;
use Facturacion\Facturas;
use Usuarios\Usuario;

class CajaController
{
    private static $links = ['consultar', 'crear-corte'];

    public static function index(Router $router)
    {
        isAuth();
        permisosCaja();

        self::actualizarRezago();

        $router->render('caja/index', [
            'links' => self::$links,
        ]);
    }

    public static function actualizarRezago()
    {
        date_default_timezone_set('America/Mexico_City');

        $fecha = date('Y-m-d');
        $fechaMensual = date('Y-m') . '-06';
        $year = date('Y');
        $mes = date('m');

        if ($fecha === $fechaMensual) {
            $totalNoRecargo = Facturacion::validarRezagados($mes, $year);

            if ($totalNoRecargo > 0) {
                $res = Facturacion::actualizarRezago($year, $mes);
            }
        };
    }

    public static function viewPagoTotal(Router $router)
    {
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

            $montos = json_decode($_POST['montos']);

            $histFact = Facturas::obtenerUltimoFolio();

            if ($histFact === null) {
                $factPasada = FacturasPasadas::obtenerUltimoFolio();
                $ultimoFolio = $factPasada->folio;
            } else {
                $ultimoFolio = $histFact->folio;
            }

            $pago = new Facturas();

            $pago->id_user = $montos[0]->id_user;
            $pago->folio = ++$ultimoFolio;
            $pago->fecha = date('Y-m-d H:i:s');
            $pago->mes_inicio = $montos[1]->resDebt->periodo->inicio;
            $pago->mes_fin = $montos[1]->resDebt->periodo->final;
            $pago->monto_agua = $montos[1]->resDebt->agua_inicial + $montos[1]->resDebt->m3_excedido_agua;
            $pago->monto_drenaje = $montos[1]->resDebt->drenaje_inicial + $montos[1]->resDebt->m3_excedido_drenaje;
            $pago->monto_recargo_agua = $montos[1]->resDebt->recargos->agua;
            $pago->monto_recargo_drenaje = $montos[1]->resDebt->recargos->drenaje;
            $pago->monto_descuento_agua = $montos[1]->resDebt->descuentos->agua;
            $pago->monto_descuento_drenaje = $montos[1]->resDebt->descuentos->drenaje;
            $pago->monto_descuento_recargo_agua = round($montos[3]->descuentoRecargoAgua, 2);
            $pago->monto_descuento_recargo_drenaje = round($montos[5]->descuentoRecargoDren, 2);
            $pago->numero_meses = $montos[1]->resDebt->meses->totales;
            $pago->monto_iva_agua = $montos[1]->resDebt->iva->agua + $montos[1]->resDebt->iva->m3_excedido_agua;
            $pago->monto_iva_drenaje = $montos[1]->resDebt->iva->drenaje + $montos[1]->resDebt->iva->m3_excedido_drenaje;

            $totalSuma = $pago->monto_agua + $pago->monto_drenaje + $pago->monto_recargo_agua + $pago->monto_recargo_drenaje +  $pago->monto_iva_agua
                + $pago->monto_iva_drenaje;
            $totalResta = $pago->monto_descuento_agua + $pago->monto_descuento_drenaje + $pago->monto_descuento_recargo_agua + $pago->monto_descuento_recargo_drenaje;

            $pago->total = round($totalSuma - $totalResta, 2);

            $pago->tipo_pago = $montos[6]->tipoPago;
            $responsable = Empleado::find($_SESSION['empleado_id']);
            $pago->empleado_id = intval($responsable->id);

            $resultado = $pago->guardar();
            echo json_encode($resultado);
            return;

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

    public static function setCondonaciones()
    {
        isAuth();
        permisosCaja();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $explode = explode(',', $_POST['args']);
            $insert = Facturacion::condoneTo($explode);

            if ($insert) {
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

    public static function getAvanzados(Router $router)
    {
        isAuth();
        permisosCaja();
        $usuarioId = s($_GET['usuario']);
        if (!$usuarioId) {
            header('Location: /consultar');
            return;
        }

        $tipoServicio = Usuario::find($usuarioId)->id_servicetype;
        $esMedido = $tipoServicio === "3" ? true : false;

        $router->render('caja/avanzados', [
            'links' => self::$links,
            'esMedido' => $esMedido
        ]);
    }

    public static function getCondonaciones(Router $router)
    {

        isAuth();
        permisosCaja();

        $usuarioId = s($_GET['usuario']);
        if (!$usuarioId) {
            header('Location: /consultar');
            return;
        }

        $router->render('caja/condonaciones', [
            'links' => self::$links,
        ]);
    }

    public static function getListadoCondonaciones()
    {
        isAuth();
        permisosCaja();

        $id = s($_GET['id']);
        $condonaciones = Facturacion::obtenerCondonaciones($id);

        if (count($condonaciones) === 0) {
            echo json_encode([]);
            return;
        }

        echo json_encode($condonaciones);
    }

    public static function deshacerCondonacion($id)
    {
        isAuth();
        permisosCaja();

        $id = s($_POST['id']);

        $condonacion = Facturacion::deshacerCondonaciones($id);

        if ($condonacion) {
            $respuesta = [
                'tipo' => 'Exito',
                'mensaje' => 'Condonación deshecha correctamente',
                'id' => $id,
            ];
        }

        if (!$condonacion) {
            $respuesta = [
                'tipo' => 'Error',
                'mensaje' => 'No se pudo deshacer la condonación',
            ];
        }

        echo json_encode($respuesta);
    }

    public static function getPagosAdicionales(Router $router)
    {
        isAuth();
        permisosCaja();

        $router->render('caja/pagos-adicionales', [
            'links' => self::$links,
        ]);
    }
}
