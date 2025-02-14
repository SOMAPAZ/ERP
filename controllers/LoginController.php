<?php

namespace Controllers;

use Classes\Email;
use Empleados\Empleado;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Empleado($_POST);

            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                $empleado = Empleado::where('mail', $auth->mail);

                if (!$empleado || !$empleado->validado) {
                    Empleado::setAlerta('error', 'El usuario no existe o no ha sido validado');
                } else {
                    if (password_verify($auth->password, $empleado->password)) {

                        session_start();
                        $_SESSION['empleado_id'] = $empleado->id;
                        $_SESSION['empleado_name'] = $empleado->name . ' ' . $empleado->lastname;
                        $_SESSION['empleado_mail'] = $empleado->mail;
                        $_SESSION['empleado_rol'] = $empleado->id_rol;
                        $_SESSION['login'] = true;

                        header('Location: /welcome');
                    } else {
                        Empleado::setAlerta('error', 'La contraseña es incorrecta');
                    }
                }
            }
        }
        $alertas = Empleado::getAlertas();

        $router->render('auth/login', [
            'login' => true,
            'alertas' => $alertas
        ]);
    }

    public static function cambiarPassword(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Empleado($_POST);

            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $empleado = Empleado::where('mail', $auth->mail);

                if ($empleado && $empleado->validado === "1") {

                    $empleado->generarToken();
                    $empleado->validado = 0;
                    $empleado->guardar();

                    $email = new Email($empleado->mail, $empleado->name, $empleado->lastname, $empleado->token);
                    $email->enviarEmailInstruciones();

                    header('Location: /mensaje');
                } else {
                    Empleado::setAlerta('error', 'El Usuario no existe o no está confirmado');
                }
            }
        }

        $alertas = Empleado::getAlertas();

        $router->render('auth/olvide', [
            'login' => true,
            'alertas' => $alertas
        ]);
    }

    public static function reestablecerPassword(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $mostrar = true;

        if (!$token) header('Location: /');

        $empleado = Empleado::where('token', $token);

        if (empty($empleado)) {
            Empleado::setAlerta('error', 'Token no Válido');
            $mostrar = false;
        };

        // dd($empleado);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $empleado->sincronizar($_POST);


            $alertas = $empleado->validarPassword();

            if (empty($alertas)) {
                $empleado->hashPassword();
                unset($empleado->password_confirmation);
                $empleado->token = null;
                $empleado->validado = 1;

                $resultado = $empleado->guardar();

                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $router->render('auth/reestablecer', [
            'login' => true,
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function mensajeInstrucciones(Router $router)
    {
        $router->render('auth/mensaje', [
            'login' => true
        ]);
    }

    public static function welcome(Router $router)
    {
        isAuth();

        $router->render('welcome/welcome');
    }

    public static function cerrarSession(Router $router)
    {
        $_SESSION = [];

        header('Location: /');
    }

    public static function notFound(Router $router)
    {
        isAuth();

        $router->render('failure/not-found');
    }
}
