<?php

namespace Controllers;

use Facturacion\Facturacion;
use Usuarios\Usuario;

class DeudaController
{
    public static function totalDebt()
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
        $meses = Facturacion::belongsTo('id_user', $id);
        $res = self::calcularAdeudo($meses, $usuario);

        echo json_encode($res);
    }

    private static function calcularAdeudo($arr, $user)
    {
        $agua = [];
        $drenaje = [];
        $aguaIva = 0;
        $drenajeIva = 0;
        $recargoAgua = [];
        $recargoDrenaje = [];
        $meses = 0;

        foreach ($arr as $adeudo) {
            if (intval($adeudo->estado) === 0) {
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
                }
            }
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
}
