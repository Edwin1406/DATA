<?php

namespace Controllers;

use Model\Consumo_general;

class Apicontroller {
   
    public static function apiConsumoGeneral():void {

  // Lógica para obtener los datos de la gráfica
        $consmogeneral = Consumo_general::all('ASC');

        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($consmogeneral);
        exit;

// fecha
// ancho
// largo
// peso





    }

}