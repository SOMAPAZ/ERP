<?php

namespace Controllers;

use MVC\Router;
use Usuarios\Zona;
use APIs\UsuariosAPI;
use Reportes\Reporte;
use Usuarios\Colonia;
use Usuarios\Usuario;
use Facturacion\Rates;
use Usuarios\TipoToma;
use Classes\Paginacion;
use Reportes\Categoria;
use Usuarios\Localidad;
use Convenios\Convenios;
use Facturacion\Facturas;
use Facturacion\Measured;
use Usuarios\Observaciones;
use Reportes\Incidencias;
use Usuarios\AltaUsuario;
use Usuarios\TipoConsumo;
use Usuarios\TipoPersona;
use Usuarios\TipoUsuario;
use Usuarios\TipoServicio;
use Usuarios\Beneficiarios;
use Facturacion\Facturacion;
use Facturacion\TomaConsumo;
use Usuarios\EstadoServicio;
use Facturacion\FacturasPasadas;
use Notificaciones\Notificacion;
use Usuarios\TipoAlmacenamiento;
use Facturacion\PagosAdicionales;
use Intervention\Image\ImageManager;
use Notificaciones\TipoNotificacion;
use Intervention\Image\Drivers\Gd\Driver;


class UsersController
{
    private static $apartado = 'usuarios';
    private static $links = ['usuarios'];

    public static function index(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /usuarios?page=1');
        }

        $por_pagina = 100;
        $total = Usuario::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $usuarios = Usuario::paginar($por_pagina, $paginacion->offset(), 'ASC');

        foreach ($usuarios as $usuario) {
            $usuario->zona = Zona::find($usuario->id_zone);
        }

        $router->render('users/index', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'usuarios' => $usuarios,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }

    public static function buscarUsuario(Router $router)
    {

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /usuarios');
            return;
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /usuarios');
            return;
        }

        $usuario->zona = Zona::find($usuario->id_zone);
        $usuario->colonia = Colonia::find($usuario->id_colony);
        $usuario->tipo_usuario = TipoUsuario::find($usuario->id_usertype);
        $usuario->tipo_consumo = TipoConsumo::find($usuario->id_consumtype);
        $usuario->tipo_servicio = TipoServicio::find($usuario->id_servicetype);
        $usuario->estado_servicio = EstadoServicio::find($usuario->id_servicestatus);
        $usuario->tipo_toma = TipoToma::find($usuario->id_intaketype);
        $usuario->tipo_almacenamiento = TipoAlmacenamiento::find($usuario->id_userStorage);

        $beneficiarios = Beneficiarios::belongsTo('id_user', $id);

        $reportes = Reporte::belongsTo('id_user', $id);

        foreach ($reportes as $reporte) {
            $reporte->categoria = Categoria::find($reporte->id_category);
            $reporte->incidencia = Incidencias::find($reporte->id_incidence);
        }

        $notificaciones = Notificacion::belongsTo('id_user', $id);
        foreach ($notificaciones as $notificacion) {
            $notificacion->tipo = TipoNotificacion::find($notificacion->id_tiponotificacion);
        }

        $recibos_anterior = FacturasPasadas::belongsTo('id_user', $id, 'ASC');
        $recibos_actuales = Facturas::belongsTo('id_user', $id, 'ASC');
        $recibos_pagos_adicionales = PagosAdicionales::belongsTo('id_user', $id, 'ASC');

        $convenios = Convenios::belongsTo('id_user', $id);
        foreach ($convenios as $convenio) {
            if ($convenio->id_beneficiario) {
                $convenio->beneficiario = Beneficiarios::find($convenio->id_beneficiario) ?? 'Sin beneficiario';
            }
        }

