<?php

namespace Controllers;

use MVC\Router;

class MantenimientoController
{
    public static function registroMantenimiento(Router $router)
    {
        





        $router->render('admin/mantenimiento/registroMantenimiento', [
            'titulo' => 'REGISTRO DE MANTENIMIENTO',
        ]);
    }
}

