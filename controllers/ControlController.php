<?php

namespace Controllers;

use MVC\Router;

class ControlController
{
    public static function controlTroquel(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Aquí podrías cargar los datos necesarios para el control de troquel

        $router->render('admin/control_troquel', [
            'titulo' => 'Control Troquel',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }
}