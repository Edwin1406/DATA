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

        $consumo = new Prueba();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consumo->sincronizar($_POST);
            debuguear($consumo);
        }
        
        $router->render('admin/consumo/consumo', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
           
        ]);
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



