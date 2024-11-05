<?php

namespace Controllers;

use Model\Servicio;

class APIController {
    public static function index(){
        $servicios = Servicio::all();   // es un metodo estatico no require instanciar, no requiere el new
        debuguear($servicios);
        echo json_encode($servicios);
    }
}