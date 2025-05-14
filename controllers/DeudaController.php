<?php

namespace Controllers;

use Facturacion\Facturacion;
use Facturacion\Measured;
use Facturacion\PercentajeDrain;
use Notificaciones\Lecturas;
use Usuarios\Usuario;

class DeudaController
{
    public static $porcentaje_drenaje = 0.25;
    public static $porcentaje_recargo = 0.0113;
    public static $iva = 0.16;

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
            if (!$usuario) {
                echo json_encode($res = [
                    'tipo' => 'Error',
                    'msg' => 'El usuario no existe'
                ]);
                return;
            }
            $meses = Facturacion::belongsToDeuda('id_user', $id);
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
            $meses = Facturacion::belongsToDeuda('id_user', $id);

            $res = self::calcularParciales($meses, $usuario);

            echo json_encode($res);
        } catch (\Throwable $th) {
            echo json_encode($th);
        }
    }

    public static function calcularTotal($arr, $user)
    {
        $agua_inicial = [];
        $drenaje_inicial = [];
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

                self::$porcentaje_drenaje = (PercentajeDrain::where('year', $adeudo->year)->percentaje) / 100 ?? 0.25;

                array_push($agua_inicial, $adeudo->monto_agua);

                if ($user->drain === '1') {
                    $inicial_drenaje = $adeudo->monto_agua * self::$porcentaje_drenaje;
                    array_push($drenaje_inicial, $adeudo->monto_agua * self::$porcentaje_drenaje);
                }

                if (($user->id_usertype === "3" || $user->id_usertype === "4") && $adeudo->if_recargo !== "1") {

                    $adeudo->monto_agua = $adeudo->monto_agua * 0.7;
                } elseif ($adeudo->if_recargo !== "1" && $user->id_usertype === "2") {

                    $adeudo->monto_agua = $adeudo->monto_agua * 0.5;
                }

                array_push($descuentosAgua, $inicial_agua - $adeudo->monto_agua);

                $costo_excedido = 0;

                if ($user->id_servicetype === '3') {
                    $lecturas = Lecturas::getLecturaDate($user->id, $adeudo->year, $adeudo->mes)->lectura ?? 0;
                    $lecturas > 0 ? array_push($esValido, $lecturas) : 0;
                    $mesAnterior = $adeudo->mes - 1 === 0 ? 12 : $adeudo->mes - 1;
                    $yearAnterior = $adeudo->mes === '1' ? $adeudo->year - 1 : $adeudo->year;
                    $lectura_anterior = Lecturas::getLecturaDate($user->id, $yearAnterior, $mesAnterior)->lectura ?? 0;
                    $diferencia_lecturas = round($lecturas - $lectura_anterior, 2);
                    $measured = Measured::obtenerLimites($user->id_intaketype, $user->id_consumtype, $adeudo->year);

                    $excedido = $diferencia_lecturas - $measured->limsup > 0 ? $diferencia_lecturas - $measured->limsup : 0;
                    $costo_excedido = $excedido * $measured->excm3;

                    if ($adeudo->if_recargo !== "1" && $user->id_usertype === "2") {
                        $costo_excedido = $costo_excedido * 0.5;
                    }

                    array_push($excedidosM3, $costo_excedido);
                }

                array_push($agua, $adeudo->monto_agua);

                if ($user->drain === '1') {
                    array_push($drenaje, ($adeudo->monto_agua) * self::$porcentaje_drenaje);
                    array_push($excedidosM3Drenaje, $costo_excedido * self::$porcentaje_drenaje);
                    array_push($descuentosDrenaje, $inicial_drenaje - ($adeudo->monto_agua * self::$porcentaje_drenaje));
                }

                if ($adeudo->if_recargo === '1') {
                    if ($adeudo->estado === '0') $meses++;
                    $mesesContador = $meses;

                    if ($user->drain == 1) {
                        if ($mesesContador > 0) array_push($recargoDrenaje, (($inicial_agua + $costo_excedido) * self::$porcentaje_drenaje) * self::$porcentaje_recargo * $mesesContador);
                    }

                    if ($mesesContador > 0) array_push($recargoAgua, ($inicial_agua + $costo_excedido) * self::$porcentaje_recargo * $mesesContador);

                    $mesesContador--;
                    strlen($adeudo->mes) === 1 ? $mesFR = '0' . $adeudo->mes : $mesFR = $adeudo->mes;
                    array_push($fechas_rez, date("{$adeudo->year}-{$mesFR}-08"));
                }

                strlen($adeudo->mes) === 1 ? $mesF = '0' . $adeudo->mes : $mesF = $adeudo->mes;
                array_push($fechas, date("{$adeudo->year}-{$mesF}-08"));
            }
        }

        $montoAgua = calcular($agua);
        $montoDrenaje = calcular($drenaje);
        $montoRecAgua = calcular($recargoAgua);
        $montoRecDren = calcular($recargoDrenaje);
        $montoMedicion = calcular($excedidosM3);
        $montoMedicionDrenaje = calcular($excedidosM3Drenaje);
        $montoDescuentoAgua = calcular($descuentosAgua);
        $montoDescuentoDrenaje = calcular($descuentosDrenaje);
        $montoDescuentoAguaInicial = calcular($agua_inicial);
        $montoDescuentoDrenajeInicial = calcular($drenaje_inicial);

        if ($user->id_intaketype !== '2') {
            $aguaIva = $montoAgua * self::$iva;
            $excedidosIVA = $montoMedicion * self::$iva;
        }

        $drenajeIva = ($montoDrenaje) * self::$iva;
        $drenajeIvaExcedido = ($montoMedicionDrenaje) * self::$iva;

        $sumatoriaNatural = $montoAgua + $montoDrenaje + $montoMedicion + $montoMedicionDrenaje;
        $sumatoriaRecargo = $montoRecAgua + $montoRecDren;
        $sumatoriaIva = $aguaIva + $drenajeIva + $drenajeIvaExcedido + $excedidosIVA;
        $sumatoria = $sumatoriaNatural + $sumatoriaRecargo + $sumatoriaIva;

        if ($sumatoria > 0) {
            $arg = [
                'periodo' => [
                    'inicio' => $fechas[0],
                    'final' => $fechas[count($fechas) - 1],
                    'inicio_rez' => count($fechas_rez) > 0 ? $fechas_rez[0] : '',
                    'final_rez' => count($fechas_rez) > 0 ? $fechas_rez[count($arr) - (count($arr) - $meses) - 1] : ''
                ],
                'estado' => 'debe',
                'agua_inicial' => round($montoDescuentoAguaInicial, 2),
                'drenaje_inicial' => round($montoDescuentoDrenajeInicial, 2),
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

    public static function calcularParciales($arr, $user)
    {
        $args = [];

        $meses = array_reduce($arr, function ($acc, $act) {
            return $acc + ($act->estado === '0' ? $act->if_recargo : 0);
        }, 0);

        $mesesRezagados = $meses + 1;

        foreach ($arr as $d) {

            if (intval($d->estado) === 0) {
                $inicial_a = $d->monto_agua;

                $desc_a = 0;
                $mesesRezagados--;

                //descuentos
                if ($d->if_recargo !== "1" && ($user->id_usertype === "3" || $user->id_usertype === "4")) {
                    $desc_a = $d->monto_agua * 0.3;
                    $d->monto_agua = $d->monto_agua * 0.7;
                } elseif ($d->if_recargo !== "1" && $user->id_usertype === "2") {
                    $desc_a = $d->monto_agua * 0.5;
                    $d->monto_agua = $d->monto_agua * 0.5;
                }

                $costo_excedido = 0;

                //Lecturas serv.medido
                if ($user->id_servicetype === '3') {
                    $lectura = Lecturas::getLecturaDate($user->id, $d->year, $d->mes)->lectura ?? 0;
                    $mesAnterior = $d->mes - 1 === 0 ? 12 : $d->mes - 1;
                    $yearAnterior = $d->mes === '1' ? $d->year - 1 : $d->year;
                    $lecturaAnterior = Lecturas::getLecturaDate($user->id, $yearAnterior, $mesAnterior)->lectura ?? 0;
                    $diferencia_lecturas = round($lectura - $lecturaAnterior < 0 ? 0 : $lectura - $lecturaAnterior, 2);

                    $measured = Measured::obtenerLimites($user->id_intaketype, $user->id_consumtype, $d->year);
                    $excedido = $diferencia_lecturas - $measured->limsup > 0 ? $diferencia_lecturas - $measured->limsup : 0;
                    $costo_excedido = $excedido * $measured->excm3;

                    $costo_excedido_drenaje = $user->drain === "1" ? ($costo_excedido * self::$porcentaje_drenaje) : 0;

                    if ($d->if_recargo !== "1" && $user->id_usertype === "2") {
                        $costo_excedido += $costo_excedido * 0.5;
                        $costo_excedido_drenaje += $costo_excedido_drenaje * 0.5;
                    }

                    $iva_lim_exc = $user->id_intaketype !== '2' ? ($costo_excedido * self::$iva) : 0;
                    $iva_lim_exc_drenaje = $costo_excedido_drenaje * self::$iva;
                }

                //Montos
                $agua = ($d->monto_agua);
                $inicial_d = $user->drain == 1 ? ($inicial_a * self::$porcentaje_drenaje) : 0;
                $drain = $user->drain == 1 ? ($d->monto_agua * self::$porcentaje_drenaje) : 0;
                $desc_dren = $user->drain == 1 ? ($desc_a * self::$porcentaje_drenaje) : 0;
                $iva_agua = $user->id_intaketype !== '2' ? ($d->monto_agua * self::$iva) : 0;
                $iva_drain = ($drain * self::$iva);
                $m = $mesesRezagados > 0 ? $mesesRezagados : 0;

                //recargos
                $rec_agua = (($d->monto_agua + $costo_excedido) * self::$porcentaje_recargo * $m);
                $rec_drain = ($drain * self::$porcentaje_recargo * $m);

                //totales
                $total_natural = ($agua + $drain);
                $total_iva = ($iva_agua + $iva_drain);
                $total_rec = ($rec_agua + $rec_drain);
                $totalGral = ($total_natural + $total_iva + $total_rec);

                $args[] = [
                    'idxDB' => $d->id,
                    'fecha' => date("{$d->year}-{$d->mes}-08"),
                    'year' => $d->year,
                    'mes' => $d->mes,
                    'tarifa' => floatval($inicial_a),
                    'agua' => round($agua, 2),
                    'desc_agua' => round($desc_a, 2),
                    'drenaje' => round($inicial_d, 2),
                    'desc_drenaje' => round($desc_dren, 2),
                    'iva_agua' => round($iva_agua, 2),
                    'iva_drenaje' => round($iva_drain, 2),
                    'rec_agua' => round($rec_agua, 2),
                    'rec_drain' => round($rec_drain, 2),
                    'medido' => [
                        'lectura_actual' => !isset($lectura) ? 0 : floatval($lectura),
                        'diferencia_lectura_anterior' => !isset($diferencia_lecturas) ? 0 : $diferencia_lecturas,
                        'excedido' => !isset($excedido) ? 0 : round($excedido, 2),
                        'costo_excedido' => (!isset($costo_excedido) || !isset($costo_excedido_drenaje)) ? 0 : round($costo_excedido + $costo_excedido_drenaje, 2),
                        'iva_lim_exc' => (!isset($iva_lim_exc) || !isset($iva_lim_exc_drenaje)) ? 0 : round($iva_lim_exc + $iva_lim_exc_drenaje, 2)
                    ],
                    'total' => [
                        'natural' => round($total_natural, 2),
                        'iva' => round($total_iva, 2),
                        'recargos' => round($total_rec, 2),
                        'general' => round($totalGral, 2),
                        'general_excedido' => round($totalGral + ($costo_excedido ?? 0) + ($costo_excedido_drenaje ?? 0) + ($iva_lim_exc ?? 0) + ($iva_lim_exc_drenaje ?? 0), 2)
                    ]
                ];
            }
        }

        return $args;
    }
}
