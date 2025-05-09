<?php

namespace Controllers;

use MVC\Router;
use Reportes\Notas;
use Model\Registros;
use Reportes\Estado;
use Reportes\Reporte;
use Reportes\Material;
use Reportes\Unidades;
use Empleados\Empleado;
use Reportes\Categoria;
use Reportes\Prioridad;
use Reportes\Comentarios;
use Reportes\Incidencias;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Reportes
{
    public function consultarReportes($estado = 1, $url = 'abiertos')
    {
        date_default_timezone_set('America/Mexico_City');

        $mes = $_GET['m'];
        $year = $_GET['y'];
        $mes = filter_var($mes, FILTER_VALIDATE_INT);
        $year = filter_var($year, FILTER_VALIDATE_INT);

        if (!$mes) {
            $mes = (int) date('m');
            header("Location: /reportes-" . $url . "?y=" . $year . "&m=" . $mes);
            return;
        }

        if (!$year) {
            $year = date('Y');
            header("Location: /reportes-" . $url . "?y=" . $year . "&m=" . $mes);
            return;
        }

        $reportes = Reporte::whereArray([
            'id_status' => $estado,
            'YEAR(created)' => $year,
            'MONTH(created)' => $mes
        ]);

        foreach ($reportes as $reporte) {
            $reporte->prioridad = Prioridad::find($reporte->id_priority);
            $reporte->categoria = Categoria::find($reporte->id_category);
            $reporte->incidencia = Incidencias::find($reporte->id_incidence);
        }

        return [
            'reportes' => $reportes,
            'mes' => (string) $mes,
            'year' => (string) $year
        ];
    }
}


class ReportesController
{
    private static function renderReporte(Router $router, string $titulo, ?int $estado = null, ?string $tipo = null)
    {
        isAuth();

        $instancia = new Reportes();
        $reportes = $instancia->consultarReportes($estado, $tipo);
        $categorias = Categoria::all();
        $incidencias = Incidencias::all();
        foreach ($incidencias as $incidencia) {
            $incidencia->incidencia = Categoria::find($incidencia->id_category)->name . " - " . $incidencia->name;
        }

        $router->render('reports/reportes', [
            'titulo' => $titulo,
            'reportes' => $reportes['reportes'],
            'mes' => (string) $reportes['mes'],
            'year' => (string) $reportes['year'],
            'categorias' => $categorias,
            'incidencias' => $incidencias
        ]);
    }

    public static function reportesAbiertos(Router $router)
    {
        self::renderReporte($router, 'Reportes Abiertos', 1, 'abiertos');
    }

    public static function reportesProceso(Router $router)
    {
        self::renderReporte($router, 'Reportes en Proceso', 2, 'proceso');
    }

    public static function reportesCerrados(Router $router)
    {
        self::renderReporte($router, 'Reportes Cerrados', 3, 'cerrados');
    }

    public static function reportesTerminados(Router $router)
    {
        self::renderReporte($router, 'Reportes Terminados', 4, 'terminados');
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
        $registros = Registros::belongsTo('folio_seccion', $reporte->id);
        $comentarios = Comentarios::belongsTo('reporte_id', $reporte->id);
        $notas = Notas::belongsTo('id_report', $reporte->id);
        $materiales = Material::belongsTo('id_report', $reporte->id);

        foreach ($comentarios as $comentario) {
            $comentario->empleado = Empleado::find($comentario->id_empleado);
        }

        foreach ($notas as $nota) {
            $nota->empleado = Empleado::find($nota->employee_id);
        }

        foreach ($materiales as $material) {
            $material->unity = Unidades::find($material->id_unity);
            $material->empleado = Empleado::find($material->id_employee);
        }

        $is_completed = count($notas) > 0 && count($materiales) > 0;

        $router->render('reports/reporte', [
            'reporte' => $reporte,
            'categoria' => $categoria,
            'incidencia' => $incidencia,
            'prioridad' => $prioridad,
            'realizado' => $realizado,
            'registros' => $registros,
            'comentarios' => $comentarios,
            'notas' => $notas,
            'materiales' => $materiales,
            'is_completed' => $is_completed,
        ]);
    }

