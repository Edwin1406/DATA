<?php

namespace Controllers;

use Model\Consumo_general;

class Apicontroller {
   
    public static function apiConsumoGeneral():void {
        $consmogeneral = Consumo_general::all('ASC');
        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($consmogeneral);
        exit;
    }

}