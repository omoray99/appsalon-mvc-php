<?php

namespace Controllers;

use Classes\Email;
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
        $router->render('Auth/olvide-password', [

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
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = usuario::getAlertas();
                }else{
                    // no esta registrado, entonces vamos a crear un nuevo usuario
                    // hashear el password
                    $usuario->hashPassword();

                    // Generar un token unico
                    $usuario->crearToken();
                    // Enviar el email
                    $email =  new Email($usuario->nombre, $usuario->email, $usuario->token);
                    // enviar mail de confirmacion
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }

                   // debuguear($usuario);
                }
            }

        }
        $router->render('Auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router ){

        $router->render('Auth/mensaje');
    }

    public static function confirmar( Router $router ){

        $router->render('Auth/confirmar-cuenta', [
            'alertas' => $alertas;
        ]);
    }
    
}
