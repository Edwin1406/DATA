<?php

namespace Controllers;

use Model\Carrito;
use Model\DetalleVenta;
use Model\Ventas;
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
        exit;
    }

    $id_usuario = $_SESSION['id'];
    $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

    if (empty($carritoTemporal)) {
        // No hay productos en el carrito
        header('Location: /carrito'); // O alguna redirección apropiada
        exit;
    }

    // Calcular total
    $total = 0;
    foreach ($carritoTemporal as $item) {
        $total += $item->precio_unitario;
    }

    // Crear la venta (solo UNA vez)
    $venta = new Ventas;
    $venta->id_usuario = $id_usuario;
    $venta->total = $total;
    $venta->fecha = date('Y-m-d H:i:s');
    $venta->guardar();

    // Obtener el ID de la venta recién creada
    $id_venta = $venta->id; // Asegúrate que ActiveRecord lo actualice correctamente

    // Insertar cada detalle de venta
    foreach ($carritoTemporal as $item) {
        $detalle = new DetalleVenta;
        $detalle->id_venta = $id_venta;
        $detalle->id_producto = $item->id_producto;
        $detalle->cantidad = $item->cantidad;
        $detalle->precio_unitario = $item->precio_unitario;
        $detalle->fecha = date('Y-m-d H:i:s');
        $detalle->guardar();
    }

    // Vaciar el carrito del usuario
    Carrito::eliminarPorUsuario($id_usuario); // O tu método equivalente

    // Confirmar
    header('Location: /admin/pruebas/registrarVenta?exito=1');
}










    



}