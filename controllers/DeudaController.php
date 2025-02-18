<?php

namespace Controllers;

use Facturacion\Facturacion;
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

        foreach ($arr as $adeudo) {
            if (intval($adeudo->estado) === 0) {
                if(($user->id_usertype === "3" || $user->id_usertype === "4") && $adeudo->if_recargo !== "1") {
                    $adeudo->monto_agua = $adeudo->monto_agua * 0.7;
                } elseif($adeudo->if_recargo !== "1" && $user->id_usertype === "2") {
                    $adeudo->monto_agua = $adeudo->monto_agua * 0.5;
                }

                array_push($agua, $adeudo->monto_agua);
                $user->drain == 1 ? array_push($drenaje, ($adeudo->monto_agua) * 0.25) : '';

                if (intval($adeudo->if_recargo) === 1) {
                    $meses++;
                    $mesesContador = $meses;

                    if ($user->drain == 1) {
                        if ($mesesContador > 0) array_push($recargoDrenaje, (($adeudo->monto_agua) * 0.25) * 0.0113 * $mesesContador);
                    }

                    if ($mesesContador > 0) array_push($recargoAgua, ($adeudo->monto_agua) * 0.0113 * $mesesContador);

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

        if ($user->id_consumtype !== '2') {
            $aguaIva = ($montoAgua) * 0.16;
        }

        $drenajeIva = ($montoDrenaje) * 0.16;

        $sumatoriaNatural = $montoAgua + $montoDrenaje;
        $sumatoriaRecargo = $montoRecAgua + $montoRecDren;
        $sumatoriaIva = $aguaIva + $drenajeIva;
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
                'recargos' => [
                    'agua' => round($montoRecAgua, 2),
                    'drenaje' => round($montoRecDren, 2),
                    'total' => round($montoRecAgua + $montoRecDren, 2)
                ],
                'iva' => [
                    'agua' => round($aguaIva, 2),
                    'drenaje' => round($drenajeIva, 2),
                    'total' => round($aguaIva + $drenajeIva, 2)
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
            return $acc + $act->if_recargo;
        }, 0);

        $mesesRezagados = $meses + 1;

        foreach ($arr as $d) {
            if (intval($d->estado) === 0) {
                $mesesRezagados--;

                if ($d->if_recargo !== "1" && ($user->id_usertype === "3" || $user->id_usertype === "4")) { 
                    $d->monto_agua = $d->monto_agua * 0.7;
                } elseif ($d->if_recargo !== "1" && $user->id_usertype === "2") {
                    $d->monto_agua = $d->monto_agua * 0.5;
                }
                
                $agua = round($d->monto_agua, 2);
                $drain = $user->drain == 1 ? round($d->monto_agua * 0.25, 2) : 0;
                $iva_agua = $user->id_consumtype !== '2' ? round($d->monto_agua * 0.16, 2) : 0;
                $iva_drain = round($drain * 0.16, 2);
                $m = $mesesRezagados > 0 ? $mesesRezagados : 0;
                $rec_agua = round($d->monto_agua * 0.0113 * $m, 2);
                $rec_drain = round($drain * 0.0113 * $m, 2);

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
                    'total' => [
                        'natural' => $total_natural,
                        'iva' => $total_iva,
                        'recargos' => $total_rec,
                        'general' => $totalGral
                    ]
                ];
            }
        }

        return $args;
    }
}