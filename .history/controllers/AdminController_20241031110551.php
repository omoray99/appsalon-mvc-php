<?php

namespace Controllers;

use MVC\Router;

class AdminController{

    public static function index( Router $router ){  // esta va a tener datos porque va a consultar la bd y va a mostrar la cita ahi
        session_start();

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre']
        ]);

    }

}