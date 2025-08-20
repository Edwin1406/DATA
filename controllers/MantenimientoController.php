<?php

namespace Controllers;

use Model\Mantenimiento;
use MVC\Router;

class MantenimientoController
{
    public static function registroMantenimiento(Router $router)
    {
        
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $email = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];

        $mantenimiento = new Mantenimiento;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mantenimiento->sincronizar($_POST);

            $mantenimiento->subtotal=

            // Validar los datos
            $errores = $mantenimiento->validar();

            if (empty($errores)) {
                // Guardar el mantenimiento en la base de datos
                $resultado = $mantenimiento->guardar();
                if ($resultado) {
                    header('Location: /admin/mantenimiento/registroMantenimiento?exito=1');
                }
            }
        }

        $router->render('admin/mantenimiento/registroMantenimiento', [
            'titulo' => 'REGISTRO DE MANTENIMIENTO',
            'email' => $email,
            'nombre' => $nombre,
            'mantenimiento' => $mantenimiento
        ]);
    }
}
