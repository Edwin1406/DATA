<?php 
    



// ini_set('display_errors', 1);
// error_reporting(E_ALL);



// Detectar la IP del visitante (considerando proxies)
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// Consultar la API de geolocalización
$response = file_get_contents("http://ip-api.com/json/$ip");
$data = json_decode($response);

// Verificar si es Ecuador
if ($data && $data->countryCode !== "EC") {
    // Redirigir si NO es Ecuador
    header("Location: oops_ip_no_segura.php");
    exit();
}






require_once __DIR__ . '/includes/app.php';


use MVC\Router;

use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\ControlController;
use Controllers\DiseñoController;
use Controllers\GraficasController;
use Controllers\PruebasController;

$router = new Router();


// Login
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
// $router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);



// Area de Administración

$router->get('/admin/index', [AdminController::class, 'index']);



// Dashboard
$router->get('/admin/consumo', [AdminController::class, 'consumo']);
$router->post('/admin/consumo', [AdminController::class, 'consumo']);


// consmo general
$router->get('/admin/consumo_general', [AdminController::class, 'consumo_general']);
$router->post('/admin/consumo_general', [AdminController::class, 'consumo_general']);

//  control_troquel
$router->get('/admin/control_troquel', [ControlController::class, 'control_troquel']);
$router->post('/admin/control_troquel', [ControlController::class, 'control_troquel']);


// diseño
$router->get('/admin/diseno/crearDiseno', [DiseñoController::class, 'crearDiseno']);
$router->post('/admin/diseno/crearDiseno', [DiseñoController::class, 'crearDiseno']);

// registro doblado
$router->get('/admin/control/doblado/consumo_doblado', [ControlController::class, 'consumo_doblado']);
$router->post('/admin/control/doblado/consumo_doblado', [ControlController::class, 'consumo_doblado']);


// registro convertidor
$router->get('/admin/control/convertidor/consumo_convertidor', [ControlController::class, 'consumo_convertidor']);
$router->post('/admin/control/convertidor/consumo_convertidor', [ControlController::class, 'consumo_convertidor']);


// registro GILLOTINA PAPEL
$router->get('/admin/control/guillotina/consumo_guillotina_papel', [ControlController::class, 'consumo_guillotina_papel']);
$router->post('/admin/control/guillotina/consumo_guillotina_papel', [ControlController::class, 'consumo_guillotina_papel']);


// generar turno
$router->get('/admin/turnoDiseno/generarTurno', [DiseñoController::class, 'generarTurno']);
$router->post('/admin/turnoDiseno/generarTurno', [DiseñoController::class, 'generarTurno']);




// editar diseño
$router->get('/admin/diseno/editarDiseno', [DiseñoController::class, 'editarDiseno']);
$router->post('/admin/diseno/editarDiseno', [DiseñoController::class, 'editarDiseno']);

// editar turno
$router->get('/admin/turnoDiseno/editarTurno', [DiseñoController::class, 'editarTurno']);
$router->post('/admin/turnoDiseno/editarTurno', [DiseñoController::class, 'editarTurno']);










// TABLAS
// tabla de consumo
$router->get('/admin/tablaConsumo', [AdminController::class, 'tablaConsumo']); 
// TABLA CONSUMO GENERAL
$router->get('/admin/tablaConsumoGeneral', [AdminController::class, 'tablaConsumoGeneral']);
// tabla admin consumo general
$router->get('/admin/tablaAdminConsumoGeneral', [AdminController::class, 'tablaAdminConsumoGeneral']);

// tabla consumo troquel
$router->get('/admin/tablaConsumoTroquel', [ControlController::class, 'tablaConsumoTroquel']);


// tabla diseño
$router->get('/admin/diseno/tablaDiseno', [DiseñoController::class, 'tablaDiseno']);


// tabla consumo doblado
$router->get('/admin/control/doblado/tablaConsumoDoblado', [ControlController::class, 'tablaConsumoDoblado']);


// tabla consumo convertidor
$router->get('/admin/control/convertidor/tablaConsumoConvertidor', [ControlController::class, 'tablaConsumoConvertidor']);

// tabla consumo guillotina papel
$router->get('/admin/control/guillotina/tablaConsumoGuillotinaPapel', [ControlController::class, 'tablaConsumoGuillotinaPapel']);

// turnotabladiseno
$router->get('/admin/turnoDiseno/turnotablaDiseno', [DiseñoController::class, 'turnotablaDiseno']);




// ELIMINAR
// eliminar consumo
$router->post('/admin/eliminarConsumo', [AdminController::class, 'eliminarConsumo']);
// ELIMINAR CONSUMO GENERAL
$router->post('/admin/eliminarConsumoGeneral', [AdminController::class, 'eliminarConsumoGeneral']);

// eliminar consumo troquel
$router->post('/admin/eliminarConsumoTroquel', [ControlController::class, 'eliminarConsumoTroquel']);
// eliminar pdf
$router->post('/admin/diseno/eliminarPDF', [DiseñoController::class, 'eliminarPDF']);
// eliminar registro con pdf
$router->post('/admin/eliminarDiseno', [DiseñoController::class, 'eliminarDiseno']);

// EDITAR CONSUMO GENERAL
$router->get('/admin/editarAdminConsumoGeneral', [AdminController::class, 'editarAdminConsumoGeneral']);
$router->post('/admin/editarAdminConsumoGeneral', [AdminController::class, 'editarAdminConsumoGeneral']);

// eliminar consumo doblado
$router->post('/admin/eliminarConsumoDoblado', [ControlController::class, 'eliminarConsumoDoblado']);

// eliminar consumo convertidor
$router->post('/admin/eliminarConsumoConvertidor', [ControlController::class, 'eliminarConsumoConvertidor']);

// eliminar consumo guillotina papel
$router->post('/admin/eliminarConsumoGuillotina', [ControlController::class, 'eliminarConsumoGuillotina']);

// eliminar turno diseño
$router->post('/admin/eliminarTurnoDiseno', [DiseñoController::class, 'eliminarTurnoDiseno']);








// links paa las graficas
$router->get('/admin/graficas/graficasConsumoGeneral', [GraficasController::class, 'graficasConsumoGeneral']);
$router->get('/admin/graficas/graficasDoblado', [GraficasController::class, 'graficasDoblado']);









// Apis para las graficas
$router->get('/admin/api/apiGraficasConsumoGeneral', [GraficasController::class, 'apiGraficasConsumoGeneral']);













// CRUD DE PRUEBAS 
// Crear prueba
$router->get('/admin/pruebas/crearPruebas', [PruebasController::class, 'crearPruebas']);
$router->post('/admin/pruebas/crearPruebas', [PruebasController::class, 'crearPruebas']);


// eliminar carrito
$router->post('/admin/eliminarCarrito', [PruebasController::class, 'eliminarCarrito']);

// REGISTRAR VENTA
$router->post('/admin/pruebas/registrarVenta', [PruebasController::class, 'registrarVenta']);














// cerrar sesión
$router->get('/cerrarSesion', [AuthController::class, 'cerrarSesion']);



$router->comprobarRutas();






