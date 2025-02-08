<?php

namespace Controllers;

use APIs\UsuariosAPI;
use Dompdf\Dompdf;
use Model\Historial_Facturacion;
use MVC\Router;
use NumberFormatter;

class PDFController
{
    public static function recibo(Router $router)
    {
        isAuth();

        $idUsuario = s($_GET['id']);
        $folio = s($_GET['folio']);
        $reporte = true;

        $recibo = Historial_Facturacion::where('folio', $folio);
        $instanciaUsuario = new UsuariosAPI();
        $usuarioResultado = $instanciaUsuario->consultar($idUsuario);
        $usuario = array_shift($usuarioResultado);

        if (!$usuario->id || !$recibo->folio) {
            header('Location: /consultar');
            return;
        }

        $domPDF = new Dompdf();

        ob_start();

        include_once __DIR__ . '/../views/PDF/recibo.php';

        $content = ob_get_clean();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($content);
        $domPDF->setPaper('A4');

        $domPDF->render();
        $domPDF->stream("Factura", array("Attachment" => false));
    }
}
