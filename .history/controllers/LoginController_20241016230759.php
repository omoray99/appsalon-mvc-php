<?php

namespace Controllers;

use Model\usuario;
use MVC\Router;

class LoginController{

    public static function login( Router $router){
        
        $router->render('Auth/login');
    }

    public static function logout(){
        echo "Desde Logout...";
    }

    public static function olvide( Router $router){
        $router->render('/Auth/olvide-password', [

        ]);
    }

    public static function recuperar(){
        echo "Desde recuperar...";
    }

    public static function crear(Router $router ){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new usuario($_POST);
        }
        $router->render('/Auth/crear-cuenta', [

        ]);
    }
    
}
