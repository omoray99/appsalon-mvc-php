<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

// Iniciar sesion

$router->get('/', [LoginController::class, 'login']); // es tipo get, cuando visiste esta url va a mandar llamar el loginController
$router->post('/', [LoginController::class, 'login']);
$router->get('/', [LoginController::class, 'login']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();