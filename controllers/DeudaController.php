<?php

namespace Controllers;

use Facturacion\Facturacion;
use Facturacion\Measured;
use Notificaciones\Lecturas;
use Usuarios\Usuario;

class DeudaController
{
    public static function totalDebt()
    {
        isAuth();
        permisosCaja();
        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);

        try {
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
            $meses = Facturacion::belongsTo('id_user', $id);
            $res = self::calcularTotal($meses, $usuario);
    
            echo json_encode($res);
        } catch (\Throwable $th) {
            echo json_encode($th);
        }

    }

    public static function desgloseDebt()
    {
        isAuth();
        permisosCaja();
        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);
        try {
            if (!$id) {
                $res = [
                    'tipo' => 'Error',
                    'msg' => 'Es requerido el id'
                ];
    
                echo json_encode($res);
                return;
            }
            $usuario = Usuario::find($id);
            $meses = Facturacion::belongsTo('id_user', $id);
    
            $res = self::calcularParciales($meses, $usuario);
    
            echo json_encode($res);
        } catch (\Throwable $th) {
            echo json_encode($th);
        }

    }

    private static function calcularTotal($arr, $user)
    {
        $agua = [];
        $drenaje = [];
        $aguaIva = 0;
        $drenajeIva = 0;
        $recargoAgua = [];
        $recargoDrenaje = [];
        $meses = 0;
        $fechas = [];
        $fechas_rez = [];
        $excedidosM3 = [];
        $excedidosM3Drenaje = [];
        $excedidosIVA = 0;
        $esValido = [];
        $descuentosAgua = [];
        $descuentosDrenaje = [];

        foreach ($arr as $adeudo) {
            if ($adeudo->estado === '0') {
                $inicial_agua = $adeudo->monto_agua;
                $inicial_drenaje = $adeudo->monto_agua * 0.25;

                if(($user->id_usertype === "3" || $user->id_usertype === "4") && $adeudo->if_recargo !== "1") {

                    $adeudo->monto_agua = $adeudo->monto_agua * 0.7;

                } elseif($adeudo->if_recargo !== "1" && $user->id_usertype === "2") {

                    $adeudo->monto_agua = $adeudo->monto_agua * 0.5;

                }

                array_push($descuentosAgua, $inicial_agua - $adeudo->monto_agua);

                $costo_excedido = 0;

                if($user->id_servicetype === '3') {
                    $lecturas = Lecturas::getLecturaDate($user->id, $adeudo->year, $adeudo->mes)->lectura ?? 0;
                    $lecturas > 0 ? array_push($esValido, $lecturas) : 0;
                    $mesAnterior = $adeudo->mes - 1 === 0 ? 12 : $adeudo->mes - 1;
                    $yearAnterior = $adeudo->mes === '1' ? $adeudo->year - 1 : $adeudo->year;
                    $lectura_anterior = Lecturas::getLecturaDate($user->id, $yearAnterior, $mesAnterior )->lectura ?? 0;
                    $diferencia_lecturas = round($lecturas - $lectura_anterior, 2);
                    $measured = Measured::obtenerLimites($user->id_intaketype, $user->id_consumtype, $adeudo->year);

                    $excedido = $diferencia_lecturas - $measured->limsup > 0 ? $diferencia_lecturas - $measured->limsup : 0;
                    $costo_excedido = $excedido * $measured->excm3;

                    array_push($excedidosM3, $costo_excedido);
                }

                array_push($agua, $adeudo->monto_agua);

                if($user->drain === '1') {
                    array_push($drenaje, ($adeudo->monto_agua) * 0.25);
                    array_push($excedidosM3Drenaje, $costo_excedido * 0.25);
                    array_push($descuentosDrenaje, $inicial_drenaje - ($adeudo->monto_agua * 0.25));
                }

                if ($adeudo->if_recargo === '1') {
                    if($adeudo->estado === '0') $meses++;
                    $mesesContador = $meses;

                    if ($user->drain == 1) {
                        if ($mesesContador > 0) array_push($recargoDrenaje, (($adeudo->monto_agua + $costo_excedido) * 0.25) * 0.0113 * $mesesContador);
                    }

                    if ($mesesContador > 0) array_push($recargoAgua, ($adeudo->monto_agua + $costo_excedido) * 0.0113 * $mesesContador);

                    $mesesContador--;
                    strlen($adeudo->mes) === 1 ? $mesFR = '0' . $adeudo->mes : $mesFR = $adeudo->mes;
                    array_push($fechas_rez, date("{$adeudo->year}-{$mesFR}-08"));
                }
            }

            strlen($adeudo->mes) === 1 ? $mesF = '0' . $adeudo->mes : $mesF = $adeudo->mes;
            array_push($fechas, date("{$adeudo->year}-{$mesF}-08"));
        }

        $montoAgua = calcular($agua);
        $montoDrenaje = calcular($drenaje);
        $montoRecAgua = calcular($recargoAgua);
        $montoRecDren = calcular($recargoDrenaje);
        $montoMedicion = calcular($excedidosM3);
        $montoMedicionDrenaje = calcular($excedidosM3Drenaje);
        $montoDescuentoAgua = calcular($descuentosAgua);
        $montoDescuentoDrenaje = calcular($descuentosDrenaje);

        if ($user->id_intaketype !== '2') {
            $aguaIva = $montoAgua * 0.16;
            $excedidosIVA = $montoMedicion * 0.16;
        }

        $drenajeIva = ($montoDrenaje) * 0.16;
        $drenajeIvaExcedido = ($montoMedicionDrenaje) * 0.16;

        $sumatoriaNatural = $montoAgua + $montoDrenaje + $montoMedicion + $montoMedicionDrenaje;
        $sumatoriaRecargo = $montoRecAgua + $montoRecDren;
        $sumatoriaIva = $aguaIva + $drenajeIva + $drenajeIvaExcedido + $excedidosIVA;
        $sumatoria = $sumatoriaNatural + $sumatoriaRecargo + $sumatoriaIva;

        if ($sumatoria > 0) {
            $arg = [
                'periodo' => [
                    'inicio' => $fechas[0],
                    'final' => $fechas[count($arr) - 1],
                    'inicio_rez' => count($fechas_rez) > 0 ? $fechas_rez[0] : '',
                    'final_rez' => count($fechas_rez) > 0 ? $fechas_rez[count($arr) - (count($arr) - $meses) - 1] : ''
                ],
                'estado' => 'debe',
                'agua' => round($montoAgua, 2),
                'drenaje' => round($montoDrenaje, 2),
                'm3_excedido_agua' => round($montoMedicion, 2),
                'm3_excedido_drenaje' => round($montoMedicionDrenaje, 2),
                'excedio' => count($esValido),
                'recargos' => [
                    'agua' => round($montoRecAgua, 2),
                    'drenaje' => round($montoRecDren, 2),
                    'total' => round($montoRecAgua + $montoRecDren, 2)
                ],
                'iva' => [
                    'agua' => round($aguaIva, 2),
                    'drenaje' => round($drenajeIva, 2),
                    'm3_excedido_agua' => round($excedidosIVA, 2),
                    'm3_excedido_drenaje' => round($drenajeIvaExcedido, 2),
                    'total' => round($aguaIva + $drenajeIva + $excedidosIVA + $drenajeIvaExcedido, 2)
                ],
                'descuentos' => [
                    'agua' => round($montoDescuentoAgua, 2),
                    'drenaje' => round($montoDescuentoDrenaje, 2),
                    'total' => round($montoDescuentoAgua + $montoDescuentoDrenaje, 2)
                ],
                'meses' => [
                    'rezagados' => $meses,
                    'naturales' => count($arr) - $meses,
                    'totales' => count($arr)
                ],
                'total' => round($sumatoria, 2)
            ];
        } else {
            $arg = [
                'estado' => 'pagado',
                'msg' => 'El usuario no presenta adeudo'
            ];
        }

        return $arg;
    }

    private static function calcularParciales($arr, $user)
    {
        $args = [];

        $meses = array_reduce($arr, function ($acc, $act) {
            return $acc + ($act->estado === '0' ? $act->if_recargo : 0);
        }, 0);

        $mesesRezagados = $meses + 1;

        foreach ($arr as $d) {
            
            if (intval($d->estado) === 0) {
                $mesesRezagados--;

                //descuentos
                if ($d->if_recargo !== "1" && ($user->id_usertype === "3" || $user->id_usertype === "4")) { 
                    $d->monto_agua = $d->monto_agua * 0.7;
                } elseif ($d->if_recargo !== "1" && $user->id_usertype === "2") {
                    $d->monto_agua = $d->monto_agua * 0.5;
                }
                
                $costo_excedido = 0;
                
                //Lecturas serv.medido
                if($user->id_servicetype === '3') {
                    $lectura = Lecturas::getLecturaDate($user->id, $d->year, $d->mes)->lectura ?? 0;
                    $mesAnterior = $d->mes - 1 === 0 ? 12 : $d->mes - 1;
                    $yearAnterior = $d->mes === '1' ? $d->year - 1 : $d->year;
                    $lecturaAnterior = Lecturas::getLecturaDate($user->id, $yearAnterior, $mesAnterior )->lectura ?? 0;
                    $diferencia_lecturas = round($lectura - $lecturaAnterior < 0 ? 0 : $lectura - $lecturaAnterior, 2);
                    
                    $measured = Measured::obtenerLimites($user->id_intaketype, $user->id_consumtype, $d->year);
                    $excedido = $diferencia_lecturas - $measured->limsup > 0 ? $diferencia_lecturas - $measured->limsup : 0;
                    $costo_excedido = $excedido * $measured->excm3;
                    $costo_excedido_drenaje = $costo_excedido * 0.25;
                    $iva_lim_exc = $user->id_intaketype !== '2' ? round($costo_excedido * 0.16, 2) : 0;
                    $iva_lim_exc_drenaje = $user->drain == 1 && $user->id_intaketype !== '2' ? round($costo_excedido_drenaje * 0.16, 2) : 0;
                }

                //Montos
                $agua = round($d->monto_agua, 2);
                $drain = $user->drain == 1 ? round($d->monto_agua * 0.25, 2) : 0;
                $iva_agua = $user->id_intaketype !== '2' ? round($d->monto_agua * 0.16, 2) : 0;
                $iva_drain = round($drain * 0.16, 2);
                $m = $mesesRezagados > 0 ? $mesesRezagados : 0;
                
                //recargos
                $rec_agua = round(($d->monto_agua + $costo_excedido) * 0.0113 * $m, 2);
                $rec_drain = round($drain * 0.0113 * $m, 2);
                
                //totales
                $total_natural = round($agua + $drain, 2);
                $total_iva = round($iva_agua + $iva_drain, 2);
                $total_rec = round($rec_agua + $rec_drain, 2);
                $totalGral = round($total_natural + $total_iva + $total_rec, 2);

                $args[] = [
                    'idxDB' => $d->id,
                    'fecha' => date("{$d->year}-{$d->mes}-08"),
                    'year' => $d->year,
                    'mes' => $d->mes,
                    'agua' => $agua,
                    'drenaje' => $drain,
                    'iva_agua' => $iva_agua,
                    'iva_drenaje' => $iva_drain,
                    'rec_agua' => $rec_agua,
                    'rec_drain' => $rec_drain,
                    'medido' => [
                        'lectura_actual' => !isset($lectura) ? 0 : floatval($lectura),
                        'diferencia_lectura_anterior' => !isset($diferencia_lecturas) ? 0 : $diferencia_lecturas,
                        'excedido' => !isset($excedido) ? 0 : round($excedido, 2),
                        'costo_excedido' => !isset($costo_excedido) || !isset($costo_excedido_drenaje) ? 0 : round($costo_excedido + $costo_excedido_drenaje, 2),
                        'iva_lim_exc' => !isset($iva_lim_exc) || !isset($iva_lim_exc_drenaje) ? 0 : round($iva_lim_exc + $iva_lim_exc_drenaje, 2)
                    ],
                    'total' => [
                        'natural' => $total_natural,
                        'iva' => $total_iva,
                        'recargos' => $total_rec,
                        'general' => $totalGral,
                        'general_excedido' => round($totalGral + $costo_excedido ?? 0 + $costo_excedido_drenaje ?? 0 + $iva_lim_exc + $iva_lim_exc_drenaje ?? 0, 2)
                    ]
                ];
            }
        }

        return $args;
    }
}