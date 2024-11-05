<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{

    public static function index(Router $router)
    {  // esta va a tener datos porque va a consultar la bd y va a mostrar la cita ahi
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //debuguear($_GET);
        $fecha = $_GET['fecha'];
        debuguear( checkdate($fecha) );
        $fecha = date('Y-m-d');

        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '{$fecha}'";

        $citas = AdminCita::SQL($consulta);
        //debuguear($citas);

        // consultar la bd
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
