<?php

namespace Controllers;


use MVC\Router;


class PruebasController
{


    public static function crearPruebas(Router $router)
    {

        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/crearPruebas', [
            'titulo' => 'Crear Pruebas'
        ]);


     
    }
    



}