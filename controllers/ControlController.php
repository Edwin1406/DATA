<?php

namespace Controllers;

use Model\ControlTroquel;
use MVC\Router;

class ControlController
{
    public static function control_troquel(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $control = new ControlTroquel;


        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $control->sincronizar($_POST);
            debuguear($control);
        }



        // Aquí podrías cargar los datos necesarios para el control de troquel

        $router->render('admin/control/control_troquel', [
            'titulo' => 'Control Troquel',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }
}
