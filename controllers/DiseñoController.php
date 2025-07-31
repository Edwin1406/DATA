<?php

namespace Controllers;

use Model\Diseno;
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

         $diseno = new Diseno();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $diseno->sincronizar($_POST);
            debuguear($diseno);

       
          
                // Manejar las alertas de validación
            }



        // Aquí puedes agregar la lógica para crear un diseño

        $router->render('admin/diseno/crearDiseno', [
            'titulo' => 'CREAR DISEÑO',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }
}
