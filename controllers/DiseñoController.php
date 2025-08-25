<?php

namespace Controllers;

use Classes\EmailDiseno;
use Classes\EmailRegistroDiseno;
use Model\Diseno;
use Model\TurnoDiseno;
use MVC\Router;
use Throwable;

class DiseñoController
{
    public static function crearDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $diseno = new Diseno;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $diseno->sincronizar($_POST);
            $alertas = $diseno->validar();

            // Verificar si el código ya está registrado antes de subir el archivo
            $existeCodigo = Diseno::where('codigo_producto', $diseno->codigo_producto);
            if ($existeCodigo) {
                Diseno::setAlerta('error', 'El código ya está registrado. No se subió el PDF.');
                $alertas = Diseno::getAlertas();
            } else {
                // Subir el PDF solo si el código no existe
                if (!empty($_FILES['pdf']['tmp_name'])) {
                    $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

                    if (!is_dir($carpeta_pdfs)) {
                        mkdir($carpeta_pdfs, 0755, true);
                    }

                    $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
                    $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

                    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                        $diseno->pdf = $nombre_pdf;
                    } else {
                        $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
                    }
                }

                // Guardar si no hay alertas
                if (empty($alertas)) {
                    $resultado = $diseno->guardar();
                    if ($resultado) {
                        header('Location: /admin/diseno/crearDiseno?exito=1');
                        exit;
                    }
                }
            }
        }

        $router->render('admin/diseno/crearDiseno', [
            'titulo' => 'CREAR DISEÑO',
            'nombre' => $nombre,
            'email' => $email,
            'diseno' => $diseno,
            'alertas' => $diseno->getAlertas(),
        ]);
    }


    public static function tablaDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener todos los diseños
        $disenos = Diseno::all();

        $router->render('admin/diseno/tablaDiseno', [
            'titulo' => 'TABLA DISEÑO',
            'subtitulo' => 'Diseños Registrados',
            'nombre' => $nombre,
            'email' => $email,
            'disenos' => $disenos,
        ]);
    }


    public static function editarDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener el ID del diseño a editar
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/diseno/tablaDiseno');
            exit;
        }

        // Buscar el diseño por ID
        $diseno = Diseno::find($id);
        if (!$diseno) {
            header('Location: /admin/diseno/tablaDiseno');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $diseno->sincronizar($_POST);
            $alertas = $diseno->validar();

            if (!empty($_FILES['pdf']['tmp_name'])) {
                $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

                // Crear carpeta si no existe
                if (!is_dir($carpeta_pdfs)) {
                    mkdir($carpeta_pdfs, 0755, true);
                }

                // Generar un nombre único para el archivo 
                $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
                $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

                // Intentar mover el archivo cargado
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                    // Asignar el nombre del archivo al objeto diseño
                    $diseno->pdf = $nombre_pdf;
                } else {
                    $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
                }

                // debuguear($diseno);
            }

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $diseno->guardar();
                if ($resultado) {
                    header('Location: /admin/diseno/tablaDiseno?editado=2');
                    exit;
                }
            }
        }

        $router->render('admin/diseno/editarDiseno', [
            'titulo' => 'EDITAR DISEÑO',
            'nombre' => $nombre,
            'email' => $email,
            'diseno' => $diseno,
            'alertas' => $diseno->getAlertas(),
        ]);
    }
    // elimnar pdf 


    public static function eliminarPDF()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['error' => 'No autorizado']);
            return;
        }

        $id = $_POST['id'] ?? null;
        if (!$id) {
            echo json_encode(['error' => 'ID no proporcionado']);
            return;
        }

        $diseno = Diseno::find($id);
        if (!$diseno || !$diseno->pdf) {
            echo json_encode(['error' => 'Diseño o PDF no encontrado']);
            return;
        }

        $ruta_pdf = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/' . $diseno->pdf;
        if (file_exists($ruta_pdf)) {
            unlink($ruta_pdf);
        }

        $diseno->pdf = null;
        $diseno->guardar();

        echo json_encode(['success' => true]);
    }






    public static function eliminarDiseno()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $diseno = Diseno::find($id);
            if ($diseno) {
                $resultado = $diseno->eliminar();
                if ($resultado) {
                    header('Location: /admin/diseno/tablaDiseno?eliminado=3');
                } else {
                    header('Location: /admin/diseno/tablaDiseno?error=1');
                }
            } else {
                header('Location: /admin/diseno/tablaDiseno?error=1');
            }
        }
    }





    // Generar Turno
    public static function generarTurno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $alertas = [];
        $turno = new TurnoDiseno;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['colores']) && is_array($_POST['colores'])) {
                $_POST['colores'] = implode(',', $_POST['colores']);
            }

            $turno->sincronizar($_POST);

            // debuguear($turno);

            // generar codigo aleatorio pero solo de 6 digitos
            $turno->codigo = substr(md5(uniqid(rand(), true)), 0, 6);



            //     debuguear($turno);

            // debuguear($turno);
            // email por defecto
            // $emaildefault = 'desarrollodeproductoms@gmail.com';
            $emaildefault = 'sistemas@megaecuador.com';

            // // Enviar correo de confirmación
            $email = new EmailRegistroDiseno(
                $emaildefault,
                $turno->vendedor,
                $turno->codigo,
                $turno->estado,
                $turno->tipo_producto,
                $turno->tipo_componente,
                $turno->alto,
                $turno->largo,
                $turno->ancho,
                $turno->dobles,
                $turno->flauta,
                $turno->material,
                $turno->ect,
                $turno->descripcion,
                $turno->observaciones
            );


            // $emails = ['sistemas@megaecuador.com', 'edwin.ed948@gmail.com'];

            // foreach ($emails as $destinatario) {
            //     $email = new EmailRegistroDiseno(
            //         $destinatario,
            //         $turno->vendedor,
            //         $turno->codigo,
            //         $turno->estado,
            //         $turno->tipo_producto,
            //         $turno->tipo_componente,
            //         $turno->alto,
            //         $turno->largo,
            //         $turno->ancho,
            //         $turno->dobles,
            //         $turno->flauta,
            //         $turno->material,
            //         $turno->ect,
            //         $turno->descripcion,
            //         $turno->observaciones
            //     );

            $email->enviarConfirmacion2();


            // debuguear($turno);
            $alertas = $turno->validar();

            if (empty($alertas)) {
                $resultado = $turno->guardar();
                if ($resultado) {
                    header('Location: /admin/turnoDiseno/generarTurno?exito=1');
                }
            }
        }

        $router->render('admin/turnoDiseno/generarTurno', [
            'titulo' => 'GENERAR TURNO',
            'nombre' => $nombre,
            'email' => $email,
            'alertas' => $alertas,
        ]);
    }



    // turno tablaDiseno
    public static function turnotablaDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $turnos = TurnoDiseno::all();

        $router->render('admin/turnoDiseno/turnotablaDiseno', [
            'titulo' => 'TABLA TURNO',
            'nombre' => $nombre,
            'email' => $email,
            'turnos' => $turnos,
        ]);
    }


    // editar turno
    public static function editarTurno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $nombre = $_SESSION['nombre'];
        $email  = $_SESSION['email'];
        $alertas = [];

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/turnoDiseno/turnotablaDiseno');
            exit;
        }

        // Cargar el registro existente
        $turno = TurnoDiseno::find($id);

        if (isset($_POST['colores']) && is_array($_POST['colores'])) {
            $_POST['colores'] = implode(',', $_POST['colores']);
        }

        // Obtener la posición del registro según su fecha de creación
