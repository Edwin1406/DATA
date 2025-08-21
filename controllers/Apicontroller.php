<?php

namespace Controllers;

use Model\Consumo_general;
use Model\Mantenimiento;

class Apicontroller {
   
    public static function apiConsumoGeneral():void {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="consumo_general.xlsx"');
header('Cache-Control: max-age=0');
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

