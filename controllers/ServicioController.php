<?php

namespace Controllers;

use Model\servicio;
use MVC\Router;

class ServicioController {

    public static function index(Router $router){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $servicios = servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();

        $servicio = new servicio;

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alerta)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        } 

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();

         // valida que sea numero
        if (!is_numeric($_GET['id'])) return;

        $servicio = servicio::get($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }
        

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //debuguear($_POST);
            $id = $_POST['id'];
            $servicio = servicio::find($id);
            //debuguear($servicio);
            $servicio->eliminar();
            echo "<script>
            alert('El servicio ha sido eliminado exitosamente.');
            window.location.href = '/servicios';
            </script>";
        } 
    }
}