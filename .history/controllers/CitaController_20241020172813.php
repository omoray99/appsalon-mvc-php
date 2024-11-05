<?php

namespace Controllers;

use MVC\Router;

class CitaController{

    public static function index(Router $router ){
        //va a arrancar la session de nuevo
        session_start();
        debuguear($_SESSION);

        $router->render('cita/index', [

        ]);
    }
}