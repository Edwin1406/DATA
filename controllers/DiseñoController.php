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
        exit;
    }

    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: /admin/diseno/tablaDiseno');
        exit;
    }

    $diseno = Diseno::find($id);
    if (!$diseno) {
        header('Location: /admin/diseno/tablaDiseno');
        exit;
    }

    // ✅ Manejo de eliminación de PDF
    if (isset($_GET['eliminar_pdf']) && $_GET['eliminar_pdf'] == 1) {
        if ($diseno->pdf) {
            $ruta_pdf = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/' . $diseno->pdf;
            if (file_exists($ruta_pdf)) {
                unlink($ruta_pdf);
            }
            $diseno->pdf = null;
            $diseno->guardar(); // Guardar cambios tras eliminar
        }
        // No redireccionamos, simplemente seguimos y renderizamos la vista actualizada
    }

    // ✅ Manejo del formulario POST (editar diseño)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $diseno->sincronizar($_POST);
        $alertas = $diseno->validar();

        // Subida de nuevo PDF
        if (!empty($_FILES['pdf']['tmp_name'])) {
            $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';
            if (!is_dir($carpeta_pdfs)) {
                mkdir($carpeta_pdfs, 0755, true);
            }

            $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
            $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
                if ($diseno->pdf) {
                    $ruta_pdf_anterior = $_SERVER['DOCUMENT_ROOT'] . '/src/visor/' . $diseno->pdf;
                    if (file_exists($ruta_pdf_anterior)) {
                        unlink($ruta_pdf_anterior);
                    }
                }

                $diseno->pdf = $nombre_pdf;
            } else {
                $alertas[] = "Error al mover el archivo PDF.";
            }
        }

        if (empty($alertas)) {
            $resultado = $diseno->guardar();
            if ($resultado) {
                // ✅ Redireccionar solo después de editar
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





















}
