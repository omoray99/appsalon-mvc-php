<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;

class APIController {
    public static function index(){
       $servicios = Servicio::all();   // es un metodo estatico no require instanciar, no requiere el new
        echo json_encode($servicios);
    }

    public static function guardar(){
        
        // ALMACENA LA CITA Y DEVUELVE EL ID
        //$cita = new Cita($_POST);
        //$resultado = $cita->guardar();

        // ALMACENA LA CITA Y EL SERVICIO
        $resultado = [
            'servicios' => $_POST['servicio']
        ];


        echo json_encode($resultado);
    }
}