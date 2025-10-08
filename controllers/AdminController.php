<?php

namespace Controllers;


use Model\Consumo_general;
use Model\HorasTrabajo;
use Model\ProduccionDiaria;
use Model\Prueba;
use Model\Ventas;
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
        $router->render('admin/dashboard/index', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,
            'usuariosConectados' => $usuariosConectados
        ]);
    }


    // hora de trabajo

    public static function horasTrabajo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $horas_trabajo = new HorasTrabajo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $horas_trabajo->sincronizar($_POST);

            // debuguear($horas_trabajo);
            $alertas = $horas_trabajo->validar();
            if (empty($alertas)) {
                $horas_trabajo->guardar();
                header('Location: /admin/consumo?exito=1');
            }
        }
    }









    // // consumo
    // public static function consumo(Router $router)
    // {
    //     session_start();
    //     if (!isset($_SESSION['email'])) {
    //         header('Location: /');
    //     }
    //     // NOMBRE DE LA PERSONA LOGEADA
    //     $nombre = $_SESSION['nombre'];
    //     $email = $_SESSION['email'];
    //     //cerrar sesión
    //     // solo que me aparezca la hora que fue registrada en la fecha actual de hoy
    //     $fecha_hoy = date('Y-m-d');


    //     $controlEmpaque = Prueba::all();




    //     $alertas = [];
    //     $consumo = new Prueba();
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         if (isset($_POST['personal']) && is_array($_POST['personal'])) {
    //             $_POST['personal'] = implode(',', $_POST['personal']);
    //         }

    //         $consumo->sincronizar($_POST);

    //         // sacar total de horas.
    //         $consumo->sacarTotalHoras();


    //         // Calcular productividad cada 15 minutos
    //         // $cantidad = is_numeric($consumo->cantidad) ? (float)$consumo->cantidad : 0;
    //         // $minutos_trabajados = $consumo->total_horas * 60;

    //         // if ($cantidad > 0 && $minutos_trabajados > 0) {
    //         //     // $control->x_hora = ($cantidad / $minutos_trabajados) * 15;
    //         //     $consumo->x_hora = round(($cantidad / $minutos_trabajados) * 60);
    //         // } else {
    //         //     $consumo->x_hora = 0;
    //         // }



    //         // // Calcular productividad por hora
    //         $cantidad = is_numeric($consumo->cantidad) ? (float)$consumo->cantidad : 0;
    //         $total_horas = is_numeric($consumo->total_horas) ? (float)$consumo->total_horas : 0;

    //         if ($cantidad > 0 && $total_horas > 0) {
    //             $consumo->x_hora = round($cantidad / $total_horas);
    //         } else {
    //             $consumo->x_hora = 0;
    //         }


    //         // // Calcular productividad por hora



    //         // DEBUGUEAR($consumo); // Para ver los datos que se envían
    //         $alertas = $consumo->validar();
    //         if (empty($alertas)) {
    //             $consumo->guardar();
    //             // header('Location: /admin/consumo');
    //             header('Location: /admin/consumo?exito=1');
    //             exit;
    //         }
    //     } else {
    //         $alertas = [];
    //     }

    //     $router->render('admin/consumo/consumo', [
    //         'titulo' => 'MEGASTOCK-DESARROLLO',
    //         'alertas' => $alertas,
    //         'nombre' => $nombre,
    //         'email' => $email
    //     ]);
    // }







    public static function consumo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // solo que me aparezca la hora que fue registrada en la fecha actual de hoy
        $fecha_hoy = date('Y-m-d');

        $controlEmpaque = Prueba::all();

        $alertas = [];
        $consumo = new Prueba();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['personal']) && is_array($_POST['personal'])) {
                $_POST['personal'] = implode(',', $_POST['personal']);
            }

            $consumo->sincronizar($_POST);

            // sacar total de horas.
            $consumo->sacarTotalHoras();

            // Calcular productividad por hora
            $cantidad = is_numeric($consumo->cantidad) ? (float)$consumo->cantidad : 0;
            $total_horas = is_numeric($consumo->total_horas) ? (float)$consumo->total_horas : 0;

            if ($cantidad > 0 && $total_horas > 0) {
                $consumo->x_hora = round($cantidad / $total_horas);
            } else {
                $consumo->x_hora = 0;
            }

            $alertas = $consumo->validar();

            if (empty($alertas)) {
                // Guardamos el nuevo registro
                $consumo->guardar();

                // Verificamos si es necesario actualizar las horas
                $resultado = Prueba::updateHorasTrabajo($consumo->fecha, $consumo->horas_trabajo);

                if ($resultado) {
                    // Si la actualización fue exitosa (horas cambiadas), esperamos 3 segundos
                    sleep(3);  // Pausa de 3 segundos antes de redirigir

                    // Redirigir con éxito
                    header('Location: /admin/consumo?exito=1');
                    exit;
                } else {
                    // Si las horas no cambiaron o hubo algún error
                    header('Location: /admin/consumo?exito=1');
                    exit;
                    // $alertas[] = "Las horas de trabajo ya están actualizadas o no ha habido cambios.";
                }
            }
        }

        $router->render('admin/consumo/consumo', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email
        ]);
    }






    // editar consumo empaque
    public static function editarEmpaque(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/tablaConsumo?error=1');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $alertas = [];
        $consumo = Prueba::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $consumo->sincronizar($_POST);
            // debuguear($consumo);

            $alertas = $consumo->validar();
            if (empty($alertas)) {
                $consumo->guardar();
                header('Location: /admin/tablaConsumo?editado=2');
                exit;
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $consumo = Prueba::find($id);
                if (!$consumo) {
                    header('Location: /admin/tablaConsumo?error=1');
                    exit;
                }
            } else {
                header('Location: /admin/tablaConsumo?error=1');
                exit;
            }
        }


        $router->render('admin/consumo/editarEmpaque', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'consumo' => $consumo
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
            'subtitulo' => 'TABLA CONSUMO EMPAQUE',
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
                    header('Location: /admin/tablaConsumo?eliminado=3');
                } else {
                    header('Location: /admin/tablaConsumo?error=1');
                }
            } else {
                header('Location: /admin/tablaConsumo?error=1');
            }
        }
    }





    // CONSUMO GENERAL
    public static function consumo_general(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $consumo_general = new Consumo_general;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_maquina = $_POST['tipo_maquina'] ?? '';
            $consumo_general->sincronizar($_POST);
            // debuguear($consumo_general); 
            $alertas = $consumo_general->validar();

            if (empty($alertas)) {
                $consumo_general->guardar();
                header('Location: /admin/consumo_general?exito=1');
            }
        } else {
            $alertas = [];
        }

        $router->render('admin/consumo/consumo_general', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,

        ]);
    }


    // TABLA CONSUMO GENERAL


    public static function tablaConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $consumosGenerales = Consumo_general::all();
        // debuguear($consumosGenerales);

        $router->render('admin/consumo/tablaConsumoGeneral', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,
            'consumosGenerales' => $consumosGenerales
        ]);
    }



    // ELIMINAR CONSUMO GENERAL
    public static function eliminarConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $consumoGeneral = Consumo_general::find($id);
                if ($consumoGeneral) {
                    $consumoGeneral->eliminar();
                    header('Location: /admin/tablaConsumoGeneral?exito=1');
                } else {
                    header('Location: /admin/tablaConsumoGeneral?error=1');
                }
            } else {
                header('Location: /admin/tablaConsumoGeneral?error=1');
            }
        }
    }




    public static function tablaAdminConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $consumosGenerales = Consumo_general::all();
        // debuguear($consumosGenerales);

        $router->render('admin/consumo/tablaAdminConsumoGeneral', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'subtitulo' => 'TABLA ADMIN CONSUMO GENERAL',
            'nombre' => $nombre,
            'email' => $email,
            'consumosGenerales' => $consumosGenerales
        ]);
    }




    // EDITAR CONSUMO GENERAL
    public static function editarAdminConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/tablaAdminConsumoGeneral?error=1');
        }

        // debuguear($id);


        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $alertas = [];
        $consumoGeneral = Consumo_general::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consumoGeneral->sincronizar($_POST);
            // sin espacio en blanco
            $consumoGeneral->tipo_maquina = trim($consumoGeneral->tipo_maquina);
            // debuguear($consumoGeneral);
            $alertas = $consumoGeneral->validar();

            if (empty($alertas)) {
                $consumoGeneral->guardar();
                header('Location: /admin/tablaAdminConsumoGeneral?editado=3');
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $consumoGeneral = Consumo_general::find($id);
                if (!$consumoGeneral) {
                    header('Location: /admin/tablaAdminConsumoGeneral?error=1');
                }
            } else {
                header('Location: /admin/tablaAdminConsumoGeneral?error=1');
            }
        }

        $router->render('admin/consumo/editarAdminConsumoGeneral', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'consumoGeneral' => $consumoGeneral
        ]);
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




    // EDITAR CONSUMO GENERAL
    public static function editarConsumoGeneral(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/tablaConsumoGeneral?error=1');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $alertas = [];
        $consumoGeneral = Consumo_general::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $consumoGeneral->sincronizar($_POST);
            // sin espacio en blanco
            $consumoGeneral->tipo_maquina = trim($consumoGeneral->tipo_maquina);
            $alertas = $consumoGeneral->validar();

            if (empty($alertas)) {
                $consumoGeneral->guardar();
                header('Location: /admin/tablaConsumoGeneral?editado=3');
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $consumoGeneral = Consumo_general::find($id);
                if (!$consumoGeneral) {
                    header('Location: /admin/tablaConsumoGeneral?error=1');
                }
            } else {
                header('Location: /admin/tablaConsumoGeneral?error=1');
            }
        }

        $router->render('admin/consumo/editarConsumoGeneral', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'consumoGeneral' => $consumoGeneral
        ]);
    }



    // REGISTRO DE PRODUCCION DIARIA
    public static function produccion_diaria(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $id_corrugador = $_GET['id_corrugador'] ?? null;
        



        $corrugador = Ventas::where('id', $id_corrugador);


        



        // debuguear($corrugador);



        $produccion_diaria = new ProduccionDiaria;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        // unset($_POST['id']); // <- clave

            $produccion_diaria->fecha = $_POST['fecha'] ?? null;
            $produccion_diaria->peso_un = $_POST['peso_un'] ?? 0;
            $produccion_diaria->unidad_x_dia = $_POST['unidad_x_dia'] ?? 0;
            $produccion_diaria->metros_lineales = $_POST['metros_lineales'] ?? 0;
            $produccion_diaria->id_corrugador = $_POST['id_corrugador'] ?? null;
            $produccion_diaria->hora_inicio = $_POST['hora_inicio'] ?? null;
            $produccion_diaria->hora_fin = $_POST['hora_fin'] ?? null;
            $produccion_diaria->desperdicio_lamina = $_POST['desperdicio_lamina'] ?? 0;
            $produccion_diaria->kilos_x_dia = $_POST['kilos_x_dia'] ?? 0;
            $produccion_diaria->turno = $_POST['turno'] ?? null;
            $produccion_diaria->horas_maquina = $_POST['horas_maquina'] ?? 0;
            $produccion_diaria->cambios = $_POST['cambios'] ?? 0;
            $produccion_diaria->tiempo_x_cambio = $_POST['tiempo_x_cambio'] ?? 0;
            $produccion_diaria->unidades_x_procesar = $_POST['unidades_x_procesar'] ?? 0;
            $produccion_diaria->kilos_x_procesar = $_POST['kilos_x_procesar'] ?? 0;
            $produccion_diaria->linea = $_POST['linea'] ?? null;
    

    

            // debuguear($produccion_diaria->id_corrugador);

            if ($produccion_diaria->linea == 'CORRUGADOR CAJAS' || $produccion_diaria->linea == 'CORRUGADOR PLANCHAS') {
                $produccion_diaria->metros_lineales = $_POST['metros_lineales'] =  0 ?? null;
                $produccion_diaria->desperdicio_lamina = $_POST['desperdicio_lamina'] = 0 ?? null;
                $produccion_diaria->peso_un = $_POST['peso_un'] = 0 ?? null;
                $produccion_diaria->unidad_x_dia = $_POST['unidad_x_dia'] = 0 ?? null;
                $produccion_diaria->kilos_x_dia = $_POST['kilos_x_dia'] = 0 ?? null;
                $produccion_diaria->turno = $_POST['turno'] = null ?? null;
                $produccion_diaria->horas_maquina = $_POST['horas_maquina'] = null ?? null;
                $produccion_diaria->cambios = $_POST['cambios'] = 0 ?? null;
                $produccion_diaria->tiempo_x_cambio = $_POST['tiempo_x_cambio'] = 0 ?? null;
                $produccion_diaria->hora_inicio = $_POST['hora_inicio'] = null ?? null;
                $produccion_diaria->hora_fin = $_POST['hora_fin'] = null ?? null;

            }



            
            
            $produccion_diaria->sincronizar($_POST);
            
            // debuguear($produccion_diaria);

            // Verifica si la unidad por día no es cero
            if ($produccion_diaria->unidad_x_dia != 0) {
                $peso_un = $produccion_diaria->kilos_x_dia / $produccion_diaria->unidad_x_dia;
                $produccion_diaria->peso_un = round($peso_un, 2);
            } else {
                // Si la unidad por día es cero, no hacer nada o asignar un valor por defecto
                $produccion_diaria->peso_un = 0; // O cualquier valor predeterminado que quieras
            }


            // debuguear($produccion_diaria);


            // debuguear($produccion_diaria);
            $alertas = $produccion_diaria->validar();
            if (empty($alertas)) {
                $produccion_diaria->guardar();
                header('Location: /admin/diaria/produccion_diaria?id_corrugador=' . $produccion_diaria->id_corrugador . '&exito=1');
            }
        } else {
            $alertas = [];
        }




        // debuguear($nombre);
        $router->render('admin/diaria/produccion_diaria', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,
            'corrugador' => $corrugador,
            'id_corrugador' => $id_corrugador,
        ]);
    }







