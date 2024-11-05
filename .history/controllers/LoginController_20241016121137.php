<?php

namespace Controllers;

use MVC\Router;

class LoginController{

    public static function login( Router $router){
        
        $router->render('Auth/login');
    }

    public static function logout(){
        echo "Desde Logout...";
    }

    public static function olvide(){
        echo "Desde olvide...";
    }

    public static function recuperar(){
        echo "Desde recuperar...";
    }

    public static function crear(Router $router ){
        $router->render('/Auth/crear-cuenta', [
            
        ])
    }
    
}
