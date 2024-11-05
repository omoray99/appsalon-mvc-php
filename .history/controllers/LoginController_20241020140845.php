<?php

namespace Controllers;

use Classes\Email;
use Model\usuario;
use MVC\Router;

class LoginController{

    public static function login( Router $router){
        $alertas = [];

        $auth = new usuario();
        debuguear($auth)

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new usuario($_POST); // INSTANCIAR LA CLASE USUARIO Y LE VAMOS A PASAR LO QUE EL USUARIO LE ESCRIBA EN POST
            
            $alertas = $auth->validarLogin();

            if(empty($alertas)){ // en caaso de que las alertas esten vacios entonces el usuario nos ha dado el usuario y pass
                // comprobar que exista el usuario
                $usuario = usuario::where('email', $auth->email); // toma la columna que vamos a comparar y el valor que vamos a comparar
                if($usuario){
                    // Verificar el pass
                    //debuguear($usuario);
                    $usuario->comprobarPasswordAndVerificado();
                }else
                    usuario::setAlerta('error', 'El usuario no existe');
            }
        }

        $alertas = usuario::getAlertas();
        $router->render('Auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
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
        $alertas = [];
         //sanitizar y leer token desde la url
        $token = s($_GET['token']);

        $user = usuario::where('token', $token);

        if(empty($user)){
            // MOSTRAR MENSAJE DE ERROR
            usuario::setAlerta('error', 'Token no valido');
        }else {
            //MODIFICAR A USUARIO CONFIRMADO
             //cambiar valor de columna confirmado
            $user->confirmado = "1";
            //eliminar token
            $user->token = "";   
            $user->guardar(); 
            usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        //debuguear($user);

        //debuguear($token);

        // OBTENER LAS ALERTAS
        $alertas = usuario::getAlertas();
        // RENDERIZAR LA VISTA
        $router->render('Auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
    
}
