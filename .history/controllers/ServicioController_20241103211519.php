<?php

namespace Controllers;

use MVC\Router;

class ServicioController {

    public static function index(Router $router){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $router->render('servicios/index', [

        ]);
    }

    public static function crear(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        } 
    }

    public static function actualizar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        } 
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        } 
    }
}