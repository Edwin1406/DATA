<?php

namespace Controllers;


use MVC\Router;

class DiseñoController
{
    public static function crearDiseño(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Aquí puedes agregar la lógica para crear un diseño

        $router->render('admin/diseño/crear', [
            'titulo' => 'Crear Diseño',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }
}
