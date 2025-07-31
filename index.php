<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);


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

// editar diseño
$router->get('/admin/diseno/editarDiseno', [DiseñoController::class, 'editarDiseno']);
$router->post('/admin/diseno/editarDiseno', [DiseñoController::class, 'editarDiseno']);









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

// eliminar diseño





// cerrar sesión
$router->get('/cerrarSesion', [AuthController::class, 'cerrarSesion']);



$router->comprobarRutas();






