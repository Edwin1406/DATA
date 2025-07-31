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

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

         $diseno = new Diseno();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['pdf']['tmp_name']) && empty($_POST)) {
        $carpeta_pdfs = $_SERVER['DOCUMENT_ROOT'] . '/src/visor';

        // Crear carpeta si no existe
        if (!is_dir($carpeta_pdfs)) {
            mkdir($carpeta_pdfs, 0755, true);
        }

        // Generar nombre único
        $nombre_pdf = md5(uniqid(rand(), true)) . '.pdf';
        $ruta_destino = $carpeta_pdfs . '/' . $nombre_pdf;

        // Mover archivo y devolver nombre como respuesta
        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $ruta_destino)) {
            echo $nombre_pdf; // FilePond espera esta respuesta
        } else {
            http_response_code(500);
            echo 'Error al mover el archivo';
        }

        exit; // Evitar que el flujo continúe
    }

    // --- Caso 2: Envío del formulario completo con datos del diseño ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $diseno->sincronizar($_POST);
        $alertas = $diseno->validar();

        // Asignar el nombre del PDF si ya fue subido y enviado como parte del formulario
        if (!empty($_POST['pdf'])) {
            $diseno->pdf = $_POST['pdf']; // Este valor lo deberías guardar temporalmente al subirlo con FilePond
        }

        debuguear($diseno);

        if (empty($alertas)) {
            // Verificar código repetido
            $existeCodigo = Diseno::where('codigo_producto', $diseno->codigo_producto);
            if ($existeCodigo) {
                Diseno::setAlerta('error', 'El Código ya está registrado');
                $alertas = Diseno::getAlertas();
            } else {
                $resultado = $diseno ->guardar();
                if ($resultado) {
                    header('Location: /admin/vendedor/cliente/tabla?page=1');
                    exit;
                }
            }
        }
    }




        // Aquí puedes agregar la lógica para crear un diseño

        $router->render('admin/diseno/crearDiseno', [
            'titulo' => 'CREAR DISEÑO',
            'nombre' => $nombre,
            'email' => $email,
        ]);
    }









    




















}
