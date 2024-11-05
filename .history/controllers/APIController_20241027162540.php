<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index(){
       $servicios = Servicio::all();   // es un metodo estatico no require instanciar, no requiere el new
        echo json_encode($servicios);
    }

    public static function guardar(){
        
        // ALMACENA LA CITA Y DEVUELVE EL ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // ALMACENA LA CITA Y EL SERVICIO
        $idServicios = explode(",", $_POST['Servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        $respuesta = [
            'resultado' => $idServicios
        ];


        echo json_encode($resultado);
    }
}