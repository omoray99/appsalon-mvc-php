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
        $usuario = new usuario($_POST);
        
        // Alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);  

            $alertas = $usuario->validarNuevaCuenta();
            //debuguear($alertas);

            // Revisar que alertas este vacio
            if(empty($alertas)){
                // verificar que el usuario no este registrado
                $usuario->existeUsuario();
            }

        }
        $router->render('/Auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    
}
