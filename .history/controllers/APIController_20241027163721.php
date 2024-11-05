<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index(){
       $servicios = Servicio::all();   // es un metodo estatico no require instanciar, no requiere el new
        //echo json_encode($servicios);
    }

    public static function guardar(){
        
        // ALMACENA LA CITA Y DEVUELVE EL ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // ALMACENA LA CITA Y EL SERVICIO

        // ALMACENA los servicios con el ID de la cita 
        $idServicios = explode(",", $_POST['Servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'servicioId' => trim($idServicio) // Limpia espacios en blanco
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        // retornamos una respuesta
        $respuesta = [
            'resultado' => $resultado
        ];


        echo json_encode($respuesta);
    }
}