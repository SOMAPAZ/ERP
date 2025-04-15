<?php


namespace Controllers;

use MVC\Router;
use Usuarios\Zona;
use Usuarios\Colonia;
use Usuarios\Usuario;
use Usuarios\TipoToma;
use Classes\Paginacion;
use Usuarios\Localidad;
use Usuarios\AltaUsuario;
use Usuarios\TipoConsumo;
use Usuarios\TipoPersona;
use Usuarios\TipoUsuario;
use Usuarios\TipoServicio;
use Usuarios\EstadoServicio;
use Usuarios\TipoAlmacenamiento;

class UpdatesController
{
    private static $links = ['datos-usuarios', 'datos-tarifas', 'datos-generales'];

    public static function index(Router $router)
    {
        isAuth();

        if (
            $_SESSION['empleado_rol'] === "1" ||
            $_SESSION['empleado_rol'] === "3" ||
            $_SESSION['empleado_rol'] === "2"
        ) {
            $pagina_actual = $_GET['page'];
            $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

            if (!$pagina_actual || $pagina_actual < 1) {
                header('Location: /datos-usuarios?page=1');
            }

            $por_pagina = 100;
            $total = Usuario::total();
            $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

            $usuarios = Usuario::paginar($por_pagina, $paginacion->offset(), 'ASC');

            $router->render('updates/index', [
                'links' => self::$links,
                'usuarios' => $usuarios,
                'paginacion' => $paginacion->paginacion()
            ]);

            return;
        }

        header('Location: /welcome');
    }

    public static function crearUsuario(Router $router)
    {
        isAuth();

        $alertas = [];

        $colonias = Colonia::all();
        $localidades = Localidad::all();
        $zonas = Zona::all();
        $tipo_usuario = TipoUsuario::all();
        $tipo_toma = TipoToma::all();
        $tipo_servicio = TipoServicio::all();
        $estado_servicio = EstadoServicio::all();
        $tipo_consumo = TipoConsumo::all();
        $tipo_almacenamiento = TipoAlmacenamiento::all();
        $tipo_persona = TipoPersona::all();

        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            if ($usuario->id_locality === '') $usuario->id_locality = 1;
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $resultado = $usuario->guardar();

                if ($resultado) {
                    $nuevo_usuario = Usuario::whereArray([
                        'user' => $usuario->user,
                        'lastname' => $usuario->lastname,
                        'address' => $usuario->address,
                    ]);

                    $nuevo_usuario = array_shift($nuevo_usuario);
                    $alta_pdf = new AltaUsuario();
                    $alta_pdf->id_user = $nuevo_usuario->id;
                    $alta_pdf->fecha = date('Y-m-d');

                    $folio_ant = AltaUsuario::obtenerFolio()->folio;
                    $secuenciaFolioAnt = substr($folio_ant, 12, 15);
                    $nuevo_secuencia = (int) $secuenciaFolioAnt + 1;
                    $add_zero = str_pad($nuevo_secuencia, 4, '0', STR_PAD_LEFT);
                    $nuevo_folio = "SOMA" . date('Y') . "-DG-" . $add_zero;

                    $alta_pdf->folio = $nuevo_folio;

                    $resultado = $alta_pdf->guardar();

                    header("Location: buscar-usuario?id=" . $nuevo_usuario->id);
                    // header("Location: /pdf/contrato-servicio?folio=$nuevo_folio");
                }
            }
        }

        $router->render('updates/crear-usuario', [
            'links' => self::$links,
            'colonias' => $colonias,
            'localidades' => $localidades,
            'zonas' => $zonas,
            'tipo_usuario' => $tipo_usuario,
            'tipo_toma' => $tipo_toma,
            'tipo_servicio' => $tipo_servicio,
            'estado_servicio' => $estado_servicio,
            'tipo_consumo' => $tipo_consumo,
            'tipo_almacenamiento' => $tipo_almacenamiento,
            'tipo_persona' => $tipo_persona,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function editarUsuario(Router $router)
    {
        isAuth();

        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $usuario = Usuario::find($id);

        $colonias = Colonia::all();
        $localidades = Localidad::all();
        $zonas = Zona::all();
        $tipo_usuario = TipoUsuario::all();
        $tipo_toma = TipoToma::all();
        $tipo_servicio = TipoServicio::all();
        $estado_servicio = EstadoServicio::all();
        $tipo_consumo = TipoConsumo::all();
        $tipo_almacenamiento = TipoAlmacenamiento::all();
        $tipo_persona = TipoPersona::all();

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $usuario->sincronizar($_POST);
        //     if ($usuario->id_locality === '') $usuario->id_locality = 1;
        //     $alertas = $usuario->validar();

        //     if (empty($alertas)) {
        //         $usuario->guardar();
        //         header('Location: /datos-usuarios');
        //     }
        // }

        $router->render('updates/editar-usuario', [
            'links' => self::$links,
            'colonias' => $colonias,
            'localidades' => $localidades,
            'zonas' => $zonas,
            'tipo_usuario' => $tipo_usuario,
            'tipo_toma' => $tipo_toma,
            'tipo_servicio' => $tipo_servicio,
            'estado_servicio' => $estado_servicio,
            'tipo_consumo' => $tipo_consumo,
            'tipo_almacenamiento' => $tipo_almacenamiento,
            'tipo_persona' => $tipo_persona,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function eliminarUsuario()
    {
        isAuth();

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /datos-usuarios');
            return;
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /datos-usuarios');
            return;
        }

        $usuario->eliminar();

        header('Location: /datos-usuarios');
    }
}
