<?php

namespace Controllers;

use Model\ControlDoblado;
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
                    header('Location: /admin/control_troquel?exito=1');
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


    // tabla consumo troquel
    public static function tablaConsumoTroquel(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $control = ControlTroquel::all();


        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $router->render('admin/control/tablaConsumoTroquel', [
            'titulo' => 'Tabla Consumo Troquel',
            'subtitulo' => 'Consumo Troquel',
            'nombre' => $nombre,
            'email' => $email,
            'control' => $control
        ]);
    }




    // eliminar consumo troquel
    public static function eliminarConsumoTroquel()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $control = ControlTroquel::find($id);
            if ($control) {
                $resultado = $control->eliminar();
                if ($resultado) {
                    header('Location: /admin/tablaConsumoTroquel?exito=1');
                } else {
                    header('Location: /admin/tablaConsumoTroquel?error=1');
                }
            } else {
                header('Location: /admin/tablaConsumoTroquel?error=1');
            }
        }
    }




    // --------------------------------------------------------------------CONTROL DOBLADO--------------------------------------------

    public static function consumo_doblado(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $alertas = [];


        $control_doblado = new ControlDoblado;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['personal']) && is_array($_POST['personal'])) {
                $_POST['personal'] = implode(',', $_POST['personal']);
            }
            $control_doblado->sincronizar($_POST);

            if ($control_doblado->horas_programadas > 0) {
                // Convertir solo para el cálculo
                $horasDecimal = $control_doblado->convertirHorasADecimal($control_doblado->horas_programadas);

                // Validar que el resultado de conversión sea mayor a 0
                if ($horasDecimal > 0) {
                    $control_doblado->cantidad_lamina_hora = $control_doblado->cantidad_laminas / $horasDecimal;
                } else {
                    $control_doblado->cantidad_lamina_hora = 0;
                }
            } else {
                $control_doblado->cantidad_lamina_hora = 0;
            }
            // debuguear($control_doblado);
            $alertas = $control_doblado->validar();

            if (empty($alertas)) {
                $resultado = $control_doblado->guardar();
                if ($resultado) {
                    // resu
                    header('Location: /admin/control/doblado/consumo_doblado?exito=1');
                }
            } else {
                $alertas = ControlDoblado::getAlertas();
            }
        }



        $router->render('admin/control/doblado/consumo_doblado', [
            'titulo' => 'Control Doblado',
            'nombre' => $nombre,
            'email' => $email
        ]);
    }

    // tabla consumo doblado
    public static function tablaConsumoDoblado(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $control_doblado = ControlDoblado::all();

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $router->render('admin/control/doblado/tablaConsumoDoblado', [
            'titulo' => 'Tabla Consumo Doblado',
            'subtitulo' => 'Consumo Doblado',
            'nombre' => $nombre,
            'email' => $email,
            'control_doblado' => $control_doblado
        ]);
    }


    // eliminar consumo doblado
    public static function eliminarConsumoDoblado()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $control_doblado = ControlDoblado::find($id);
            if ($control_doblado) {
                $resultado = $control_doblado->eliminar();
                if ($resultado) {
                    header('Location: /admin/control/doblado/tablaConsumoDoblado?exito=1');
                } else {
                    header('Location: /admin/control/doblado/tablaConsumoDoblado?error=1');
                }
            } else {
                header('Location: /admin/control/doblado/tablaConsumoDoblado?error=1');
            }
        }
    }




// ---------------------------------------- CONTROL CONVERTIDOR ----------------------------------------

public static function consumo_convertidor(Router $router)
{
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: /');
    }

    // NOMBRE DE LA PERSONA LOGEADA
    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];
    $alertas = [];

  
    $router->render('admin/control/convertidor/consumo_convertidor', [
        'titulo' => 'Control Convertidor',
        'nombre' => $nombre,
        'email' => $email,
        'alertas' => $alertas
    ]);






}















































}
