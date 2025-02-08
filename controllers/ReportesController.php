<?php

namespace Controllers;

use MVC\Router;
use Empleados\Empleado;
use APIs\ReportesAPI;
use APIs\MaterialRepAPI;
use Reportes\Categoria;
use Reportes\Reporte;
use Reportes\Notas;
use Reportes\Incidencias;
use Reportes\Prioridad;
use Reportes\Materiales;
use Reportes\Material;
use Reportes\Unidades;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReportesController
{
    private static $apartado = 'reportes';
    private static $links = ['reportes', 'generar-reporte'];
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

        // dd($realizado);

        $router->render('reports/reporte-unico', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'especiales' => self::$especiales,
            'reporte' => $reporte,
            'categoria' => $categoria,
            'incidencia' => $incidencia,
            'prioridad' => $prioridad,
            'realizado' => $realizado
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

            if (intval(substr($folioAnterior, 0, 2)) !== intval(date('y'))) {
                $secuencial = 0;
            } else {
                $secuencial = intval(substr($folioAnterior, 5, 9));
            }

            $secuencialNuevo = str_pad($secuencial + 1, 4, '0', STR_PAD_LEFT);
            $reporte->id_employee_sup = 6;

            $year = date('y');
            $mes = date('m');
            $nuevoFolio = $year . $mes . "-" . $secuencialNuevo;
            $reporte->id = $nuevoFolio;

            $resultado = $reporte->crearReporte($reporte->id);

            if ($resultado) {
                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El reporte ha sido creado correctamente con el folio {$reporte->id}",
                    'folio' => $reporte->id,
                    'prioridad' => $reporte->id_priority,
                    'fecha' => $reporte->created,
                    'idUser' => $reporte->id_user
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
                $mat = Materiales::where('id', $material->id_material);
                $und = Unidades::where('id', $material->id_unity);

                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El material ha sido registrado correctamente",
                    'material' => $mat->name,
                    'unidad' => $und->name,
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
                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El reporte {$folio} ha sido actualizado correctamente",
                    'folio' => $folio,
                    'prioridad' => $reporte->id_priority,
                    'fecha' => $reporte->created,
                    'idUser' => $reporte->id_user
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

    public static function reportesAPI()
    {
        isAuth();

        $reportes = ReportesAPI::obtenerReportes();
        echo json_encode($reportes);
    }

    public static function notasAPI()
    {
        isAuth();

        $notas = Notas::belongsTo('id_report', s($_POST['id_report']));

        echo json_encode($notas);
    }

    public static function materialesAPI()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folio = s($_POST['id_report']);
            $materiales = MaterialRepAPI::obtenerMateriales($folio);
        }

        echo json_encode($materiales);
    }
}
