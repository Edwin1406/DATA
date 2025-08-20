<?php

namespace Controllers;

use MVC\Router;

class MantenimientoController
{
    public function registroMantenimiento(Router $router)
    {
        


        


        $router->render('admin/mantenimiento/registroMantenimiento', [
            'titulo' => 'REGISTRO DE MANTENIMIENTO',
        ]);
    }
}

