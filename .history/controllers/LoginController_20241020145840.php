<?php

namespace Controllers;

use Classes\Email;
use Model\usuario;
use MVC\Router;

class LoginController{

    public static function login( Router $router){
        $alertas = [];

        $auth = new usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new usuario($_POST); // INSTANCIAR LA CLASE USUARIO Y LE VAMOS A PASAR LO QUE EL USUARIO LE ESCRIBA EN POST
            
            $alertas = $auth->validarLogin();

            if(empty($alertas)){ // en caaso de que las alertas esten vacios entonces el usuario nos ha dado el usuario y pass
                // comprobar que exista el usuario
                $usuario = usuario::where('email', $auth->email); // toma la columna que vamos a comparar y el valor que vamos a comparar
                if($usuario){
                    // Verificar el pass
                    //debuguear($usuario);
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)){
                        // si esta todo correcto, se autentica al usuario
                        if(session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionamiento si es admin o no
                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else {
                            header('Location: /cita');
                        }
                    }
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

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                //verificar que el usuario exista
                $usuario = usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado === "1"){
                    // generar un token para poder enviar email
                    $usuario->crearToken();
                    $usuario->guardar();

                    // TODO: ENVIAR EL EMAIL
                    usuario::getAlertas('exito', 'Revisa tu email');

                }else{
                    usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = usuario::getAlertas();
        $router->render('Auth/olvide-password', [
            'alertas'=> $alertas
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
