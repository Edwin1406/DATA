<?php

namespace Controllers;

use Model\Carrito;
use Model\DetalleVenta;
use Model\VenFlexo;
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
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

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
            'titulo' => 'CORRUGADOR - Registro de Producción',
            'subtitulo' => 'Corrugador',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
        ]);
    }




    // CREAR FLEXO

    public static function crearFlexo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // debuguear($nombre);
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();


        $corrugador = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearFlexo?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/crearFlexo', [
            'titulo' => 'FLEXO - Registro de Producción',
            'subtitulo' => 'Flexo',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'corrugador' => $corrugador
        ]);
    }


    public static function registroDetalleCorrugador(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
            exit;
        }

        $alertas = [];
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $detallecorrugador = new DetalleVenta;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario via AJAX
            $detallecorrugador->id_venta = 33;
            $detallecorrugador->tipo_maquina = $_POST['tipo_maquina'];
            $detallecorrugador->cantidad = $_POST['cantidad'];
            $detallecorrugador->casos = $_POST['casos'];
            $detallecorrugador->observaciones = $_POST['observaciones'];
            $detallecorrugador->fecha = $_POST['fecha'];

            // Validar los datos
            $alertas = $detallecorrugador->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $detallecorrugador->guardar();
                if ($resultado) {
                    // Responder éxito
                    echo json_encode(['success' => true, 'message' => 'Registro guardado exitosamente']);
                    // sweet aalert 2






                } else {
                    // Responder error al guardar
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el registro']);
                }
            } else {
                // Responder con errores de validación
                echo json_encode(['success' => false, 'message' => 'Errores de validación', 'errors' => $alertas]);
            }
            exit;
        }
    }

    public static function registroDetallePreprinter(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
            exit;
        }

        $alertas = [];
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $detallecorrugador = new DetalleVenta;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario via AJAX
            $detallecorrugador->id_venta = 36;
            $detallecorrugador->tipo_maquina = $_POST['tipo_maquina'];
            $detallecorrugador->cantidad = $_POST['cantidad'];
            $detallecorrugador->casos = $_POST['casos'];
            $detallecorrugador->observaciones = $_POST['observaciones'];
            $detallecorrugador->fecha = $_POST['fecha'];

            // Validar los datos
            $alertas = $detallecorrugador->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $detallecorrugador->guardar();
                if ($resultado) {
                    // Responder éxito
                    echo json_encode(['success' => true, 'message' => 'Registro guardado exitosamente']);
                    // sweet aalert 2






                } else {
                    // Responder error al guardar
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el registro']);
                }
            } else {
                // Responder con errores de validación
                echo json_encode(['success' => false, 'message' => 'Errores de validación', 'errors' => $alertas]);
            }
            exit;
        }
    }























    // public static function eliminarCarrito()
    // {
    //     session_start();
    //     if (!isset($_SESSION['email'])) {
    //         header('Location: /');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id'];
    //         $carrito = Carrito::find($id);

    //         if ($carrito) {
    //             $carrito->eliminar();
    //             header('Location: /admin/pruebas/crearPruebas?exito=1');
    //             exit;
    //         } else {
    //             // Manejar el caso en que no se encuentra el registro
    //             header('Location: /admin/pruebas/crearPruebas?error=1');
    //             exit;
    //         }
    //     }
    // }






    public static function eliminarCarrito()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $carrito = Carrito::find($id);

            if ($carrito) {
                $carrito->eliminar();
                // Respuesta en formato JSON para AJAX
                echo json_encode(['success' => true, 'message' => 'Carrito eliminado con éxito']);
                exit;
            } else {
                // Si no se encuentra el carrito
                echo json_encode(['success' => false, 'message' => 'Carrito no encontrado']);
                exit;
            }
        } else {
            // Método incorrecto
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            exit;
        }
    }



    // ELIMINAR DETA





    public static function eliminarDetalleDesperdicios()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $carrito = DetalleVenta::find($id);

            if ($carrito) {
                $carrito->eliminar();
                // Respuesta en formato JSON para AJAX
                echo json_encode(['success' => true, 'message' => 'Detalle de desperdicio eliminado con éxito']);
                exit;
            } else {
                // Si no se encuentra el detalle de desperdicio
                echo json_encode(['success' => false, 'message' => 'Detalle de desperdicio no encontrado']);
                exit;
            }
        } else {
            // Método incorrecto
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            exit;
        }
    }


    // ELIMINAR FLEXO
    public static function eliminarFlexo()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $flexo = VenFlexo::find($id);

            if ($flexo) {
                $flexo->eliminar();
                // Respuesta en formato JSON para AJAX
                echo json_encode(['success' => true, 'message' => 'Registro de flexo eliminado con éxito']);
                exit;
            } else {
                // Si no se encuentra el registro de flexo
                echo json_encode(['success' => false, 'message' => 'Registro de flexo no encontrado']);
                exit;
            }
        } else {
            // Método incorrecto
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            exit;
        }
    }











    // public static function registrarVenta()
    // {
    //     session_start();
    //     if (!isset($_SESSION['email'])) {
    //         header('Location: /');
    //         exit;
    //     }

    //     // ✅ Solo continuar si la petición es POST
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $id_usuario = $_SESSION['id'];
    //         $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

    //         if (empty($carritoTemporal)) {
    //             header('Location: /carrito');
    //             exit;
    //         }

    //         // Calcular total
    //         $total = 0;
    //         foreach ($carritoTemporal as $item) {
    //             $total += $item->cantidad;
    //         }


    //         // Obtener ID generado
    //         // Crear venta
    //         $venta = new Ventas;
    //         $venta->id_usuario = $id_usuario;
    //         // id_venta
    //         // $venta->id_venta = null;
    //         $venta->total = $total;
    //         $venta->fecha = date('Y-m-d H:i:s');
    //         $venta->guardarCarrito();

    //         $id_venta = $venta->id; // Asegúrate que ActiveRecord actualiza esta propiedad


    //         // Insertar detalles
    //         foreach ($carritoTemporal as $item) {
    //             $detalle = new DetalleVenta;
    //             $detalle->id_venta = $id_venta;
    //             $detalle->tipo_maquina = $item->tipo_maquina;
    //             $detalle->cantidad = $item->cantidad;
    //             $detalle->casos = $item->casos;
    //             $detalle->metros_lineales = $item->metros_lineales;
    //             $detalle->n_laminas = $item->n_laminas;
    //             $detalle->n_cambios = $item->n_cambios;
    //             $detalle->consumo_almidon = $item->consumo_almidon;
    //             $detalle->consumo_resina = $item->consumo_resina;
    //             $detalle->consumo_recubrimiento = $item->consumo_recubrimiento;
    //             // $detalle->fecha = date('Y-m-d H:i:s');
    //             $detalle->guardarCarrito();
    //         }

    //         // Vaciar carrito
    //         Carrito::eliminarPorColumna('id_usuario', $id_usuario);

    //         // Redirigir o mostrar mensaje de éxito
    //         header('Location: /admin/pruebas/crearPruebas?exito=1');
    //         exit;
    //     } else {
    //         // Si no es POST, redirige o muestra un error
    //         header('Location: /carrito');
    //         exit;
    //     }
    // }



    public static function registrarVenta()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

                $nombre = $_SESSION['nombre'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearPruebas?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }


    // VENFLEXO 


    public static function registrarVenFlexo()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;

            $n_unidades = $_POST['n_unidades'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';
            


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new VenFlexo;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->n_unidades = $n_unidades;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->motivo_inactividad = $motivo_inactividad;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearFlexo?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }




























    // tabla de pruebas
    public static function tablaPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener los diseños de la base de datos
        $corrugador = Ventas::wherenuevo('linea', 'CORRUGADOR');
        // debuguear($corrugador);
        // $corrugador = Ventas::all();


        // debuguear($corrgador);

        // Renderizar la vista de la tabla de diseños
        $router->render('admin/pruebas/tablaPruebas', [
            'titulo' => 'CORRUGADOR - Tabla de Producción',
            'subtitulo' => 'Corrugador',
            'nombre' => $nombre,
            'email' => $email,
            'corrugador' => $corrugador
        ]);
    }





    
    // tabla de pruebas
    public static function tablaPeriodico(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener los diseños de la base de datos
        $periodico = Ventas::wherenuevo('linea', 'PERIODICO');
        // debuguear($periodico);
        // $periodico = Ventas::all();


        // debuguear($periodico);

        // Renderizar la vista de la tabla de diseños
        $router->render('admin/pruebas/periodico/tablaPeriodico', [
            'titulo' => 'PERIODICO - Tabla de Producción',
            'subtitulo' => 'Periodico',
            'nombre' => $nombre,
            'email' => $email,
            'periodico' => $periodico
        ]);
    }




    
    // tabla de pruebas
    public static function tablaSeparadores(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener los diseños de la base de datos
        $separadores = Ventas::wherenuevo('linea', 'SEPARADORES');
        // debuguear($separadores);
        // $separadores = Ventas::all();


        // debuguear($separadores);

        // Renderizar la vista de la tabla de diseños
        $router->render('admin/pruebas/separadores/tablaSeparadores', [
            'titulo' => 'SEPARADORES - Tabla de Producción',
            'subtitulo' => 'Separadores',
            'nombre' => $nombre,
            'email' => $email,
            'separadores' => $separadores
        ]);
    }


    // tabla de flexo
    public static function tablaFlexo(Router $router)
    {

        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];


        $flexografica = VenFlexo::all();
        // debuguear($flexografica);
        $router->render('admin/pruebas/tablaFlexo', [
            'titulo' => 'FLEXOGRAFICA - Tabla de Producción',
            'subtitulo' => 'Flexo',
            'nombre' => $nombre,
            'email' => $email,
            'flexografica' => $flexografica
        ]);
    }



    // editar pruebas
    public static function editarPruebas(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/pruebas/tablaPruebas');
            exit;
        }

        // Obtener el registro a editar
        $venta = Ventas::find($id);

        // debuguear($venta);

        if (!$venta) {
            header('Location: /admin/pruebas/tablaPruebas');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST;

            $venta->sincronizar($args);

            // debuguear($venta);

            // Validar
            $alertas = $venta->validar();

            if (empty($alertas)) {
                $resultado = $venta->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/tablaPruebas?editado=2');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al actualizar el registro';
                }
            }
        }

        // Renderizar la vista de editar
        $router->render('admin/pruebas/editarPruebas', [
            'titulo' => 'CORRUGADOR - Editar Registro',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'venta' => $venta
        ]);
    }




    // ELIMINAR CORRUGADOR
    public static function eliminarCorrugado(){
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $corrugador = Ventas::find($id);

            if ($corrugador) {
                $corrugador->eliminar();
                header('Location: /admin/pruebas/tablaPruebas?eliminado=3');
                exit;
            } else {
                // Manejar el caso en que no se encuentra el registro
                header('Location: /admin/pruebas/tablaPruebas?error=1');
                exit;
            }
        }
    }









    public static function editarFlexo(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/pruebas/tablaFlexo');
            exit;
        }

        // Obtener el registro a editar
        $venta = VenFlexo::find($id);

        // debuguear($venta);

        if (!$venta) {
            header('Location: /admin/pruebas/tablaFlexo');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST;

            $venta->sincronizar($args);

            // debuguear($venta);

            // Validar
            $alertas = $venta->validar();

            if (empty($alertas)) {
                $resultado = $venta->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/tablaFlexo?editado=2');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al actualizar el registro';
                }
            }
        }

        // Renderizar la vista de editar
        $router->render('admin/pruebas/editarFlexo', [
            'titulo' => 'FLEXOGRAFICA - Editar Registro',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'venta' => $venta
        ]);
    }



    // micro
   

   public static function crearMicro(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // debuguear($nombre);
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();


        $micro = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearMicro?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/micro/crearMicro', [
            'titulo' => 'MICRO - Registro de Producción',
            'subtitulo' => 'Micro',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'micro' => $micro
        ]);
    }


    // REGISTRAR MICRO VEN




    

    public static function registrarVentaMicro()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }


        $nombre = $_SESSION['nombre'];




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearMicro?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }





        public static function tablaMicro(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // Obtener los diseños de la base de datos
        // $corrugador = DetalleVenta::wherenuevo('tipo_maquina', 'CORRUGADOR');
        // $micro = Ventas::whereArray('tipo_maquina', 'MICRO');
                // $corrugador = Ventas::wherenuevo('linea', 'CORRUGADOR');
        $micro = Ventas::wherenuevo('linea', 'MICRO');





        // debuguear($micro);

        // Renderizar la vista de la tabla de diseños
        $router->render('admin/pruebas/micro/tablaMicro', [
            'titulo' => 'MICRO - Tabla de Producción',
            'subtitulo' => 'Micro',
            'nombre' => $nombre,
            'email' => $email,
            'micro' => $micro
        ]);
    }



