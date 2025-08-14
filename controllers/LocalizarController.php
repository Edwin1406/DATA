<?php

namespace Controllers;

use Model\Carrito;
use Model\DetalleVenta;
use Model\Ventas;
use MVC\Router;


class LocalizarController
{


    public static function registroVehiculos(Router $router)
    {

        $router->render('admin/control/vehiculos/registroVehiculos', [
            'titulo' => 'Registro de Vehículos',
        ]);


    }

}






