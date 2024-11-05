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
        $cita = new Cita($_POST);
        $respuesa = [
            'cita' => $cita
        ];

        echo json_encode($respuesta);
    }
}