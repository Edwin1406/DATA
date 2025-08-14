<?php

namespace Controllers;


use MVC\Router;


class LocalizarController
{


    public static function registroVehiculos(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];


        $router->render('admin/control/vehiculos/registroVehiculos', [
            'titulo' => 'Registro de Vehículos',
            'nombre' => $nombre,
            'email' => $email

        ]);
    }
}
