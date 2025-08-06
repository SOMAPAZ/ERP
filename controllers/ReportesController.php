<?php

namespace Controllers;

use MVC\Router;
use Empleados\Empleado;
use APIs\ReportesAPI;
use Reportes\Categoria;
use Reportes\Reporte;
use Reportes\Notas;
use Reportes\Incidencias;
use Reportes\Prioridad;
use Reportes\Material;
use Reportes\Unidades;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Reportes\Evidencias;

class ReportesController
{
    private static $apartado = 'reportes';
    private static $links = ['reportes', 'generar-reporte', 'filtrar-reportes'];
    private static $especiales = 'nuevo-reporte';

    public static function index(Router $router)
    {
        isAuth();

        $router->render('reports/reportes', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales
        ]);
    }

    public static function reporte(Router $router)
    {
        isAuth();

        $folioRep = s($_GET['folio']);
        $reporte = Reporte::where('id', $folioRep);

        if (!$reporte) {
            header("Location: /reportes");
            return;
        }

        $categoria = Categoria::where('id', $reporte->id_category);
        $incidencia = Incidencias::where('id', $reporte->id_incidence);
        $prioridad = Prioridad::where('id', $reporte->id_priority);
        $realizado = Empleado::where('id', $reporte->employee_id);

        $router->render('reports/reporte-unico', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales,
            'reporte' => $reporte,
            'categoria' => $categoria,
            'incidencia' => $incidencia,
            'prioridad' => $prioridad,
            'realizado' => $realizado,
        ]);
    }

    public static function formReporte(Router $router)
    {
        isAuth();

        $router->render('reports/generar-reporte', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales
        ]);
    }

    public static function generarReporte()
    {
        isAuth();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reporte = new Reporte($_POST);

            if ($reporte->id_user === "") $reporte->id_user = 0;

            $responsable = Empleado::find($_SESSION['empleado_id']);
            $reporte->employee_id = $responsable->id;
            $reporte->id_status = 1;
            $reporte->created = date('Y-m-d H:i:s');

            $anterior = Reporte::obtenerUltimoFolio();
            $folioAnterior = $anterior->id ?? 0;

            if (intval(substr($folioAnterior, 0, 2)) !== intval(date('y')) || intval(substr($folioAnterior, 2, 2)) !== intval(date('m'))) {
                $secuencial = 0;
            } else {
                $secuencial = intval(substr($folioAnterior, 5, 9));
            }

            $secuencialNuevo = str_pad($secuencial + 1, 4, '0', STR_PAD_LEFT);
            $reporte->id_employee_sup = s($_SESSION['empleado_id']);

            $year = date('y');
            $mes = date('m');
            $nuevoFolio = $year . $mes . "-" . $secuencialNuevo;
            $reporte->id = $nuevoFolio;

            $resultado = $reporte->crearReporte($reporte->id);

            if ($resultado) {
                $rep = Reporte::where('id', $reporte->id);
                $rep->id_category = Categoria::find($rep->id_category)->name;
                $rep->id_incidence = Incidencias::find($rep->id_incidence)->name;
                $rep->id_priority = Prioridad::find($rep->id_priority)->name;

                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El reporte ha sido creado correctamente con el folio {$reporte->id}",
                    'folio' => $reporte->id,
                    'reporte' => $rep
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function generarNotaReporte()
    {
        isAuth();
        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            $nota = new Notas();
            $nota->id_report = s($_POST['id_report']);
            $nota->note = s($_POST['note']);
            $nota->employee_id = s($_SESSION['empleado_id']);
            $nota->created = date('Y-m-d H:i:s');

            if (isset($_FILES['image']['tmp_name'])) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['image']['tmp_name']);
                $image->cover(800, 800);

                $nota->image = $nombreImagen;
            }

            if ($nota->image !== "") {
                if (!is_dir(CARPETA_IMAGENES_REPORTES)) {
                    mkdir(CARPETA_IMAGENES_REPORTES);
                }

                $image->save(CARPETA_IMAGENES_REPORTES . $nombreImagen);
            }

            $resultado = $nota->guardar();

            if ($resultado) {
                $nuevo = Notas::where('created', $nota->created);
                $id = $nuevo->id;

                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "La nota ha sido creada correctamente",
                    'imagen' => $nota->image,
                    'created' => $nota->created,
                    'id' => $id
                ];
            }
            echo json_encode($respuesta);
        }
    }

    public static function guardarMateriales()
    {
        isAuth();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $material = new Material($_POST);
            $material->id_employee = s($_SESSION['empleado_id']);
            $material->created = date('Y-m-d H:i:s');

            $resultado = $material->guardar();

            if ($resultado) {
                $und = Unidades::where('id', $material->id_unity);
                $res = Material::where('created', $material->created);

                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El material ha sido registrado correctamente",
                    'material' => $material->material,
                    'unidad' => $und->name,
                    'cantidad' => $material->quantity,
                    'id' => $res->id
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function editFormReporte(Router $router)
    {
        isAuth();

        $folioRep = s($_GET['folio']);
        $reporte = Reporte::where('id', $folioRep);

        if (!$reporte) {
            header("Location: /reportes");
            return;
        }

        $router->render('reports/editar-reporte', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales,
            'reporte' => $reporte
        ]);
    }

    public static function actualizarReporte()
    {
        isAuth();

        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $folio = s($_POST['folio']);
            $reporte = Reporte::where('id', $folio);

            if (!$reporte) {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'No existe el reporte con ese folio'
                ];

                echo json_encode($respuesta);
                return;
            }

            $reporte->sincronizar($_POST);

            $resultado = $reporte->guardar();

            if ($resultado) {
                $rep = Reporte::where('id', $folio);
                $rep->id_category = Categoria::find($rep->id_category)->name;
                $rep->id_incidence = Incidencias::find($rep->id_incidence)->name;
                $rep->id_priority = Prioridad::find($rep->id_priority)->name;

                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El reporte {$folio} ha sido actualizado correctamente",
                    'folio' => $folio,
                    'prioridad' => $reporte->id_priority,
                    'fecha' => $reporte->created,
                    'idUser' => $reporte->id_user,
                    'reporte' => $rep
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function eliminarReporte()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folio = s($_POST['folio']);
            $reporte = Reporte::where('id', $folio);

            if (!$reporte) {
                $respuesta = [
                    'tipo' => 'error',
                    'datos' => 'No existe reporte con ese folio'
                ];

                echo json_encode($respuesta);
                return;
            }

            $resultado = $reporte->eliminarReporte($reporte->id);

            if ($resultado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Se ha eliminado correctamente el reporte',
                    'folio' => $folio,
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function eliminarNota()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $nota = Notas::where('id', $id);

            if (!$nota) {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al eliminar la nota'
                ];

                echo json_encode($respuesta);
                return;
            }

            $resultado = $nota->eliminar();

            if (!$resultado) {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al eliminar la nota'
                ];

                echo json_encode($respuesta);
                return;
            }

            if ($resultado && $nota->image !== "") {
                $imagenEliminada = unlink(CARPETA_IMAGENES_REPORTES . $nota->image);
            }

            if ($resultado && $nota->image === "") $imagenEliminada = true;

            if ($resultado && $imagenEliminada) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Nota e imagen eliminadas correctamente',
                    'id' => $id
                ];
                echo json_encode($respuesta);
            }
        }
    }
    public static function eliminarMateriales()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $nota = Material::where('id', $id);

            if (!$nota) {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al eliminar el material'
                ];

                echo json_encode($respuesta);
                return;
            }

            $resultado = $nota->eliminar();

            if (!$resultado) {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al eliminar el material'
                ];

                echo json_encode($respuesta);
                return;
            }

            if ($resultado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Material eliminado correctamente',
                    'id' => $id
                ];
                echo json_encode($respuesta);
            }
        }
    }

    public static function reportesAPI()
    {
        isAuth();

        $status = s($_GET['s']);
        $limit = s($_GET['limit']);
        $offset = s($_GET['offset']);

        $reportes = Reporte::belongsToPaginacion('id_status', $status, $offset, $limit);
        foreach($reportes as $reporte) {
            $reporte->id_priority = Prioridad::find($reporte->id_priority);
            $reporte->id_category = Categoria::find($reporte->id_category)->name;
            $reporte->id_incidence = Incidencias::find($reporte->id_incidence);
        }

        $total = Reporte::totalWhere('id_status', $status);

        $res = [
            'reportes'=>$reportes,
            'total'=>$total
        ];

        echo json_encode($res);
    }

    public static function notasAPI()
    {
        isAuth();

        $folio = s($_GET['id_report']);
        $notas = Notas::belongsTo('id_report', $folio);

        echo json_encode($notas);
    }

    public static function materialesAPI()
    {
        isAuth();

        $folio = s($_GET['id_report']);
        $materiales = Material::belongsTo('id_report', $folio);

        foreach($materiales as $material) {
            $material->id_unity = Unidades::find($material->id_unity)->name;
        }

        echo json_encode($materiales);
    }

    public static function JSONreporte() 
    {
        isAuth();

        $folioRep = s($_GET['folio']);
        $reporte = Reporte::where('id', $folioRep);

        if (!$reporte) {
            header("Location: /reportes");
            return;
        }

        $reporte->id_category = Categoria::find($reporte->id_category);
        $reporte->id_incidence = Incidencias::find($reporte->id_incidence);
        $reporte->id_priority = Prioridad::find($reporte->id_priority);

        echo json_encode($reporte);
    }

    public static function statusReporte()
    {
        isAuth();

        $estado = Reporte::where('id', s($_GET['folio']));

        echo json_encode($estado->id_status);
    }

    public static function actualizarStatusReporte()
    {
        isAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $informacion = explode(',', $_POST['args']);
            
            $reporte = Reporte::where('id', $informacion[1]);

            $reporte->id_status = $informacion[0];

            if($reporte->employee_id === null) {
                $reporte->employee_id = 0;
            }

            if($informacion[0] == '3') {
                $reporte->id_employee_sup = s($_SESSION['empleado_id']);
            }

            if($reporte->id_user == null) {
                $reporte->id_user = 0;
            }

            $res = $reporte->guardar();

            if($res) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'msg' => 'Estado del reporte actualizado'
                ];
                echo json_encode($respuesta);
            }
        }
    }

    public static function guardarEvidencias() {
        isAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            try {
                $arrays = json_decode($_POST['args']);
                $datos = [];
                foreach($arrays as $array) {
                    $datos[] = [
                        'id_report' => $array->id_report, 
                        'image' =>$array->image
                    ];
                }
                foreach($datos as $dato) {
                    $evidencia = new Evidencias($dato);
                    $res = $evidencia->guardar();
    
                    if(!$res) {
                        echo json_encode([
                            'tipo' => 'Error',
                            'msg' => 'Hubo un error al guardar los datos'
                        ]);
                        return;
                    }
                }
                echo json_encode([
                    'tipo' => 'Exito',
                    'msg' => 'Evidencias guardadas correctamente',
                    'datos' => $datos
                ]);
                
            } catch (\Throwable $th) {
                echo json_encode([
                    'tipo' => 'Fail',
                    'msg' => 'Recarge la pagina',
                    'error' => $th
                ]);
            }
        }
    }

    public static function obtenerEvidencias() {
        isAuth();

        $folio = s($_GET['folio']);
        $evidencias = Evidencias::belongsTo('id_report', $folio);

        if(count($evidencias) === 0) {
            $evidencias = [];
        }

        echo json_encode($evidencias);
    }
    
        public static function filtrar(Router $router)
    {
        isAuth();

        $router->render('reports/filtrar-reportes', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales
        ]);
    }

    public static function filtrarReportes(){
        isAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $regex = "/^\d{4}-\d{4}$/";

            $explode = explode(',', $_POST['args']);
            
            if(count($explode) === 1) {

                if(preg_match($regex, $explode[0]) === 1) {
                    $res = Reporte::consultarCoincidenciasID($explode[0]);
                    if(count($res) === 0) $res = [];
    
                    echo json_encode($res);
                    return;
                }

                $res = Reporte::consultarCoincidencias($explode[0]);
                if(count($res) === 0) $res = [];

                echo json_encode($res);
                return;

            }

            $res = Reporte::consultarCoincidenciasIds($explode[0], $explode[1]);
            if(count($res) === 0) $res = [];
            echo json_encode($res);
        }
    }
     public static function filtrarReportesCoincidencias()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folio = $_POST['args'];

            $res = Reporte::consultarCoincidenciasIdsexact($folio);
            if (count($res) === 0) $res = [];
            echo json_encode($res);
        }
    }
}
