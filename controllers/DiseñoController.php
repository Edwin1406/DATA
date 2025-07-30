<?php

namespace Controllers;


use MVC\Router;

class DiseñoController
{
    public static function crearDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Aquí puedes agregar la lógica para crear un diseño

        $router->render('admin/diseno/crearDiseno', [
            'titulo' => 'CREAR DISEÑO',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }
}
