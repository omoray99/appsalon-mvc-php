<?php

namespace Controllers;

use Model\servicio;
use MVC\Router;

class ServicioController {

    public static function index(Router $router){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function crear(Router $router){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $servicio = new servicio;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
        } 

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio
        ]);
    }

    public static function actualizar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        } 

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre']
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        } 
    }
}