<?php

namespace Classes;

class Deuda
{
    public $totalAgua;
    public $totalDrenaje;
    public $totalSanamiento;
    public $aguaRezago;
    public $aguaIva;
    public $aguaDescuento;
    public $drenajeRezago;
    public $drenajeIva;
    public $drenajeDescuento;

    public function __construct()
    {
        $this->totalAgua;
        $this->totalDrenaje;
        $this->totalSanamiento;
        $this->aguaRezago;
        $this->aguaIva;
        $this->aguaDescuento;
        $this->drenajeRezago;
        $this->drenajeIva;
        $this->drenajeDescuento;
    }

    public function calcularTotales($object)
    {
        $idUsuario = 0;
        foreach ($object as $key => $adeudo) {
            if ($idUsuario !== $adeudo->id_user) {

                $totalAgua = 0;
                $totalDrenaje = 0;
                $totalSanamiento = 0;
                $aguaRezago = 0;
                $aguaIva = 0;
                $aguaDescuento = 0;
                $drenajeRezago = 0;
                $drenajeIva = 0;
                $drenajeDescuento = 0;
            }
            $idUsuario = $adeudo->id_user;

            $totalAgua += $adeudo->water;
            $totalDrenaje += $adeudo->drain;
            $totalSanamiento += $adeudo->sanitation;

            $aguaRezago += $adeudo->water_late;
            $aguaIva += $adeudo->water_iva;
            $aguaDescuento += $adeudo->water_late_discount;
            $drenajeRezago += $adeudo->drain_late;
            $drenajeIva += $adeudo->drain_iva;
            $drenajeDescuento += $adeudo->drain_late_discount;

            $actual = $adeudo->id_user;
            $proximo = $object[$key + 1]->id_user ?? 0;
            if (esUltimo($actual, $proximo)) {
                $this->totalAgua = $totalAgua;
                $this->totalDrenaje = $totalDrenaje;
                $this->totalSanamiento = $totalSanamiento;
                $this->aguaRezago = $aguaRezago;
                $this->aguaIva = $aguaIva;
                $this->aguaDescuento = $aguaDescuento;
                $this->drenajeRezago = $drenajeRezago;
                $this->drenajeIva = $drenajeIva;
                $this->drenajeDescuento = $drenajeDescuento;
            }
        }

        return $this;
    }
}
