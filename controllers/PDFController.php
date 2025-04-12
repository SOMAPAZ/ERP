<?php

namespace Controllers;

use Dompdf\Dompdf;
use APIs\UsuariosAPI;
use Reportes\Reporte;
use Usuarios\Usuario;
use Reportes\Material;
use Reportes\Unidades;
use Usuarios\TipoToma;
use Empleados\Empleado;
use Reportes\Categoria;
use Facturacion\Cuentas;
use Reportes\Evidencias;
use Facturacion\Facturas;
use Reportes\Incidencias;
use Usuarios\TipoConsumo;
use Facturacion\CorteCaja;
use Facturacion\PagosAdicionales;

class PDFController
{
    public static function recibo()
    {
        isAuth();

        $idUsuario = s($_GET['id']);
        $folio = s($_GET['folio']);


        $recibo = Facturas::where('folio', $folio);
        $instanciaUsuario = new UsuariosAPI();
        $usuarioResultado = $instanciaUsuario->consultar($idUsuario);
        $usuario = array_shift($usuarioResultado);

        if (!$usuario->id || !$recibo->folio) {
            header('Location: /consultar');
            return;
        }

        $pagos_adicionales = Facturas::obtenerAdicionales('folio', $folio, 'id_cuentas', '0');
        foreach ($pagos_adicionales as $pago) {
            $pago->id_cuentas = Cuentas::find($pago->id_cuentas);
        }

        $usuario = Usuario::find($idUsuario);
        $tipo_toma = TipoToma::find($usuario->id_servicetype);
        $tipo_consumo = TipoConsumo::find($usuario->id_consumtype);
        $empleado = Empleado::find($recibo->empleado_id);

        $domPDF = new Dompdf();
        ob_start();

        include_once __DIR__ . '/../views/PDF/recibo-general.php';

        $content = ob_get_clean();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($content);
        $domPDF->setPaper('A4', 'landscape');

        $domPDF->render();
        $domPDF->stream("Factura", array("Attachment" => false));
    }

    public static function reciboAdicionales()
    {
        isAuth();

        $idUsuario = s($_GET['id']);
        $folio = s($_GET['folio']);

        $recibo = PagosAdicionales::where('folio', $folio);

        if ($idUsuario !== "0") {
            $instanciaUsuario = new UsuariosAPI();

            $usuarioResultado = $instanciaUsuario->consultar($idUsuario);
            $usuario = array_shift($usuarioResultado);

            if (!$usuario->id || !$recibo->folio) {
                header('Location: /consultar');
                return;
            }

            $usuario = Usuario::find($idUsuario);
            $tipo_toma = TipoToma::find($usuario->id_servicetype);
            $tipo_consumo = TipoConsumo::find($usuario->id_consumtype);
        } else {
            if (!$recibo->folio) {
                header('Location: /consultar');
                return;
            }

            $usuario = $recibo->nombre;
            $tipo_toma = 'Sin tipo de toma';
            $tipo_consumo = 'Sin tipo de consumo';
        }

        $empleado = Empleado::find($recibo->id_empleado);
        $listado = PagosAdicionales::belongsTo('folio', $folio);
        foreach ($listado as $li) {
            $li->id_cuenta = Cuentas::find($li->id_cuenta);
        }

        $domPDF = new Dompdf();
        ob_start();

        include_once __DIR__ . '/../views/PDF/recibo-extras.php';

        $content = ob_get_clean();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($content);
        $domPDF->setPaper('A4', 'landscape');

        $domPDF->render();
        $domPDF->stream("Factura", array("Attachment" => false));
    }

    public static function reportePDF()
    {
        isAuth();
        define('DOMPDF_ENABLE_REMOTE', true);

        $folio = s($_GET['folio']);

        $reporte = Reporte::where('id', $folio);

        if ($reporte->id_status != '3') {
            header("Location: /reporte?folio=$folio");
            return;
        }

        $reporte->id_category = Categoria::find($reporte->id_category)->name;
        $reporte->id_incidence = Incidencias::find($reporte->id_incidence)->name;
        $empleado = Empleado::find($reporte->employee_id);
        $empleadoSup = Empleado::find($reporte->id_employee_sup);

        $reporte->employee_id = $empleado->name . " " . $empleado->lastname;
        $reporte->id_employee_sup = $empleadoSup->name . " " . $empleadoSup->lastname;

        $evidencias = Evidencias::belongsTo('id_report', $folio);
        $materiales = Material::belongsTo('id_report', $folio);
        foreach ($materiales as $material) {
            $material->id_unity = Unidades::find($material->id_unity)->name;
        }

        $completo = count($evidencias) !== 0 && count($materiales) !== 0;

        if (!$reporte) {
            header('Location: /reportes');
            return;
        }
        if (!$completo) {
            header("Location: /reporte?folio=$folio");
            return;
        }

        $domPDF = new Dompdf();

        ob_start();

        include_once __DIR__ . '/../views/PDF/reporte.php';

        $content = ob_get_clean();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($content);
        $domPDF->setPaper('A4');

        $domPDF->render();
        $domPDF->stream("Reporte $folio", array("Attachment" => false));
    }

    public static function corteCaja()
    {
        isAuth();
        $folio = s($_GET['folio']);

        $corte = CorteCaja::where('folio', $folio);
        $empleado_entrega = Empleado::find($corte->entrega);
        $empleado_recibe = Empleado::find($corte->recibe);
        $testigo = Empleado::find($corte->testigo);

        $domPDF = new Dompdf();
        ob_start();
        include_once __DIR__ . '/../views/PDF/corte-caja.php';
        $content = ob_get_clean();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($content);
        $domPDF->setPaper('A4');

        $domPDF->render();
        $domPDF->stream("Corte-caja-$folio", array("Attachment" => false));
    }

    public static function contratoServicio()
    {
        isAuth();
        $folio = s($_GET['folio']);
        dd($folio);

        // $contrato = ContratoServicio::where('folio', $folio);
        // $instanciaUsuario = new UsuariosAPI();
        // $usuarioResultado = $instanciaUsuario->consultar($idUsuario);
        // $usuario = array_shift($usuarioResultado);

        // if (!$usuario->id || !$contrato->folio) {
        //     header('Location: /consultar');
        //     return;
        // }

        // $usuario = Usuario::find($idUsuario);
        // $tipo_toma = TipoToma::find($usuario->id_servicetype);
        // $tipo_consumo = TipoConsumo::find($usuario->id_consumtype);
        // $empleado = Empleado::find($contrato->empleado_id);

        // $domPDF = new Dompdf();
        // ob_start();

        // include_once __DIR__ . '/../views/PDF/contrato-servicio.php';

        // $content = ob_get_clean();

        // $options = $domPDF->getOptions();
        // $options->set(array('isRemoteEnabled' => true));
        // $domPDF->setOptions($options);

        // $domPDF->loadHtml($content);
        // $domPDF->setPaper('A4', 'landscape');

        // $domPDF->render();
        // $domPDF->stream("Contrato Servicio", array("Attachment" => false));
    }
}