$posicion = TurnoDiseno::countTicketsPendientesHoy($turno->fecha_creacion);

// Ejemplo: guardarlo en el objeto o mostrarlo
$turno->posicion = $posicion;


// debuguear($turno->posicion);

        

        // debuguear($turno->colores);

        $coloresSeleccionados = [];
        if (isset($turno->colores) && !empty($turno->colores)) {
            $coloresSeleccionados = explode(',', $turno->colores);
        }


        if (!$turno) {
            header('Location: /admin/turnoDiseno/turnotablaDiseno');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // O usa un método sincronizar si tu ActiveRecord lo tiene
            if (method_exists($turno, 'sincronizar')) {
                $turno->sincronizar($_POST);


                function normalizar($s)
                {
                    $s = trim($s);
                    $s = preg_replace('/\s+/', ' ', $s); // compacta espacios
                    $s = mb_strtoupper($s, 'UTF-8');
                    // elimina tildes comunes
                    $s = strtr($s, [
                        'Á' => 'A',
                        'É' => 'E',
                        'Í' => 'I',
                        'Ó' => 'O',
                        'Ú' => 'U',
                        'Ü' => 'U',
                        'Ñ' => 'N',
                        'á' => 'A',
                        'é' => 'E',
                        'í' => 'I',
                        'ó' => 'O',
                        'ú' => 'U',
                        'ü' => 'U',
                        'ñ' => 'N'
                    ]);
                    return $s;
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (method_exists($turno, 'sincronizar')) {
                        $turno->sincronizar($_POST);
                    }

                    // Solo redirige si el destino original es el correo de pruebas
                    if (isset($email) && strcasecmp(trim($email), 'pruebas@megaecuador.com') === 0 || strcasecmp(trim($email), 'artes@megaecuador.com') === 0) {

                        // Cambia esta variable si tu campo real se llama distinto:
                        $vendedorNombre = $_POST['vendedor'] ?? $nombre;

                        $vendedores = [
                            "JHON VACA"          => "sistemas@megaecuador.com",
                            "SHULYANA HERNANDEZ" => "sistemas@megaecuador.com",
                            "ANTONELLA DEZCALZI" => "sistemas@megaecuador.com",
                            "CAROLINA MUÑOZ"     => "sistemas@megaecuador.com",
                            "CARLOS DELGADO"     => "sistemas@megaecuador.com",
                            "GABRIEL MALDONADO"   => "sistemas@megaecuador.com"
                        ];
                        // $vendedores = [
                        //     "JHON VACA"          => "ventas@megaecuador.com",
                        //     "SHULYANA HERNANDEZ" => "sistemas@megaecuador.com",
                        //     "ANTONELLA DEZCALZI" => "ventas4@megaecuador.com",
                        //     "CAROLINA MUÑOZ"     => "comercial@megaecuador.com",
                        //     "CARLOS DELGADO"     => "ventas1@megaecuador.com",
                        //     "GABRIEL MALDONADO"   => "asistente.ventas@megaecuador.com"
                        // ];

                        // Crea un mapa con claves normalizadas
                        $mapa = [];
                        foreach ($vendedores as $k => $v) {
                            $mapa[normalizar($k)] = $v;
                        }

                        $clave = normalizar($vendedorNombre);
                        $destinatario = $mapa[$clave] ?? null;

                        // (Opcional) Coincidencia difusa si no se encontró exacta
                        if ($destinatario === null) {
                            $mejor = null;
                            $distMejor = PHP_INT_MAX;
                            $mejorClave = null;
                            foreach (array_keys($mapa) as $k) {
                                $d = levenshtein($clave, $k);
                                if ($d < $distMejor) {
                                    $distMejor = $d;
                                    $mejor = $mapa[$k];
                                    $mejorClave = $k;
                                }
                            }
                            if ($distMejor <= 2) { // tolera 1–2 letras de diferencia
                                $destinatario = $mejor;
                                error_log("Usando coincidencia aproximada: '$vendedorNombre' ~ '$mejorClave' (dist=$distMejor)");
                            }
                        }
                        $codigo = $turno->codigo;


                        if ($destinatario === null) {
                            // Si no hay match, manda al correo por defecto (o maneja el error)
                            $destinatario = 'sistemas@megaecuador.com';

                            error_log("Sin coincidencia para vendedor='$vendedorNombre' (clave='$clave').");
                        }

                        // Importante: pasa el OBJETO $turno (tu clase usa $turno->id en el constructor)
                        $mailer = new EmailDiseno(
                            $destinatario,
                            $vendedorNombre,
                            $codigo,
                            $turno->tipo_producto,
                            $turno->tipo_componente,
                            $turno->alto,
                            $turno->largo,
                            $turno->ancho,
                            $turno->dobles,
                            $turno->descripcion,
                            $turno->fecha_creacion,
                            $turno->fecha_entrega,
                            $turno->estado
                        );

                        if (!$mailer->enviarConfirmacion()) {
                            error_log('No se pudo enviar el correo de confirmación.');
                        }
                    }
                }
            }

            // Asegurar que el id siga presente
            $turno->id = $id;

            $alertas = $turno->validar();

            if (empty($alertas)) {
                $resultado = $turno->guardar(); // debe hacer UPDATE al tener id
                if ($resultado) {
                    header('Location: /admin/turnoDiseno/turnotablaDiseno?editado=2');
                    exit;
                }
            }
        }

        $router->render('admin/turnoDiseno/editarTurno', [
            'titulo'  => 'EDITAR TURNO',
            'nombre'  => $nombre,
            'email'   => $email,
            'turno'   => $turno,
            'alertas' => $alertas,
            'coloresSeleccionados' => $coloresSeleccionados
        ]);
    }


    // eliminar turno diseño
    public static function eliminarTurnoDiseno(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        $id = $_POST['id'] ?? null;
        if ($id) {
            $turno = TurnoDiseno::find($id);
            if ($turno) {
                $resultado = $turno->eliminar();
                if ($resultado) {
                    header('Location: /admin/turnoDiseno/turnotablaDiseno?eliminado=3');
                } else {
                    header('Location: /admin/turnoDiseno/turnotablaDiseno?error=1');
                }
            } else {
                header('Location: /admin/turnoDiseno/turnotablaDiseno?error=1');
            }
        }
    }
}