    public static function reporteAPI()
    {
        isAuth();


        if (!isset($_GET['folio'])) {
            echo json_encode([
                'tipo' => 'Error',
                'mensaje' => 'No se ha especificado el folio del reporte'
            ]);
            return;
        }

        $folioRep = s($_GET['folio']);
        $reporte = Reporte::where('id', $folioRep);

        if (!$reporte) {
            echo json_encode([
                'tipo' => 'Error',
                'mensaje' => 'El reporte no existe'
            ]);
            return;
        }

        $reporte->categoria = Categoria::find($reporte->id_category)->name;
        $reporte->incidencia = Incidencias::find($reporte->id_incidence)->name;
        $reporte->prioridad = Prioridad::find($reporte->id_priority)->name;
        $reporte->created_by = Empleado::find($reporte->employee_id)->name;
        $reporte->estado = Estado::find($reporte->id_status)->name;
        $reporte->fechaFormateada = formatearFechaESLong($reporte->created);

        echo json_encode($reporte);
    }

    public static function generarReporte(Router $router)
    {
        isAuth();

        date_default_timezone_set('America/Mexico_City');

        $reporte = new Reporte();
        $alertas = [];

        $categorias = Categoria::all();
        $prioridades = Prioridad::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reporte->sincronizar($_POST);
            $alertas = $reporte->validar();

            if (empty($alertas)) {
                if ($reporte->id_user === "") $reporte->id_user = 0;

                $reporte->employee_id = $_SESSION['empleado_id'];
                $reporte->id_status = 1;
                $reporte->created = date('Y-m-d H:i:s');

                $anterior = Reporte::obtenerUltimoFolio();
                $folioAnterior = $anterior->id ?? 0;
                if (intval(substr($folioAnterior, 0, 2)) !== intval(date('y')) || intval(substr($folioAnterior, 2, 2)) !== intval(date('m'))) {
                    $secuencial = 0;
                } else {
                    $secuencial = intval(substr($folioAnterior, 5, 9));
                }

                $nuevoFolio = date('y') . date('m') . "-" . str_pad($secuencial + 1, 4, '0', STR_PAD_LEFT);
                $reporte->id = $nuevoFolio;

                $reporte->id_employee_sup = s($_SESSION['empleado_id']);

                $resultado = $reporte->crearReporte($reporte->id);

                if ($resultado) {
                    $registro = new Registros();
                    $registro->accion = 1;
                    $registro->empleado_id = s($_SESSION['empleado_id']);
                    $registro->folio_seccion = $reporte->id;
                    $registro->created_at = date('Y-m-d H:i:s');
                    $registro->comentario = "Reporte generado";

                    $registrado = $registro->guardarRegistro(uuid());

                    if ($registrado) header("Location: /reporte?folio=$reporte->id");
                }
            }
        }

