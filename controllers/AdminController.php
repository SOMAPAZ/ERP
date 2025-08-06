<?php

namespace Controllers;

use Empleados\Empleado;
use MVC\Router;
use Empleados\Roles;
use APIs\EmployeesAPI;

class AdminController
{
    private static $apartado = 'Administrador';
    private static $links = ['general', 'empleados', 'roles'];

    public static function index(Router $router)
    {
        isAuth();

        $auth = intval($_SESSION['empleado_rol']);

        if ($auth !== 1 && $auth !== 3) {
            header('Location: /welcome');
            return;
        }

        $administrador = Empleado::where('id_rol', 1);
        $empleados = Empleado::all();

        $router->render('admin/admin', [
            'links' => self::$links,
            'apartado' => self::$apartado,
            'administrador' => $administrador,
            'empleados' => $empleados,
        ]);
    }

    //muestra lista de empleados
    public static function employees(Router $router)
    {
        isAuth();

        $router->render('admin/employees', [
            'links' => self::$links,
            'apartado' => self::$apartado
        ]);
    }
    //muestra lista de roles
    public static function roles(Router $router)
    {
        isAuth();

        $auth = intval($_SESSION['empleado_rol']);

        if ($auth !== 1 && $auth !== 3) {
            header('Location: /welcome');
            return;
        }

        $router->render('admin/roles', [
            'links' => self::$links,
            'apartado' => self::$apartado
        ]);
    }
    
    public static function bempleados()
    {
        isAuth();


        $str = $_SERVER["QUERY_STRING"] ?? '';
        !$str ? $id = '' : $id = s($_GET['id']);

        if (!$id === '') {
            $res = [
                'tipo' => 'Error',
                'msg' => 'Es requerido el id'
            ];

            echo json_encode($res);
            return;
        }

        $usuario = Empleado::find($id);
        if (!$usuario) {
            echo json_encode($res = [
                'tipo' => 'Error',
                'msg' => 'El usuario no existe'
            ]);
            return;
        }
        echo json_encode($usuario);
    }


    public static function guardarRol(Router $router)
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nombre = Roles::where('name', $_POST['name']);

                if ($nombre) {
                    $respuesta = [
                        'tipo' => 'Error',
                        'mensaje' => 'Este rol ya existe en la base de datos'
                    ];
                    echo json_encode($respuesta);
                    return;
                }

                $roles = new Roles($_POST);

                $resultado = $roles->guardar();

                if ($resultado) {
                    $nuevo = Roles::where('name', $roles->name);

                    $respuesta = [
                        'tipo' => "Exito",
                        'mensaje' => "El rol ha sido creado correctamente",
                        'rol' => $nuevo,
                    ];
                }

