<?php

namespace Controllers;

use Classes\EmailDiseno;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $turno = new TurnoDiseno($_POST);

            // generar codigo aleatorio pero solo de 6 digitos
            $turno->codigo = substr(md5(uniqid(rand(), true)), 0, 6);
            // debuguear($turno);

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
        if (!$turno) {
            header('Location: /admin/turnoDiseno/turnotablaDiseno');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // O usa un método sincronizar si tu ActiveRecord lo tiene
            if (method_exists($turno, 'sincronizar')) {
                $turno->sincronizar($_POST);


            //     if ($email === 'pruebas@megaecuador.com') {
            //         // Aquí sí se enviará al correo de pruebas
            //         $vendedores = [
            //             "JHON VACA"            => "sistemas@megaecuador.com",
            //             "SHULYANA HERNANDEZ"   => "sistemas@megaecuador.com",
            //             "ANTONELLA DEZCALZI"   => "sistemas@megaecuador.com",
            //             "CAROLINA MUÑOZ"       => "sistemas@megaecuador.com"
            //         ];
            //         $email = $vendedores[$nombre] ?? $email;

            //         $email = new EmailDiseno($email, $nombre);
            //         $email->enviarConfirmacion();
            //     }
            // } else {
            //     foreach ($_POST as $campo => $valor) {
            //         $turno->$campo = $valor;
            //     }
            // }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (method_exists($turno, 'sincronizar')) {
        $turno->sincronizar($_POST);
    }

    // Solo si el email es el de pruebas -> redirige al vendedor correspondiente
    if (isset($email) && strcasecmp(trim($email), 'pruebas@megaecuador.com') === 0) {

        // Mapa vendedor -> correo
        $vendedores = [
            "JHON VACA"           => "sistemas@megaecuador.com",
            "SHULYANA HERNANDEZ"  => "ventas3@megaecuador.com",
            "ANTONELLA DEZCALZI"  => "maria@example.com",
            "CAROLINA MUÑOZ"      => "pedro@example.com",
        ];

        // Normaliza el nombre para que coincida con las claves del array
        $clave = mb_strtoupper(trim($nombre), 'UTF-8');

        // Si no hay coincidencia, usa un correo por defecto (o el mismo de pruebas)
        $destinatario = $vendedores[$clave] ?? 'sistemas@logmegaecuador.com';

        try {
            // OJO: pasa el OBJETO $turno, no $turno->codigo
            $mailer = new EmailDiseno($destinatario, $nombre, $turno);

            // Haz que el método devuelva true/false y captura errores
            if (!$mailer->enviarConfirmacion()) {
                error_log('No se pudo enviar el correo de confirmación.');
            }
        } catch (Throwable $e) {
            error_log('Error enviando correo: '.$e->getMessage());
        }
    } else {
        // Resto del flujo cuando no es el correo de pruebas
        foreach ($_POST as $campo => $valor) {
            $turno->$campo = $valor;
        }
    }
}}




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
