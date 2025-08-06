<?php

namespace Controllers;

use Facturacion\Cuentas;
use Usuarios\Colonia;
use Reportes\Unidades;
use Reportes\Categoria;
use Reportes\Prioridad;
use Reportes\Materiales;
use Reportes\Incidencias;
use Usuarios\Zona;
use Usuarios\TipoToma;
use APIs\BeneficiarioApi;
use Usuarios\TipoConsumo;
use APIs\ObservacionesApi;
use Notificaciones\Lecturas;
use Notificaciones\Notificacion;
use Notificaciones\TipoNotificacion;
use APIs\UsuariosAPI;
use Notificaciones\Medidores;


class GenericasController
{
    public static function categorias()
    {
        isAuth();

        $categorias = Categoria::all();
        echo json_encode($categorias);
    }

    public static function incidenciasCat()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_category = s($_POST['args']);
            $existe = Categoria::where('id', $id_category);

            if (!$existe) {
                $respuesta = [
                    'tipo' => 'error',
                    'datos' => 'No existe esa categoría'
                ];

                echo json_encode($respuesta);
                return;
            }

            $incidencias = Incidencias::belongsTo('id_category', $id_category);

            $respuesta = [
                'tipo' => 'exito',
                'datos' => $incidencias
            ];

            echo json_encode($respuesta);
        } else {
            $incidenciasAll = Incidencias::all();
            echo json_encode($incidenciasAll);
        }
    }

    public static function prioridadesRep()
    {
        isAuth();

        $prioridades = Prioridad::all();
        echo json_encode($prioridades);
    }

    public static function materialesRep()
    {
        isAuth();

        $materiales = Materiales::all();
        echo json_encode($materiales);
    }

    public static function unidadesRep()
    {
        isAuth();

        $unidades = Unidades::all();
        echo json_encode($unidades);
    }

    public static function colonias()
    {
        isAuth();

        $colonias = Colonia::all();
        echo json_encode($colonias);
    }
    public static function zonas()
    {
        isAuth();

        $zonas = Zona::all();
        echo json_encode($zonas);
    }
    public static function cuentasAdicionales()
    {
        isAuth();

        $cuentas = Cuentas::all();

        echo json_encode($cuentas);
    }
    
      public static function tipotoma()
    {
        isAuth();
        $tipotoma = Tipotoma::all();
        echo json_encode($tipotoma);
    }
    public static function tipoconsumo()
    {
        isAuth();
        $tipoconsumo = Tipoconsumo::all();
        echo json_encode($tipoconsumo);
    }

   public static function notificaciones()
    {
        isAuth();

        $notificaciones = Notificacion::all();

        foreach ($notificaciones as &$notificacion) {

            $usuario = self::obtenerUsuario($notificacion->id_user);

            if ($usuario) {
                $notificacion->zona = $usuario->zona ? $usuario->zona : 'Desconocida';
                $notificacion->colonia = $usuario->colonia ? $usuario->colonia : 'Desconocida';

                $notificacion->user = $usuario->nombre;
                $notificacion->address = $usuario->direccion;
                $notificacion->id_observaciones = $usuario->id_observaciones;
            } else {
                $notificacion->zona = 'Desconocida';
                $notificacion->colonia = 'Desconocida';
                $notificacion->user = 'Desconocido';
                $notificacion->address = 'Desconocido';
                $notificacion->id_observaciones = 'Desconocido';
            }
            $notificacion->id_employment = $notificacion->id_employment;


            $notificacion->status_name = Notificacion::obtenerNombreStatus($notificacion->id_status);
            $notificacion->tipo_notificacion_name = Notificacion::obtenerTipoNotificacion($notificacion->id_tiponotificacion);
        }

        echo json_encode($notificaciones);
    }

    public static function obtenerUsuario($id_user)
    {
        $usuarioApi = new UsuariosAPI();

        $resultado = $usuarioApi->consultar($id_user);

        if (isset($resultado[0])) {
            return $resultado[0];
        }

        return null;
    }

    public static function observaciones()
    {
        isAuth();
        $observaciones = ObservacionesApi::all();
        echo json_encode($observaciones);
    }

    public static function medidos()
    {
        isAuth();

        $medidos = Lecturas::all();

        foreach ($medidos as $medido) {
            $usuario = self::obtenerUsuario($medido->id_user);

            if ($usuario) {
                $medido->zona = $usuario->zona ? $usuario->zona : 'Desconocida';
                $medido->colonia = $usuario->colonia ? $usuario->colonia : 'Desconocida';

                $medido->user = $usuario->nombre;
                $medido->address = $usuario->direccion;
                $medido->id_observaciones = $usuario->id_observaciones;
            } else {
                $medido->zona = 'Desconocida';
                $medido->colonia = 'Desconocida';
                $medido->user = 'Desconocido';
                $medido->address = 'Desconocido';
                $medido->id_observaciones = 'Desconocido';
            }
            $medido->id_employment = $medido->id_employment;

            $medido->status_name = Lecturas::obtenerNombreStatus($medido->id_status);
        }

        echo json_encode($medidos);
    }

    public static function beneficiario()
    {
        isAuth();
        $beneficiario = BeneficiarioApi::all();
        echo json_encode($beneficiario);
    }

    public static function tipo_notificacion()
    {
        isAuth();
        $tipo_notificacion = TipoNotificacion::all();
        echo json_encode($tipo_notificacion);
    }
     public static function medidoresapi()
    {
        isAuth();
        $medidores = Medidores::all();
        echo json_encode($medidores);
    }

}
