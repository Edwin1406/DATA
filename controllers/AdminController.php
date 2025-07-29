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
            
            if (isset($_POST['personal']) && is_array($_POST['personal'])) {
                $_POST['personal'] = implode(',', $_POST['personal']);
            }
            $consumo->sincronizar($_POST);
            $consumo->sacarTotalHoras();

            
            // Calcular productividad cada 15 minutos
            $cantidad = is_numeric($consumo->cantidad) ? (float)$consumo->cantidad : 0;
            $minutos_trabajados = $consumo->total_horas * 60;

            if ($cantidad > 0 && $minutos_trabajados > 0) {
                // $control->x_hora = ($cantidad / $minutos_trabajados) * 15;
                $consumo->x_hora = round(($cantidad / $minutos_trabajados) * 15);

            } else {
                $consumo->x_hora = 0;
            }

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



// tabla de consumo
public static function tablaConsumo(Router $router)
{
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: /');
    }
    // NOMBRE DE LA PERSONA LOGEADA
    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];

    $consumos = Prueba::all();
    // debuguear($consumos);

    $router->render('admin/consumo/tablaConsumo', [
        'titulo' => 'MEGASTOCK-DESARROLLO',
        'nombre' => $nombre,
        'email' => $email,
        'consumos' => $consumos
    ]);
}


    // Eliminar consumo
    public static function eliminarConsumo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $consumo = Prueba::find($id);
                if ($consumo) {
                    $consumo->eliminar();
                    header('Location: /admin/tablaConsumo?exito=1');
                } else {
                    header('Location: /admin/tablaConsumo?error=1');
                }
            } else {
                header('Location: /admin/tablaConsumo?error=1');
            }
        }
    }

















private static function contarUsuariosConectados()
{
    $path = ini_get("session.save_path");
    if (empty($path)) $path = sys_get_temp_dir();

    $cuenta = 0;
    foreach (glob("$path/sess_*") as $file) {
        if (filemtime($file) + ini_get("session.gc_maxlifetime") > time()) {
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



