<?php

namespace Controllers;

use Model\ControlTroquel;
use MVC\Router;

class ControlController
{
    public static function control_troquel(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $control = new ControlTroquel;


        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $control->sincronizar($_POST);
            // debuguear($control);
             if ($control->horas_programadas > 0) {
            // Convertir solo para el cálculo
            $horasDecimal = $control->convertirHorasADecimal($control->horas_programadas);
            
            // Validar que el resultado de conversión sea mayor a 0
            if ($horasDecimal > 0) {
                $control->golpes_maquina_hora = $control->golpes_maquina / $horasDecimal;
            } else {
                $control->golpes_maquina_hora = 0;
            }
        } else {
            $control->golpes_maquina_hora = 0;
        }

        // debuguear($control);

            $alertas = $control->validar();
            if (empty($alertas)) {
                $resultado = $control->guardar();
                if ($resultado) {
                    header('Location: /admin/control_troquel');
                }
            }
        } else {
            $alertas = [];
        }

        $router->render('admin/control/control_troquel', [
            'titulo' => 'Control Troquel',
            'nombre' => $nombre,
            'email' => $email,
            'alertas' => $alertas
        ]);
    }
}