//PERDIODICO 





   public static function crearPeriodico(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // debuguear($nombre);
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();


        $periodico = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearPeriodico?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/periodico/crearPeriodico', [
            'titulo' => 'PERIODICO - Registro de Producción',
            'subtitulo' => 'Periodico',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'periodico' => $periodico
        ]);
    }








    
    

    public static function registrarVenPeriodico()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }


        $nombre = $_SESSION['nombre'];




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;



            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearPeriodico?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }









// CREAR SEPARADORES




   public static function crearSeparadores(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        // debuguear($nombre);
        // $id_usuario = $_SESSION['id'];
        // debuguear($id_usuario);


        $carritoTemporal = Carrito::all();


        $separadores = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearSeparadores?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/separadores/crearSeparadores', [
            'titulo' => 'SEPARADORES - Registro de Producción',
            'subtitulo' => 'Separadores',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'separadores' => $separadores
        ]);
    }




    public static function registrarVenSeparadores()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }


        $nombre = $_SESSION['nombre'];




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearSeparadores?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }



    // CREAR PREPRINTER


   public static function crearPrePrinter(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $carritoTemporal = Carrito::all();


        $preprinter = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearPrePrinter?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/preprinter/crearPrePrinter', [
            'titulo' => 'PREPRINTER - Registro de Producción',
            'subtitulo' => 'Preprinter',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'preprinter' => $preprinter
        ]);
    }


    
    public static function registrarVenPrePrinter()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }


        $nombre = $_SESSION['nombre'];




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearPrePrinter?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }







