<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Empleados\Empleado;
use Facturacion\Facturacion;
use Facturacion\FacturasPasadas;
use Facturacion\Facturas;
use Facturacion\PagosAdicionales;
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

        $id_user = s($_GET['usuario']);
        $debe = Facturacion::obtenerTodosAdeudos($id_user);

        if (count($debe) === 0) {
            header('Location: /consultar');
            return;
        }

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
            $implode = implode(',', $montos[8]->seleccionado);
            $explode = explode(',', $implode);


            $histFact = Facturas::obtenerUltimoFolio()->folio ?? null;
            $historialExtras = PagosAdicionales::obtenerUltimoFolio()->folio ?? null;

            if ($historialExtras === null) {
                if ($histFact === null) {
                    $factPasada = FacturasPasadas::obtenerUltimoFolio()->folio;
                    $ultimoFolio = $factPasada;
                } else {
                    $ultimoFolio = $histFact;
                }
            } else {
                $ultimoFolio = $historialExtras;
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
            $pago->nota = $montos[1]->resDebt->nota;

            $resultado = $pago->guardar();

            if (!$resultado) {
                $res = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al guardar el pago',
                ];
                echo json_encode($res);
                return;
            }

            $adicionales = $montos[7]->adicionales;
            foreach ($adicionales as $adicional) {
                $adicionalPago = new Facturas();
                $adicionalPago->id_user = $pago->id_user;
                $adicionalPago->folio = $pago->folio;
                $adicionalPago->fecha = date('Y-m-d H:i:s');
                $adicionalPago->mes_inicio = date('Y-m-d H:i:s');
                $adicionalPago->mes_fin = date('Y-m-d H:i:s');
                $adicionalPago->numero_meses = 0;
                $adicionalPago->id_cuentas = $adicional->id;
                $adicionalPago->monto_cuentas = round($adicional->cantidad, 2);
                $adicionalPago->monto_iva_cuentas = round($adicional->cantidad_iva, 2);
                $adicionalPago->tipo_pago = $pago->tipo_pago;
                $adicionalPago->total = $adicionalPago->monto_cuentas + $adicionalPago->monto_iva_cuentas;
                $adicionalPago->empleado_id = $pago->empleado_id;
                $resultado = $adicionalPago->guardar();
            }

            if (!$resultado) {
                $res = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al guardar los pagos adicionales',
                ];
                echo json_encode($res);
                return;
            }

            if (count($montos[8]->seleccionado)) {
                $pagado = Facturacion::pagarTo($montos[8]->seleccionado, $pago->folio);
            } else {
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

    public static function pagoCostosAdicionales()
    {
        isAuth();
        permisosCaja();
        date_default_timezone_set('America/Mexico_City');

        $histFact = Facturas::obtenerUltimoFolio()->folio ?? null;
        $historialExtras = PagosAdicionales::obtenerUltimoFolio()->folio ?? null;

        if ($historialExtras === null) {
            if ($histFact === null) {
                $factPasada = FacturasPasadas::obtenerUltimoFolio()->folio;
                $ultimoFolio = $factPasada;
            } else {
                $ultimoFolio = $histFact;
            }
        } else {
            $ultimoFolio = $historialExtras;
        }

        $adicionales = json_decode($_POST['adicionales']);

        $pago = new PagosAdicionales();
        $pago->folio = ++$ultimoFolio;
        $pago->id_user = intval($_POST['id']);
        $pago->nombre = s($_POST['nombre']);
        $pago->direccion = s($_POST['direccion']);
        $pago->tipo_pago = s($_POST['tipo_pago']);

        foreach ($adicionales as $adicional) {
            $pago->id_cuenta = $adicional->id;
            $pago->cantidad = $adicional->cantidad;
            $pago->cantidad_iva = $adicional->cantidad_iva;
            $pago->fecha = date('Y-m-d H:i:s');
            $pago->id_empleado = $_SESSION['empleado_id'];
            $resultado = $pago->guardar();
        }


        if (!$resultado) {
            $res = [
                'tipo' => 'Error',
                'mensaje' => 'Hubo un error al guardar el pago',
            ];
        }

        if ($resultado) {
            $res = [
                'tipo' => 'Exito',
                'mensaje' => 'Pago guardado correctamente',
                'folio' => $pago->folio,
                'id_user' => $pago->id_user ?? 0,
            ];
        }

        echo json_encode($res);
    }
}
