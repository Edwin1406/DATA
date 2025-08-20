<?php

namespace Controllers;

use MVC\Router;

class MantenimientoController
{
    public static function registroMantenimiento(Router $router)
    {
        
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];



        $router->render('admin/mantenimiento/registroMantenimiento', [
            'titulo' => 'REGISTRO DE MANTENIMIENTO',
        ]);
    }
}

