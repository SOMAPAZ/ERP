<?php

namespace Controllers;

class ImagenesController
{
    public static function imagenReporte()
    {
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagen = s($_FILES['imagen']['tmp_name']);

            echo json_encode([
                'tipo' => 'Exito',
                'mensaje' => 'Imagen guardada',
                'imagen' => $imagen
            ]);
        }
    }
}
