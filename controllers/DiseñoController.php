<?php

namespace Controllers;

use Model\Diseno;
use MVC\Router;

class DiseñoController
{
   public static function crearDiseno(Router $router)
{
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: /');
    }

    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];
    $diseno = new Diseno;

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
            $existeCodigo = Diseno::where('codigo_producto', $diseno->codigo_producto);
            if($existeCodigo) {
                Diseno::setAlerta('error', 'El Codigo ya esta registrado');
                $alertas = Diseno::getAlertas();
            } else {
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

                debuguear($diseno);
            }

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $diseno->guardar();
                if ($resultado) {
                    header('Location: /admin/diseno/tablaDiseno?exito=1');
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



    
// public static function editarDiseno(Router $router)
// {
//     $id = $_GET['id'];
//     $id = filter_var($id, FILTER_VALIDATE_INT);

//  session_start();
//         if (!isset($_SESSION['email'])) {
//             header('Location: /');
//         }

//         $nombre = $_SESSION['nombre'];
//         $email = $_SESSION['email'];



//     $diseno = Diseno::find($id); // Obtener diseño actual
//     $alertas = Diseno::getAlertas();

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $diseno->sincronizar($_POST); // Sincronizar datos del formulario
//         $alertas = $diseno->validar(); // Validar datos

//         // Verificar si se subió un nuevo archivo PDF
//         if (!empty($_FILES['pdf']['tmp_name'])) {
//             $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

//             // Crear carpeta si no existe
//             if (!is_dir($carpeta_pdfs)) {
//                 mkdir($carpeta_pdfs, 0755, true);
//             }

//             // Verificar si existe un archivo previo
//             if (!empty($diseno->pdf)) {
//                 $pdf_anterior = $carpeta_pdfs . '/' . $diseno->pdf;

//                 // Eliminar archivo anterior si existe
//                 if (file_exists($pdf_anterior)) {
//                     unlink($pdf_anterior);
//                 }
//             }

//             // Generar un nuevo nombre único para el archivo PDF
//             $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
//             $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

//             // Mover el nuevo archivo a la carpeta
//             if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
//                 // Actualizar el nombre del archivo en el objeto diseño
//                 $diseno->pdf = $nombre_pdf;
//             } else {
//                 $alertas[] = "Error al mover el archivo PDF. Verifica los permisos de la carpeta.";
//             }
//         }

//         if (empty($alertas)) {
//             // Guardar en la base de datos
//             $resultado = $diseno->guardar();
//             if ($resultado) {
//                 header('Location: /admin/diseno/tablaDiseno');
//                 exit;
//             }
//         }
//     }

//     $router->render('admin/diseno/editarDiseno', [
//         'diseno' => $diseno,
//         'alertas' => $alertas,
//         'titulo' => 'EDITAR REGISTRO',
//         'nombre' => $nombre,
//         'email' => $email,
//     ]);
// }






    




















}
