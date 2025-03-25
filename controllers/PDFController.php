<?php

namespace Controllers;

use APIs\UsuariosAPI;
use Dompdf\Dompdf;
use Empleados\Empleado;
use Facturacion\Facturas;
use Reportes\Categoria;
use Reportes\Evidencias;
use Reportes\Incidencias;
use Reportes\Material;
use Reportes\Reporte;
use Reportes\Unidades;
use Usuarios\TipoConsumo;
use Usuarios\TipoToma;
use Usuarios\Usuario;

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

        $usuario = Usuario::find($idUsuario);
        $tipo_toma = TipoToma::find($usuario->id_servicetype);
        $tipo_consumo = TipoConsumo::find($usuario->id_consumtype);

        $domPDF = new Dompdf();
        ob_start();

        include_once __DIR__ . '/../views/PDF/recibo-horizontal.php';

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
}
