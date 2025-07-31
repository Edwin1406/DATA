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
    $diseno = new Diseno();
    $alertas = [];

    // --- Subida directa del PDF desde FilePond ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['pdf']['tmp_name']) && empty($_POST)) {
        $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

        if (!is_dir($carpeta_pdfs)) {
            mkdir($carpeta_pdfs, 0755, true);
        }

        $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
        $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
            echo $nombre_pdf;
        } else {
            http_response_code(500);
            echo 'Error al mover el archivo';
        }

        exit;
    }

    // --- Envío del formulario completo con datos del diseño ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $diseno->sincronizar($_POST);
        $alertas = $diseno->validar();

        // Asignar nombre del archivo PDF si fue subido con FilePond
        if (!empty($_POST['pdf'])) {
            $diseno->pdf = $_POST['pdf']; // Aquí debe llegar un string como "archivo123.pdf"
        }

        if (empty($alertas)) {
            $existeCodigo = Diseno::where('codigo_producto', $diseno->codigo_producto);
            if ($existeCodigo) {
                Diseno::setAlerta('error', 'El Código ya está registrado');
                $alertas = Diseno::getAlertas();
            } else {
                $resultado = $diseno->guardar();
                if ($resultado) {
                    header('Location: /admin/vendedor/cliente/tabla?page=1');
                    exit;
                }
            }
        }
    }

    $router->render('admin/diseno/crearDiseno', [
        'titulo' => 'CREAR DISEÑO',
        'nombre' => $nombre,
        'email' => $email,
        'alertas' => $alertas,
    ]);
}






    




















}
