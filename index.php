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
use Controllers\ApiTest;
use Controllers\ApiPedidos;
use Controllers\Subirexcel;
use Controllers\ApiMaquinas;
use Controllers\ApiProductos;
use Controllers\AreaController;
use Controllers\AuthController;
use Controllers\AdminController;

use Controllers\PapelController;
use Controllers\ClienteController;
use Controllers\EstimarController;
use Controllers\MaquinaController;
use Controllers\CartoneraController;
use Controllers\ComercialController;
use Controllers\ControlController;
use Controllers\CotizadorController;
use Controllers\PlanificoController;
use Controllers\FinancieroController;
use Controllers\ProduccionController;
use Controllers\MateriaPrimaController;
use Controllers\EstadisticaProdController;
use Controllers\SistemasController;
use Model\MateriaPrima;

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


$router->comprobarRutas();






