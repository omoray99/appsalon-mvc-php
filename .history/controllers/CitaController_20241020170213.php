<?php

namespace Controllers;

use MVC\Router;

class CintaController{

    public static function index(Router $router ){
        $router->render('cita/index', [

        ]);
    }
}