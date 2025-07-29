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



// tabla de consumo
$router->get('/admin/tablaConsumo', [AdminController::class, 'tablaConsumo']); 



// cerrar sesión

$router->get('/cerrarSesion', [AuthController::class, 'cerrarSesion']);



$router->comprobarRutas();






