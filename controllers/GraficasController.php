<?php

namespace Controllers;

use MVC\Router;

class GraficasController
{
 
    public static function graficasConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];

        $router->render('admin/graficas/graficasConsumoGeneral', [
            'titulo' => 'Dashboard',
            'email' => $email,
            'nombre' => $nombre
        ]);
    }
    
    
    
    
    
}