                echo json_encode($respuesta);
            } catch (\Throwable $th) {
                $th = [
                    'tipo' => "Error",
                    'mensaje' => "Hubo un error al registrar los datos"
                ];
                echo json_encode($th);
            }
        }
    }

    public static function actualizarRol(Router $router)
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = s($_POST['id']);
                $rol = Roles::where('id', $id);

                if (!$rol) {
                    $respuesta = [
                        'tipo' => 'error',
                        'mensaje' => 'Hubo un error al actualizar el rol'
                    ];

                    echo json_encode($respuesta);

                    return;
                }

                $rol->sincronizar($_POST);

                $resultado = $rol->guardar();

                if ($resultado) {
                    $actualizado = Roles::where('id', $id);
                    $respuesta = [
                        'tipo' => "Exito",
                        'mensaje' => "Los datos han sido actualizados correctamente",
                        'rol' => $actualizado,
                    ];
                }

                echo json_encode($respuesta);
            } catch (\Throwable $th) {
                $th = [
                    'tipo' => "Error",
                    'mensaje' => "Hubo un error al actualizar el rol"
                ];

                echo json_encode($th);
            }
        }
    }

    public static function eliminarRol(Router $router)
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $rol = Roles::where('id', $id);

            if (!$rol) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al eliminar el rol'
                ];

                echo json_encode($respuesta);

                return;
            }

            $resultado = $rol->eliminar();

            if ($resultado) {
                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El rol ha sido eliminado correctamente",
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function guardarEmpleado()
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $mail = Empleado::where('mail', s($_POST['mail']));
                $telefono = Empleado::where('phone', s($_POST['phone']));

                if ($mail) {
                    $respuesta = [
                        'tipo' => 'Error',
                        'mensaje' => 'Este email ya ha sido registrado'
                    ];
                    echo json_encode($respuesta);
                    return;
                }

                if ($telefono) {
                    $respuesta = [
                        'tipo' => 'Error',
                        'mensaje' => 'Este numero de telefono ya ha sido registrado'
                    ];
                    echo json_encode($respuesta);
                    return;
                }

                $empleado = new Empleado($_POST);
                $empleado->hashPassword();
                $empleado->validado = 1;

                $resultado = $empleado->guardar();

                if ($resultado) {
                    $nuevo = Empleado::where('mail', $empleado->mail);
                    unset($nuevo->password);
                    unset($nuevo->password_confirmation);
                    unset($nuevo->token);
                    unset($nuevo->validado);
                    $rol = Roles::find($empleado->id_rol);

                    $respuesta = [
                        'tipo' => "Exito",
                        'mensaje' => "El empleado ha sido creado correctamente",
                        'usuario' => $nuevo,
                        'rol' => $rol->name
                    ];
                }
                echo json_encode($respuesta);
            } catch (\Throwable $th) {
                $th = [
                    'tipo' => "Error",
                    'mensaje' => "Hubo un error al registrar los datos"
                ];
                echo json_encode($th);
            }
        }
    }

    public static function actualizarEmpleado()
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = s($_POST['id']);
                $empleado = Empleado::where('id', $id);

                if (!$empleado) {
                    $respuesta = [
                        'tipo' => 'error',
                        'mensaje' => 'Hubo un error al actualizar el empleado'
                    ];

                    echo json_encode($respuesta);

                    return;
                }

                $empleado->sincronizar($_POST);

                $resultado = $empleado->guardar();

                $id_rol = Roles::find($empleado->id_rol);
                if ($resultado) {
                    $actualizado = Empleado::where('id', $id);
                    unset($actualizado->password);
                    unset($actualizado->password_confirmation);
                    unset($actualizado->token);
                    unset($actualizado->validado);
                    $respuesta = [
                        'tipo' => "Exito",
                        'mensaje' => "Los datos han sido actualizados correctamente",
                        'usuario' => $actualizado,
                        'rol' => $id_rol->name
                    ];
                }

                echo json_encode($respuesta);
            } catch (\Throwable $th) {
                $th = [
                    'tipo' => "Error",
                    'mensaje' => "Hubo un error al actualizar el empleado"
                ];

                echo json_encode($th);
            }
        }
    }

    public static function eliminarEmpleado()
    {
        isAuth();

        permisosAPI();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = s($_POST['id']);
            $empleado = Empleado::where('id', $id);

            if (!$empleado) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al eliminar el empleado'
                ];

                echo json_encode($respuesta);

                return;
            }

            $resultado = $empleado->eliminar();

            if ($resultado) {
                $respuesta = [
                    'tipo' => "Exito",
                    'mensaje' => "El empleado ha sido eliminado correctamente",
                ];
            }

            echo json_encode($respuesta);
        }
    }

    public static function empleadosAPI()
    {
        isAuth();

        $auth = intval($_SESSION['empleado_rol']);

        $employees = new EmployeesAPI();
        $resultado = $employees->consulta();

        echo json_encode($resultado);
    }

    public static function rolesAPI()
    {
        isAuth();

        $auth = intval($_SESSION['empleado_rol']);

        if ($auth !== 1 && $auth !== 3) {
            $respuesta = [
                'mensaje' => 'Usted no puede acceder a este contenido'
            ];

            echo json_encode($respuesta);
            return;
        }

        $roles = Roles::all();
        echo json_encode($roles);
    }
}
