<?php

namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = 'citaservicios';
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente;
}