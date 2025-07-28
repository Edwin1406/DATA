<?php

namespace Controllers;

use Model\Prueba;
use MVC\Router;


class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
            $usuariosConectados = self::contarUsuariosConectados();

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        // debuguear($nombre);
        $router->render('admin/dashboard/index' , [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,
            'usuariosConectados' => $usuariosConectados
        ]);
    }

    // consumo
    public static function consumo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
      //cerrar sesión 
      


        $alertas = [];
        $consumo = new Prueba();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consumo->sincronizar($_POST);
            // DEBUGUEAR($consumo); // Para ver los datos que se envían
            $alertas = $consumo->validar();
            if (empty($alertas)) {
                $consumo->guardar();
                // header('Location: /admin/consumo');
                    header('Location: /admin/consumo?exito=1');

            }
        } else {
            $alertas = [];

        }

        $router->render('admin/consumo/consumo', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre
        ]);
    }



// private static function contarUsuariosConectados()
// {
//     $path = ini_get("session.save_path");
//     if (empty($path)) $path = sys_get_temp_dir();

//     $cuenta = 0;
//     foreach (glob("$path/sess_*") as $file) {
//         if (filemtime($file) + ini_get("session.gc_maxlifetime",10) > time()) {
//             $cuenta++;
//         }
//     }
//     return $cuenta;
// }


// Establece el tiempo de vida de la sesión a 5 minutos (300 segundos)

function contarUsuariosConectados() {
    ini_set("session.gc_maxlifetime", 300);
    $path = ini_get("session.save_path");
    if (empty($path)) $path = sys_get_temp_dir();

    $cuenta = 0;
    foreach (glob("$path/sess_*") as $file) {
        // Considera activa solo la sesión con actividad en los últimos 5 minutos
        if (filemtime($file) + 300 > time()) {
            $cuenta++;
        }
    }
    return $cuenta;
}







    // error 404
    public static function error404(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $router->render('admin/error404', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'error' => 'Página no encontrada'
        ]);
    }
    
}



