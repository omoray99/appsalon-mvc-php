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

    public static function guardar() {
    
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
    
        $id = $resultado['id'];
    
        // Verifica si 'Servicios' está en $_POST antes de intentar usar explode()
        if (isset($_POST['Servicios']) && !empty($_POST['Servicios'])) {
            $idServicios = explode(",", $_POST['Servicios']);
    
            // Agrega var_dump para depurar los valores
            var_dump($id); // Muestra el ID de la cita creada
            var_dump($idServicios); // Muestra el array de servicios
    
            foreach ($idServicios as $idServicio) {
                $args = [
                    'citaId' => $id,
                    'servicioId' => $idServicio
                ];
                $citaServicio = new CitaServicio($args);
                $citaServicio->guardar();
            }
        } else {
            // Maneja el caso en el que 'Servicios' no esté definido o esté vacío
            echo json_encode(['error' => 'No se han enviado servicios.']);
            return;
        }
    
        // Retornamos una respuesta
        $respuesta = [
            'resultado' => $resultado
        ];
    
        echo json_encode($respuesta);
    }
}    