        $router->render('users/buscar-usuario', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'usuario' => $usuario,
            'beneficiarios' => $beneficiarios,
            'reportes' => $reportes,
            'notificaciones' => $notificaciones,
            'recibos_anterior' => $recibos_anterior,
            'recibos_actuales' => $recibos_actuales,
            'recibos_pagos_adicionales' => $recibos_pagos_adicionales,
            'convenios' => $convenios
        ]);
    }

    public static function usersAPI()
    {
        $users = new UsuariosAPI();
        $resultado = $users->consultar();

        echo json_encode($resultado);
    }

    public static function datosBusqueda()
    {
        isAuth();
        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);

        $usuarios = Usuario::getAllUniques($id);
        echo json_encode($usuarios);
    }

    public static function usuario()
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
        if (!$usuario) {
            echo json_encode($res = [
                'tipo' => 'Error',
                'msg' => 'El usuario no existe'
            ]);
            return;
        }

        $usuario->id_colony = Colonia::find($usuario->id_colony)->name;
        $usuario->id_locality = Localidad::find($usuario->id_locality)->name;
        $usuario->id_zone = Zona::find($usuario->id_zone)->name;
        $usuario->id_usertype = TipoUsuario::find($usuario->id_usertype)->name;
        $usuario->id_intaketype = TipoToma::find($usuario->id_intaketype)->name;
        $usuario->id_servicetype = TipoServicio::find($usuario->id_servicetype)->name;
        $usuario->id_servicestatus = EstadoServicio::find($usuario->id_servicestatus)->name;
        $usuario->id_consumtype = TipoConsumo::find($usuario->id_consumtype)->name;

        echo json_encode($usuario);
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

            if ($_FILES['image']['tmp_name']) {
                $carpeta_imagenes = 'image_house_user/';
                $nombre_imagen = md5(uniqid(rand(), true)) . ".jpg";

                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['image']['tmp_name']);
                $image->cover(800, 800);

                $usuario->image = $nombre_imagen;
                $image->save($carpeta_imagenes . $nombre_imagen);
            }

            $usuario->sincronizar($_POST);

            if ($usuario->id_locality === '') $usuario->id_locality = 1;
            $usuario->token_registro = md5(uniqid(rand(), true));
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $resultado = $usuario->guardar();

                if ($resultado) {
                    $nuevo_usuario = Usuario::where('token_registro', $usuario->token_registro);

                    $nuevo_usuario = $nuevo_usuario;
                    $alta_pdf = new AltaUsuario();
                    $alta_pdf->id_user = $nuevo_usuario->id;
                    $alta_pdf->fecha = date('Y-m-d H:i:s');

                    $folio_ant = AltaUsuario::obtenerFolio()->folio;
                    $secuenciaFolioAnt = substr($folio_ant, 12, 15);
                    $nuevo_secuencia = (int) $secuenciaFolioAnt + 1;
                    $add_zero = str_pad($nuevo_secuencia, 4, '0', STR_PAD_LEFT);
                    $nuevo_folio = "SOMA" . date('Y') . "-DG-" . $add_zero;

                    $alta_pdf->folio = $nuevo_folio;

                    $resultado_pdf = $alta_pdf->guardar();

                    if ($resultado_pdf) {
                        $tarifa = 0;
                        $toma_consumo = null;

                        if ($usuario->id_servicetype === "2") {
                            $toma_consumo = TomaConsumo::whereArray([
                                'id_intaketype' => $usuario->id_intaketype,
                                'id_consumtype' => $usuario->id_consumtype
                            ]);

                            $rate = Rates::whereArray([
                                'id_consum_intake' => array_shift($toma_consumo)->id,
                                'year' => date('Y'),
                            ]);

                            $tarifa = (float) array_shift($rate)->amount;
                        }

                        if ($usuario->id_servicetype === "3") {
                            $toma_consumo = TomaConsumo::whereArray([
                                'id_intaketype' => $usuario->id_intaketype,
                                'id_consumtype' => $usuario->id_consumtype
                            ]);

                            $measured = Measured::whereArray([
                                'id_intaketype' => $usuario->id_intaketype,
                                'id_consumtype' => $usuario->id_consumtype,
                                'year' => date('Y'),
                            ]);

                            $tarifa = (float) array_shift($measured)->amount;
                        }

                        $meses_restantes = obtenerMesesRestantes();
                        $agregado = false;
                        foreach ($meses_restantes as $mes) {
                            $facturacion = new Facturacion();
                            $agregado = $facturacion->insertNew($nuevo_usuario->id, date('Y'), $mes, $tarifa);
                        }

                        if ($agregado) {
                            header("Location: buscar-usuario?id=" . $nuevo_usuario->id);
                        }
                    }
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
        $observaciones = Observaciones::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_FILES['image']['tmp_name']) {
                $carpeta_imagenes = 'image_house_user/';

                if ($usuario->image !== "") {
                    unlink($carpeta_imagenes . $usuario->image);
                }

                $nombre_imagen = md5(uniqid(rand(), true)) . ".jpg";

                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['image']['tmp_name']);
                $image->cover(800, 800);

                $usuario->image = $nombre_imagen;
                $image->save($carpeta_imagenes . $nombre_imagen);
            }

            $usuario->sincronizar($_POST);

            if ($usuario->id_locality === '') $usuario->id_locality = 1;
            if ($usuario->storage_height === "") $usuario->storage_height = 0;
            if ($usuario->inhabitants === "") $usuario->inhabitants = 1;

            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header("Location: buscar-usuario?id=" . $id);
                }
            }
        }

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
            'observaciones' => $observaciones,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function eliminarUsuario()
    {

        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            isAuth();

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (!$id) {
                header('Location: /usuarios?page=1');
                return;
            }

            $usuario = Usuario::find($id);

            if (!$usuario) {
                header('Location: /usuarios?page=1');
                return;
            }

            $resultado = $usuario->cancelar();

            if ($resultado) {
                header("Location: /buscar-usuario?id=$id");
            }
        }
    }
}
