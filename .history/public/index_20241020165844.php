<?php 

error_reporting(E_ALL);

// Activa la visualización de errores en pantalla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

// Iniciar sesion

$router->get('/', [LoginController::class, 'login']); // es tipo get, cuando visiste esta url va a mandar llamar el loginController
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']); // vamos a validar que se le envie al usuario por medio de su email de una forma en la que comprobemos que es esa persona la que nos esta pidiendo una nueva contraseña


// Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// confirmar cuenta

$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();