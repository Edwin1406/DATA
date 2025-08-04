<?php

namespace Controllers;


use MVC\Router;


class PruebasController
{


    public function crearPruebas(Router $router)
    {

        echo "Controlador de Pruebas - Crear Prueba";


        // Lógica para mostrar el formulario de creación de pruebas
        $router->render('admin/pruebas/crearPrueba', [
            'titulo' => 'Crear Prueba'
        ]);
    }
    



}