        $router->render('reports/generar-reporte', [
            'reporte' => $reporte,
            'alertas' => $alertas,
            'categorias' => $categorias,
            'prioridades' => $prioridades
        ]);
    }

    public static function editarReporte(Router $router)
    {
        isAuth();

        date_default_timezone_set('America/Mexico_City');

        $alertas = [];
        $folioRep = s($_GET['folio']);
        $reporte = Reporte::where('id', $folioRep);

        if (!$reporte) {
            header("Location: /reportes");
            return;
        }

        $categorias = Categoria::all();
        $prioridades = Prioridad::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reporte->sincronizar($_POST);

            $alertas = $reporte->validar();

            if (empty($alertas)) {
                $resultado = $reporte->guardar();

                if ($resultado) {
                    $registro = new Registros();
                    $registro->accion = 2;
                    $registro->empleado_id = s($_SESSION['empleado_id']);
                    $registro->folio_seccion = $reporte->id;
                    $registro->created_at = date('Y-m-d H:i:s');
                    $registro->comentario = "Reporte editado";

                    $registrado = $registro->guardarRegistro(uuid());

                    if ($registrado) header("Location: /reporte?folio=$reporte->id");
                }
            }
        }

        $router->render('reports/editar-reporte', [
            'reporte' => $reporte,
            'categorias' => $categorias,
            'prioridades' => $prioridades,
            'alertas' => $alertas
        ]);
    }

    public static function crearComentario()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = new Comentarios();
            $comentario->sincronizar($_POST);

            $alertas = $comentario->validar();

            if (!empty($alertas)) {
                $_SESSION['alerta'] = $alertas['error']['comentario'];
                header("Location: /reporte?folio=" . $_POST['reporte_id']);
                return;
            }

            if (empty($alertas)) {
                $comentario->id_empleado = $_SESSION['empleado_id'];
                $comentario->created_at = date('Y-m-d H:i:s');
                $resultado = $comentario->guardar();

                if ($resultado) {
                    unset($_SESSION['alerta']);
                    header("Location: /reporte?folio=" . $comentario->reporte_id);
                }
            }
        }
    }

    public static function formNotaReporte(Router $router)
    {
        isAuth();
        date_default_timezone_set('America/Mexico_City');

        $folio = s($_GET['folio']);
        $reporte = Reporte::where('id', $folio);

        if (!$reporte) {
            header("Location: /reportes-abiertos");
            return;
        }

        $router->render('reports/nota-reporte', [
            'reporte' => $reporte,
        ]);
    }

    public static function generarNotaReporte()
    {
        isAuth();
        date_default_timezone_set('America/Mexico_City');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = [];
            $resultado = true;

            foreach ($_FILES['imagenes']['tmp_name'] as $imagen) {

                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $nota = new Notas();
                $nota->id_report = s($_POST['id_report']);
                $nota->note = s($_POST['note']);
                $nota->employee_id = s($_SESSION['empleado_id']);
                $nota->created = date('Y-m-d H:i:s');

                $manager = new ImageManager(Driver::class);
                $image = $manager->read($imagen);
                $image->cover(800, 800);
                $nota->image = $nombreImagen;

                if (!is_dir(CARPETA_IMAGENES_REPORTES)) {
                    mkdir(CARPETA_IMAGENES_REPORTES);
                }

                $image->save(CARPETA_IMAGENES_REPORTES . $nombreImagen);

                $resultado = $nota->guardar();
                !$resultado ? $resultado = false : $resultado = true;
            }

            if ($resultado) {
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Nota  e imagen guardadas correctamente',
                ];
            } else {
                $respuesta = [
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al guardar la nota',
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function generarMaterialReporte(Router $router)
    {
        isAuth();
        date_default_timezone_set('America/Mexico_City');
        $alertas = [];
        $folio = s($_GET['folio']);

        if (!$folio) {
            header("Location: /reportes");
            return;
        }

        $reporte = Reporte::where('id', $folio);

        if (!$reporte) {
            header("Location: /reportes");
            return;
        }

        $unidades = Unidades::all();
        $materiales = Material::belongsTo('id_report', $folio);
        foreach ($materiales as $material) {
            $material->unity = Unidades::find($material->id_unity);
        }

        $material = new Material();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $material->sincronizar($_POST);
            $material->id_employee = s($_SESSION['empleado_id']);
            $material->created = date('Y-m-d H:i:s');

            $alertas = $material->validar();

            if (empty($alertas)) {
                $resultado = $material->guardar();

                if ($resultado) {
                    $alertas['exito']['material'] = 'Material agregado correctamente';
                    $materiales = Material::belongsTo('id_report', $folio);
                    foreach ($materiales as $material) {
                        $material->unity = Unidades::find($material->id_unity);
                    }
                    $material = new Material();
                }
            }
        }

        $router->render('reports/material-reporte', [
            'reporte' => $reporte,
            'alertas' => $alertas,
            'material' => $material,
            'unidades' => $unidades,
            'materiales' => $materiales
        ]);
    }

    public static function cambiarEstado()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            isAuth();
            $folio = s($_POST['folio']);
            $estado = s($_POST['estado']);

            $reporte = Reporte::where('id', $folio);
            if (!$reporte) {
                json_encode([
                    'tipo' => 'Error',
                    'mensaje' => 'El reporte no existe'
                ]);

                return;
            }

            $reporte->id_status = $estado;


            try {
                $resultado = $reporte->guardar();
            } catch (\Throwable $th) {
                $resultado = $th;
            }

            echo json_encode($resultado);
        }
    }

    public static function eliminarReporte()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folio = s($_POST['folio']);
            $reporte = Reporte::where('id', $folio);

            if (!$reporte) {
                echo json_encode([
                    'tipo' => 'Error',
                    'mensaje' => 'El reporte no existe'
                ]);
                return;
            }

            $resultado = $reporte->eliminar();

            if ($resultado) {
                $registro = new Registros();
                $registro->accion = 3;
                $registro->empleado_id = s($_SESSION['empleado_id']);
                $registro->folio_seccion = $reporte->id;
                $registro->created_at = date('Y-m-d H:i:s');
                $registro->comentario = "Reporte eliminado";

                $registro->guardarRegistro(uuid());
                echo json_encode([
                    'tipo' => 'Exito',
                    'mensaje' => 'Reporte eliminado correctamente'
                ]);
            } else {
                echo json_encode([
                    'tipo' => 'Error',
                    'mensaje' => 'Hubo un error al eliminar el reporte'
                ]);
            }
        }
    }
}
