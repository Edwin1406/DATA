<?php

namespace Controllers;


use MVC\Router;


class PruebasController
{


    public function crearPruebas(Router $router)
    {



        
        // Lógica para mostrar el formulario de creación de pruebas
        $router->render('admin/pruebas/crearPrueba', [
            'titulo' => 'Crear Prueba'
        ]);
    }
    



}