// tabladiaria
    public static function tablaDiaria(Router $router){
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $produccionDiarias = ProduccionDiaria::all();
        // debuguear($produccionDiarias);

        $router->render('admin/diaria/tablaDiaria', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'subtitulo' => 'TABLA PRODUCCIÓN DIARIA',
            'nombre' => $nombre,
            'email' => $email,
            'produccionDiarias' => $produccionDiarias
        ]);
    }


    // editar produccion diaria
    public static function editarproduccion_diaria(Router $router){
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/diaria/tablaDiaria?error=1');
        }

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $alertas = [];
        $produccion_diaria = ProduccionDiaria::find($id);



        

  // debuguear($nombre);
        $router->render('admin/diaria/editarproduccion_diaria', [
            'titulo' => 'MEGASTOCK-DESARROLLO',
            'nombre' => $nombre,
            'email' => $email,
            'produccion_diaria' => $produccion_diaria,
            'alertas' => $alertas
        ]);


        
    }





// eliminarDiaria
    public static function eliminarDiaria(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $produccionDiaria = ProduccionDiaria::find($id);
                if ($produccionDiaria) {
                    $produccionDiaria->eliminar();
                    header('Location: /admin/diaria/tablaDiaria?eliminado=3');
                } else {
                    header('Location: /admin/diaria/tablaDiaria?error=1');
                }
            } else {
                header('Location: /admin/diaria/tablaDiaria?error=1');
            }
        }
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


    // En AdminController.php
    public static function verLogs()
    {
        $archivo = __DIR__ . "/../logs/requests.log";

        $lineas = [];
        if (file_exists($archivo)) {
            $lineas = array_reverse(file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        }

        include __DIR__ . "/../views/admin/logs.php";
    }
}
