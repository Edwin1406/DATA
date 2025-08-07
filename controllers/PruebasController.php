<?php

namespace Controllers;

use Model\Carrito;
use MVC\Router;


class PruebasController
{


    public static function crearPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];
            
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();

        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->id_producto = $_POST['id_producto'];
            $carrito->cantidad = $_POST['cantidad'];
           
            $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearPruebas?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }



    
        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/crearPruebas', [
            'titulo' => 'Crear Pruebas',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
        ]);


     
    }


    public static function eliminarCarrito()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $carrito = Carrito::find($id);

            if ($carrito) {
                $carrito->eliminar();
                header('Location: /admin/pruebas/crearPruebas?exito=1');
                exit;
            } else {
                // Manejar el caso en que no se encuentra el registro
                header('Location: /admin/pruebas/crearPruebas?error=1');
                exit;
            }
        }
    }




    public static function registrarVenta()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // LLAMAR AL CARRITO X ID DE USUARIO
        $id_usuario = $_SESSION['id'];
        $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);
        // FOREACH PARA RECORRER Y SUMAR LA PRECIO UNITARIO Y SACAR UN TOTAL 
        $total = 0;
        foreach ($carritoTemporal as $item) {
            $total += $item->precio_unitario;
        }

        debuguear($total);




    }









    



}