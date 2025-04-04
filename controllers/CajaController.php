<?php

namespace Controllers;

use MVC\Router;
use APIs\UsuariosAPI;
use Empleados\Empleado;
use Facturacion\CorteCaja;
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
            $factPasada = FacturasPasadas::obtenerUltimoFolio()->folio ?? null;

            if (is_null($histFact)) {
                if (is_null($historialExtras)) {
                    $ultimoFolio = $factPasada;
                } else {
                    $ultimoFolio = is_null($factPasada) ? $historialExtras : ((int) $factPasada > (int) $historialExtras ? $factPasada : $historialExtras);
                }
            } else {
                $ultimoFolio = is_null($historialExtras) ? $histFact : ((int) $histFact > (int) $historialExtras ? $histFact : $historialExtras);
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
        $factPasada = FacturasPasadas::obtenerUltimoFolio()->folio ?? null;

        if (is_null($histFact)) {
            if (is_null($historialExtras)) {
                $ultimoFolio = $factPasada;
            } else {
                $ultimoFolio = is_null($factPasada) ? $historialExtras : ((int) $factPasada > (int) $historialExtras ? $factPasada : $historialExtras);
            }
        } else {
            $ultimoFolio = is_null($historialExtras) ? $histFact : ((int) $histFact > (int) $historialExtras ? $histFact : $historialExtras);
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
            $pago->cantidad = floatval($adicional->cantidad);
            $pago->cantidad_iva = $adicional->cantidad_iva;
            $pago->fecha = date('Y-m-d H:i:s');
            $pago->id_empleado = $_SESSION['empleado_id'];
            $pago->total = $adicional->cantidad + $adicional->cantidad_iva;
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

    public static function crearCorte(Router $router)
    {
        isAuth();
        permisosCaja();
        date_default_timezone_set('America/Mexico_City');

        if (!$_SESSION['empleado_id']) {
            header('Location: /');
            return;
        }

        $pagos_facturacion = new Facturas();
        $pagos_adicionales = new PagosAdicionales();

        $facturas = $pagos_facturacion->obtenerPagosCorte(date('Y-m-d'), 'empleado_id', $_SESSION['empleado_id']);
        $adicionales = $pagos_adicionales->obtenerPagosCorte(date('Y-m-d'), 'id_empleado', $_SESSION['empleado_id']);

        $total_facturas = array_reduce($facturas, function ($acc, $act) {
            return $acc + $act->total;
        });

        $total_adicionales = array_reduce($adicionales, function ($acc, $act) {
            return $acc + $act->total;
        });

        $total = $total_facturas + $total_adicionales;

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $corte = new CorteCaja();
            $_POST['denominaciones'] = json_encode($_POST['denominacion']);

            $corte->sincronizar($_POST);
            $alertas = $corte->validar();

            if (empty($alertas)) {
                $corte->fecha = date('Y-m-d');
                $corte->hora = date('H:i:s');
                $corte->folio = md5(uniqid(rand(), true));

                $resultado = $corte->guardar();

                if ($resultado) {
                    if ($facturas) {
                        foreach ($facturas as $factura) {
                            $exito = $pagos_facturacion->asignarFolioCorte($factura->folio, $corte->folio);
                        }
                    }
                    if ($adicionales) {
                        foreach ($adicionales as $adicional) {
                            $exito = $pagos_adicionales->asignarFolioCorte($adicional->folio, $corte->folio);
                        }
                    }

                    if ($exito) {
                        $_SESSION = [];
                        header('Location: /solicitar-arqueo');
                    } else {
                        header('Location: /crear-corte');
                    }
                }
            }
        }

        $router->render('caja/corte', [
            'links' => self::$links,
            'total' => $total,
            'alertas' => $alertas
        ]);
    }

    public static function solicitarArqueo(Router $router)
    {
        $router->render('caja/solicitar-arqueo', [
            'login' => true
        ]);
    }

    public static function arqueo(Router $router)
    {
        isAuth();
        permisosCaja();

        if ($_SESSION['empleado_rol'] !== '1' && $_SESSION['empleado_rol'] !== '3' && $_SESSION['empleado_rol'] !== '2') {
            header('Location: /welcome');
            return;
        }

        $arqueos = CorteCaja::all();

        foreach ($arqueos as $arqueo) {
            $arqueo->entrega = Empleado::find($arqueo->entrega);
            $arqueo->recibe = Empleado::find($arqueo->recibe);
            $arqueo->testigo = Empleado::find($arqueo->testigo);
        }

        $router->render('caja/arqueo', [
            'links' => self::$links,
            'arqueos' => $arqueos
        ]);
    }

    public static function eliminarCorte()
    {
        isAuth();

        $folio = s($_POST['folio']);
        $corte = CorteCaja::where('folio', $folio);

        if (!$corte) {
            header('Location: /consultar');
            return;
        }

        // $eliminado = true;
        $eliminado = $corte->eliminar();

        if ($eliminado) {
            $facturas = Facturas::belongsTo('folio_corte', $folio);
            $adicionales = PagosAdicionales::belongsTo('folio_corte', $folio);

            $exito = false;

            if ($facturas) {
                foreach ($facturas as $factura) {
                    $exito = $factura->removerFolioCorte($factura->folio);
                }
            }
            if ($adicionales) {
                foreach ($adicionales as $adicional) {
                    $exito = $adicional->removerFolioCorte($adicional->folio);
                }
            }
        }

        if ($exito) {
            header('Location: /arqueos');
        }
    }

    public static function getRecibos(Router $router)
    {
        isAuth();
        permisosCaja();

        $user = s($_GET['usuario']);
        if (!$user) {
            header('Location: /consultar');
            return;
        }

        $recibos = Facturas::belongsTo('id_user', $user);
        $recibos_pasados = FacturasPasadas::belongsTo('id_user', $user);
        $pagos_adicionales = PagosAdicionales::belongsTo('id_user', $user);

        $router->render('caja/recibos', [
            'links' => self::$links,
            'recibos' => $recibos,
            'recibos_pasados' => $recibos_pasados,
            'pagos_adicionales' => $pagos_adicionales,
        ]);
    }

    public static function cambiarEstadoRecibo()
    {
        isAuth();
        permisosCaja();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folio = s($_POST['id']);
            $buscado = '';
            $recibo = Facturas::where('folio', $folio);
            $adicional = PagosAdicionales::where('folio', $folio);

            $buscado = !$recibo ? $adicional : $recibo;

            if (!$buscado) {
                echo json_encode([
                    'tipo' => 'Error',
                    'msg' => 'No existe el recibo'
                ]);

                return;
            }

            $resultado = false;

            if (isset($buscado->numero_meses)) {
                $resultado = Facturas::eliminarFolios($folio);

                if ($resultado) {
                    $resultado = Facturacion::eliminarFolios($folio);
                }
            } else {
                $resultado = PagosAdicionales::eliminarFolios($folio);
            }

            if ($resultado) {
                echo json_encode([
                    'tipo' => 'Exito',
                    'msg' => 'Recibo cancelado correctamente'
                ]);

                return;
            }

            echo json_encode([
                'tipo' => 'Error',
                'msg' => 'No se pudo cancelar el recibo'
            ]);
        }
    }
}
