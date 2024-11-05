<?php

namespace Controllers;

use MVC\Router;

class CitaController{

    public static function index(Router $router ){
        //va a arrancar la session de nuevo
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
            isAuth();
        }
        // Verificar si 'nombre' está en la sesión
        $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null;

        $router->render('cita/index', [
            'nombre' => $nombre,
            'id' => $_SESSION['id']
        ]);
    }
}