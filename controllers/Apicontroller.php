<?php

namespace Controllers;

use Model\Consumo_general;
use Model\Mantenimiento;

class Apicontroller {
   
    public static function apiConsumoGeneral():void {
        // CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        $consmogeneral = Consumo_general::all('ASC');
        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($consmogeneral);
        exit;
    }

    public static function apiMantenimiento():void {
        $mantenimiento = Mantenimiento::all('ASC');
        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($mantenimiento);
        exit;
    }

}

