<?php
session_start();

include("model/conexion.php");

$error_message = ""; // Variable para almacenar el mensaje de error

if (!empty($_POST["btn-access"])) {
    if (!empty($_POST['user-name']) and !empty($_POST['password'])) {
        $usuario = $_POST["user-name"];
        $password = $_POST["password"];
        $sql = $conexion->query("SELECT * FROM claves_sesion WHERE usuario = '$usuario' AND clave = '$password'");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["id"] = $datos->id;
            $_SESSION["nombres"] = $datos->nombres;
            $_SESSION["rol"] = $datos->rol;
            header("location: /main.php");
        } else {
            // Asignar mensaje de error
            $error_message = "Usuario o contraseña incorrectos";
        }
    } else {
        // Asignar mensaje de error
        $error_message = "Por favor, complete todos los campos";
    }
}
