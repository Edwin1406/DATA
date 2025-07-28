<?php

namespace Controllers;

use Model\Prueba;
use MVC\Router;


class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        // debuguear($nombre);
        $router->render('admin/dashboard/index' , [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email
        ]);
    }

    // consumo
    public static function consumo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
      //cerrar sesión 
      


        $alertas = [];
        $consumo = new Prueba();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consumo->sincronizar($_POST);
            // DEBUGUEAR($consumo); // Para ver los datos que se envían
            $alertas = $consumo->validar();
            if (empty($alertas)) {
                $consumo->guardar();
                // header('Location: /admin/consumo');
                    header('Location: /admin/consumo?exito=1');

            }
        } else {
            $alertas = [];

        }

        $router->render('admin/consumo/consumo', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre
        ]);
    }





    public static function cerrarSesion(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // Cerrar sesión
        session_destroy();
        header('Location: /');
    }






    // error 404
    public static function error404(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $router->render('admin/error404', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'error' => 'Página no encontrada'
        ]);
    }
    
}