// CREAR DOBLADO
   public static function crearDoblado(Router $router)
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
        }
        $alertas = [];

        // NOMBRE DE LA PERSONA LOGEADA
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $carritoTemporal = Carrito::all();


        $doblado = DetalleVenta::all();


        $carrito = new Carrito;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario
            $carrito->id_usuario = $_SESSION['id'];
            $carrito->tipo_maquina = $nombre;
            $carrito->tipo_clasificacion = $_POST['tipo_clasificacion'];
            $carrito->casos = $_POST['casos'];
            $carrito->cantidad = $_POST['cantidad'];
            $carrito->observaciones = $_POST['observaciones'];

            // $carrito->precio_unitario = $carrito->cantidad * 20; // Ejemplo de cálculo

            // Validar los datos
            $alertas = $carrito->validar();

            if (empty($alertas)) {
                // Guardar en la base de datos
                $resultado = $carrito->guardar();
                if ($resultado) {
                    header('Location: /admin/pruebas/crearDoblado?exito=1');
                    exit;
                } else {
                    $alertas['error'][] = 'Error al guardar el registro';
                }
            }
        }




        // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/doblado/crearDoblado', [
            'titulo' => 'DOBLADO - Registro de Producción',
            'subtitulo' => 'Doblado',
            'alertas' => $alertas,
            'nombre' => $nombre,
            'email' => $email,
            'carritoTemporal' => $carritoTemporal,
            'doblado' => $doblado
        ]);
    }




       public static function registrarVenDoblado()
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /');
            exit;
        }


        $nombre = $_SESSION['nombre'];




        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['id'];
            $carritoTemporal = Carrito::wherenuevo('id_usuario', $id_usuario);

            if (empty($carritoTemporal)) {
                header('Location: /carrito');
                exit;
            }

            // Calcular total
            $total = 0;
            foreach ($carritoTemporal as $item) {
                $total += $item->cantidad;
            }

            // Obtener consumo de papel del form
            $consumo_papel = $_POST['consumo_papel'] ?? 0;
            $metros_lineales = $_POST['metros_lineales'] ?? 0;


            $n_laminas = $_POST['n_laminas'] ?? 0;
            $n_cambios = $_POST['n_cambios'] ?? 0;

            // operador
            $operador = $_POST['operador'] ?? '';
            $turno = $_POST['turno'] ?? '';
            $hora_inicio = $_POST['hora_inicio'] ?? '';
            $hora_fin = $_POST['hora_fin'] ?? '';
            $tiempo_inactivo = $_POST['tiempo_inactivo'] ?? '';
            $motivo_inactividad = $_POST['motivo_inactividad'] ?? '';


            // fecha manual
            $fecha = $_POST['fecha'] ?? date('Y-m-d');

            // Crear venta
            $venta = new Ventas;
            $venta->id_usuario = $id_usuario;
            $venta->total = $total;
            $venta->consumo_papel = $consumo_papel;
            $venta->metros_lineales = $metros_lineales;
            $venta->n_laminas = $n_laminas;
            $venta->n_cambios = $n_cambios;


            $venta->operador = $operador;
            $venta->turno = $turno;
            $venta->hora_inicio = $hora_inicio;
            $venta->hora_fin = $hora_fin;
            $venta->tiempo_inactivo = $tiempo_inactivo;
            $venta->motivo_inactividad = $motivo_inactividad;
            // $venta->fecha = date('Y-m-d H:i:s');
            $venta->fecha = $fecha;
            $venta->linea = $nombre;
            
            $venta->guardarCarrito();

            $id_venta = $venta->id;

            // Insertar detalles
            foreach ($carritoTemporal as $item) {
                $detalle = new DetalleVenta;
                $detalle->id_venta = $id_venta;
                $detalle->tipo_maquina = $item->tipo_maquina;
                $detalle->cantidad = $item->cantidad;
                $detalle->casos = $item->casos;
                $detalle->observaciones = $item->observaciones;

                // fecha
                // $detalle->fecha = date('Y-m-d H:i:s');
                $detalle->fecha = $fecha;
                $detalle->guardarCarrito();
            }

            Carrito::eliminarPorColumna('id_usuario', $id_usuario);

            header('Location: /admin/pruebas/crearDoblado?exito=1');
            exit;
        } else {
            header('Location: /carrito');
            exit;
        }
    }


    //CrearDesperdicios
    public static function crearDesperdicios(Router $router)
     {
          session_start();
          if (!isset($_SESSION['email'])) {
                header('Location: /');
          }
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];

        $id_venta = $_GET['id_venta'];
        $id_venta = filter_var($id_venta, FILTER_VALIDATE_INT);
        if (!$id_venta) {
            header('Location: /admin/pruebas/tablaFlexo');
            exit;
        }


        $desperdicios= DetalleVenta::wherenuevo('id_venta', $id_venta);

        // debuguear($desperdicio);
          $alertas = [];








   // Renderizar la vista de crear pruebas
        $router->render('admin/pruebas/desperdicios/crearDesperdicios', [
            'titulo' => 'DESPERDICIOS - Registro de Producción',
            'subtitulo' => 'Desperdicios',
            'alertas' => $alertas,
            'desperdicios' => $desperdicios,
            'nombre' => $nombre,
            'email' => $email,
           
        ]);


        }


























}
