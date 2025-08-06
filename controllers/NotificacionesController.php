<?php

namespace Controllers;

use Error;
use MVC\Router;
use Model\Registros;
use Usuarios\Usuario;
use Classes\Paginacion;
use Empleados\Empleado;
use Convenios\Convenios;
use Notificaciones\Fac_pen;
use Notificaciones\Lecturas;
use Notificaciones\Medidores;
use Notificaciones\Notificacion;
use Notificaciones\TipoNotificacion;
use Notificaciones\Historial_lecturas;
use Reportes\Reporte;

class NotificacionesController
{

    private static $links = ['notificaciones', 'lecturas', 'agenda'];

  public static function index(Router $router)
    {
        isAuth();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT) ?: 1;

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /notificaciones?page=1');
            exit;
        }
        $total_pagina = 100;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['filtros'] = self::obtenerFiltrados();
        }

        $texto = $_SESSION['filtros'] ?? '';

        $columna = $_GET['columna'] ?? 'id';
        $orden = $_GET['orden'] ?? 'asc';

        $total = Fac_pen::total($texto);
        $paginacion = new Paginacion($pagina_actual, $total_pagina, $total);

        $usuarios = Fac_pen::obtenerUsuariosPaginados(
            $total_pagina,
            $paginacion->offset(),
            $texto,
            $columna,
            $orden
        );
        $usuariosConReporte = Reporte::obtenerUsuariosConReporteNotificacion();



        $usuariosFiltrados = array_filter($usuarios, function ($usuario) {
            return !Notificacion::NotRegistrada($usuario->id);
        });

        $totalFiltrado = Fac_pen::total($texto);

        $textoLectura = $_SESSION['filtros'] ?? '';
        $filtrosAplicados = [];
        if ($textoLectura) {
            parse_str($textoLectura, $filtrosAplicados);
        }
        $router->render('notificaciones/index', [
            'links' => self::$links,
            'usuarios' => $usuariosFiltrados,
            'paginacion' => $paginacion->paginacion(),
            'columna' => $columna,
            'orden' => $orden,
            'totalFiltrado' => $totalFiltrado,
            'filtrosAplicados' => $filtrosAplicados,
            'usuariosConReporte' => $usuariosConReporte,
        ]);
    }
    public static function lecturas(Router $router)
    {
        isAuth();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT) ?: 1;

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /notificaciones/lecturas?page=1');
            exit;
        }

        $total_pagina = 200;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['filtros_lecturas'] = self::obtenerFiltradosLec();
        }

        $texto = $_SESSION['filtros_lecturas'] ?? '';


        $total = Fac_pen::totallec($texto);
        $paginacion = new Paginacion($pagina_actual, $total_pagina, $total);
        $usuarios = Fac_pen::ObtenerUsuariosPaginadosLec($total_pagina, $paginacion->offset(), $texto);

        $usuariosFiltrados = array_filter($usuarios, function ($usuario) {
            return !Lecturas::LecRegistrada($usuario->id);
        });
        $totalFiltrado = Fac_pen::totallec($texto);

        $filtrosAplicados = [];
        if ($texto) {
            parse_str($texto, $filtrosAplicados);
        }

        $router->render('notificaciones/lecturas', [
            'links' => self::$links,
            'usuarios' => $usuariosFiltrados,
            'paginacion' => $paginacion->paginacion(),
            'totalFiltrado' => $totalFiltrado,
            'filtrosAplicados' => $filtrosAplicados,
        ]);
    }
    public static function agenda(Router $router)
    {
        isAuth();
        $router->render('notificaciones/agendaNot', [
            'links' => self::$links,
        ]);
    }
    public static function agendalec(Router $router)
    {
        isAuth();
        $router->render('notificaciones/agendaLec', [
            'links' => self::$links,
        ]);
    }
    public static function formularioagenda(Router $router)
    {
        isAuth();
        $router->render('notificaciones/formNot', [
            'links' => self::$links,

        ]);
    }
    public static function formularioagendalec(Router $router)
    {
        isAuth();
        $router->render('notificaciones/formLec', [
            'links' => self::$links,
        ]);
    }
    public static function constultanot(Router $router)
    {
        isAuth();

        $router->render('notificaciones/consultanot', [
            'links' => self::$links,
        ]);
    }
    public static function consultalec(Router $router)
    {
        isAuth();

        $router->render('notificaciones/consultalec', [
            'links' => self::$links,
        ]);
    }
    public static function obtenerFiltrados()
    {
        $requestData = $_POST['filtros'] ?? null;

        $filtrosSeleccionados = [];

        if ($requestData) {
            $requestData = json_decode($requestData, true);

            if (!empty($requestData['zonas'])) {
                $filtrosSeleccionados['z.id'] = array_map('intval', $requestData['zonas']);
            }

            if (!empty($requestData['colonias'])) {
                $filtrosSeleccionados['c.id'] = array_map('intval', $requestData['colonias']);
            }

            if (!empty($requestData['tipoToma'])) {
                $filtrosSeleccionados['tt.id'] = array_map('intval', $requestData['tipoToma']);
            }

            if (!empty($requestData['tipoConsumo'])) {
                $filtrosSeleccionados['tc.id'] = array_map('intval', $requestData['tipoConsumo']);
            }
        }

        $texto = "";

        foreach ($filtrosSeleccionados as $key => $filtros) {
            $texto .= "(";
            foreach ($filtros as $key2 => $filtro) {
                $texto .= $key . " = " . $filtro;
                if ($key2 !== array_key_last($filtros)) {
                    $texto .= " OR ";
                }
            }
            $texto .= ") AND ";
        }
        $texto = rtrim($texto, " AND ");

        return $texto;
    }
    public static function obtenerFiltradosLec()
    {

        $requestData = $_POST['filtros_lecturas'] ?? null;
        $filtrosSeleccionados = [];

        if ($requestData) {
            $requestData = json_decode($requestData, true);

            if (!empty($requestData['zonas'])) {
                $filtrosSeleccionados['z.id'] = array_map('intval', $requestData['zonas']);
            }

            if (!empty($requestData['colonias'])) {
                $filtrosSeleccionados['c.id'] = array_map('intval', $requestData['colonias']);
            }
        }

        $texto = "";

        foreach ($filtrosSeleccionados as $key => $filtros) {
            $texto .= "(";
            foreach ($filtros as $key2 => $filtro) {
                $texto .= $key . " = " . $filtro;
                if ($key2 !== array_key_last($filtros)) {
                    $texto .= " OR ";
                }
            }
            $texto .= ") AND ";
        }
        $texto = rtrim($texto, " AND ");
        return $texto;
    }
    public static function guardarNotificacion()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
                exit;
            }
            $rawData = file_get_contents('php://input');
            $datos = json_decode($rawData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['success' => false, 'message' => 'Error al decodificar JSON: ' . json_last_error_msg()]);
                exit;
            }
            if (!is_array($datos)) {
                echo json_encode(['success' => false, 'message' => 'El formato de datos debe ser un array']);
                exit;
            }

            $ultimoFolio = Notificacion::obtenerUltimoFolio();
            $ultimoFolioNumerico = $ultimoFolio + 1;

            $ano = date('Y');
            $mes = date('m');

            $notificacionesGuardadas = [];
            $empleadoId = isset($_SESSION['empleado_id']) ? $_SESSION['empleado_id'] : null;

            if (!$empleadoId) {
                echo json_encode(['success' => false, 'message' => 'Empleado no autenticado']);
                exit;
            }

            foreach ($datos as $notificacion => $item) {
                $notificacion = new Notificacion();
                $notificacion->id_user = $item['id'];
                $notificacion->meses_rezagados = $item['meses_rezagados'];
                $notificacion->total = (float) str_replace(',', '', $item['monto']);
                $notificacion->id_status = isset($item['id_status']) ? $item['id_status'] : '1';
                $notificacion->id_tiponotificacion = isset($item['id_tiponotificacion']) ? $item['id_tiponotificacion'] : '0';
                date_default_timezone_set('America/Mexico_City');
                $notificacion->fecha_guardada = date('Y-m-d H:i:s');
                $notificacion->costo = "0.00";

                $notificacion->id_employment = $empleadoId;

                $nuevoFolio = 'NOT/' . $ano . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-' . str_pad($ultimoFolioNumerico, 4, '0', STR_PAD_LEFT);
                $notificacion->idx = $nuevoFolio;

                $resultado = $notificacion->crear();

                if ($resultado) {
                    $notificacionesGuardadas[] = $notificacion;
                }

                $ultimoFolioNumerico++;
            }

            echo json_encode([
                'success' => true,
                'message' => 'Notificaciones guardadas correctamente',
                'notificaciones' => $notificacionesGuardadas
            ]);
            exit;
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar las notificaciones: ' . $e->getMessage()
            ]);
            exit;
        }
    }
    public static function eliminarNotificacion()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id_user'] ?? null;
            if ($id) {
                $notificacion = new Notificacion();
                $notificacion->id_user = $id;

                if ($notificacion->eliminar()) {
                    echo json_encode(['status' => 'success', 'message' => 'Notificación eliminada']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
            }
        } catch (error) {
        }
    }
    public static function guardarReporteNotificacion()
    {
        try {
            isAuth();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $reporte = new Notificacion($_POST);

                date_default_timezone_set('America/Mexico_City');
                $reporte->fecha_reporte = date('Y-m-d H:i:s');
                $reporte->id_status = "4";
                $reporte->costo = 18.21 * 1.16;

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                    $archivo = $_FILES['imagen'];
                    $nombreArchivo = $archivo['name'];
                    $rutaTemporal = $archivo['tmp_name'];
                    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

                    $nombreImagen = $nombreArchivo;
                    $rutaDestino = 'images/' . $nombreImagen;

                    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                        $reporte->evidencias = $nombreImagen;
                    } else {
                        throw new \Exception('Error al mover el archivo');
                    }
                } else {
                    $reporte->evidencias = NULL;
                }
                if (isset($_POST['idx']) && !empty($_POST['idx'])) {
                    preg_match('/NOT\/\d{4}-\d{2}-(\d{4})$/', $_POST['idx'], $matches);
                    if (isset($matches[1])) {
                        $reporte->idx = $matches[1];
                        $reporte->actualizar();
                    } else {
                        throw new \Exception('Formato de idx inválido');
                    }
                } else {
                    throw new \Exception('El ID de la notificación es necesario para la actualización');
                }
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Notificación guardada correctamente',
                ];
                echo json_encode($respuesta);
            }
        } catch (\Exception $error) {
            $respuesta = [
                'tipo' => 'Error',
                'mensaje' => $error->getMessage(),
            ];
            echo json_encode($respuesta);
        }
    }
    public static function guardarLectura()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
                exit;
            }

            $rawData = file_get_contents('php://input');
            $datos = json_decode($rawData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['success' => false, 'message' => 'Error al decodificar JSON: ' . json_last_error_msg()]);
                exit;
            }

            if (!is_array($datos)) {
                echo json_encode(['success' => false, 'message' => 'El formato de datos debe ser un array']);
                exit;
            }
            $lecturasGuardadas = [];
            $empleadoId = isset($_SESSION['empleado_id']) ? $_SESSION['empleado_id'] : null;

            if (!$empleadoId) {
                echo json_encode(['success' => false, 'message' => 'Empleado no autenticado']);
                exit;
            }


            foreach ($datos as $item) {

                $lectura = new Lecturas();
                $lectura->id_user = $item['id'];

                date_default_timezone_set('America/Mexico_City');
                $lectura->fecha_guardada = date('Y-m-d H:i:s');
                $lectura->id_status = isset($item['id_status']) ? $item['id_status'] : '1';
                $lectura->id_employment = $empleadoId;

                $medidores = Medidores::finds($lectura->id_user);
                if (!$medidores) continue;

                $medidoractual = Historial_lecturas::findAlls($lectura->id_user);
                if (empty($medidoractual)) {
                    $lectura->id_medidor = $medidores->id;
                    $lectura->crear();
                    continue;
                }

                $anteriordat = $medidoractual[0]->numero_anterior;
                $nuevodat = $medidoractual[0]->numero_nuevo;

                if ($anteriordat != $nuevodat) {
                    $existe = Medidores::wheres([
                        'id_user' => $medidores->id_user,
                        'medidor' => $nuevodat
                    ]);

                    if (!$existe) {
                        $med = new Medidores();
                        $med->id_user = $medidores->id_user;
                        $med->medidor = $nuevodat;
                        $med->fecha_instalacion = date('Y-m-d H:i:s');
                        $med->crearm();
                        $lectura->id_medidor = $med->id;
                    } else {
                        $lectura->id_medidor = $existe->id;
                    }

                    $resultado = $lectura->crear();
                }

                if ($resultado) {
                    $lecturasGuardadas[] = $lectura;
                }
            }



            echo json_encode([
                'success' => true,
                'message' => 'Lecturas guardadas correctamente',
                'lecturas' => $lecturasGuardadas
            ]);
            exit;
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar las lecturas: ' . $e->getMessage()
            ]);
            exit;
        }
    }
    public static function eliminarNotificacionLectura()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id_user'] ?? null;
            if ($id) {
                $lectura = new Lecturas();
                $lectura->id_user = $id;

                if ($lectura->eliminarMedido()) {
                    echo json_encode(['status' => 'success', 'message' => 'Lectura eliminada']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
            }
        } catch (error) {
        }
    }
    public static function guardarReporteLectura()
    {
        try {
            isAuth();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $reporte = new Lecturas($_POST);

                date_default_timezone_set('America/Mexico_City');
                $reporte->fecha_reporte = date('Y-m-d H:i:s');
                $reporte->id_status = 4;

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                    $archivo = $_FILES['imagen'];
                    $nombreArchivo = $archivo['name'];
                    $rutaTemporal = $archivo['tmp_name'];
                    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

                    $nombreImagen = $nombreArchivo;
                    $rutaDestino = 'images/' . $nombreImagen;

                    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                        $reporte->evidencias = $nombreImagen;
                    } else {
                        throw new \Exception('Error al mover el archivo');
                    }
                } else {
                    $reporte->evidencias = NULL;
                }



                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $reporte->id = $_POST['id'];
                    $reporte->actualizarMedido();
                } else {
                    throw new \Exception('El ID de la lectura es necesario para la actualización');
                }
                $respuesta = [
                    'tipo' => 'Exito',
                    'mensaje' => 'Lectura guardada correctamente',
                ];
                echo json_encode($respuesta);
            }
        } catch (\Exception $error) {
            $respuesta = [
                'tipo' => 'Error',
                'mensaje' => $error->getMessage(),
            ];
            echo json_encode($respuesta);
        }
    }
    public static function actualizarLectura()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $id_user = $data['id_user'];
        $year = $data['year'];
        $mes = $data['mes'];
        $lectura = $data['lectura'];

        $resultado = Lecturas::actualizarLectura($id_user, $year, $mes, $lectura);

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'message' => 'Lectura actualizada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'La lectura no debe ser mayor a la del mes siguiente '
            ]);
        }

        exit;
    }
    public static function formatearRangoFechas($fechaInicio, $fechaFin)
    {
        $meses = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE'
        ];

        $mesInicio = (int)date('n', strtotime($fechaInicio));
        $anioInicio = date('Y', strtotime($fechaInicio));

        $mesFin = (int)date('n', strtotime($fechaFin));
        $anioFin = date('Y', strtotime($fechaFin));

        return $meses[$mesInicio] . " $anioInicio A " . $meses[$mesFin] . " $anioFin";
    }
    public static function obtenerFechaEnEspañol()
    {
        date_default_timezone_set('America/Mexico_City');

        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        $fecha = date('d F Y');
        return strtr($fecha, $meses);
    }
    public static function obtenerMesesConLectura()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['idUser']) && isset($data['año'])) {
            $idUser = $data['idUser'];
            $año = $data['año'];

            $result = Lecturas::obtenerMesesConLectura($idUser, $año);

            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'No se encontraron lecturas para el año y usuario especificado.']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros (idUser o año).']);
        }
    }
     public static function guardarExtraNotificacion()
    {
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            exit;
        }
        $id_tiponotificacion = $_POST['idx'] ?? null;
        $empleadoId = isset($_SESSION['empleado_id']) ? $_SESSION['empleado_id'] : null;
        try {

            $registro = new Registros();
            $registro->accion = 1;
            $registro->empleado_id = $empleadoId;
            $registro->folio_seccion = $id_tiponotificacion;
            date_default_timezone_set('America/Mexico_City');
            $registro->created_at = date('Y-m-d H:i:s');
            $registro->comentario = "Notificación Creada";


            $registro = $registro->guardarRegistro(uuid());

        } catch (\Exception $error) {
            $respuesta = [
                'tipo' => 'Error',
                'mensaje' => $error->getMessage(),
            ];
            echo json_encode($respuesta);
        }
    }

    public static function notificaciones()
    {
        isAuth();

        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['idx']);

        if (!$id) {
            $res = [
                'tipo' => 'Error',
                'msg' => 'Es requerido el id'
            ];

            echo json_encode($res);
            return;
        }

        $notificacion = Notificacion::finds($id);
        if (!$notificacion) {
            echo json_encode($res = [
                'tipo' => 'Error',
                'msg' => 'El notificacion no existe'
            ]);
            return;
        }


        echo json_encode($notificacion);
    }
   public static function consultarMedidos()
    {
        isAuth();

        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id_user']);

        if (!$id) {
            $res = [
                'tipo' => 'Error',
                'msg' => 'Es requerido el id'
            ];

            echo json_encode($res);
            return;
        }

        $mes = $_GET['mes'] ?? null;
        $year = $_GET['year'] ?? null;
        $lecturas = Lecturas::finds($id, $mes, $year);
        if (!$lecturas) {
            echo json_encode($res = [
                'tipo' => 'Error',
                'msg' => 'El lecturas no existe'
            ]);
            return;
        }


        echo json_encode($lecturas);
    }
}
