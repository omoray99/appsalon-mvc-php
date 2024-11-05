<?php

namespace Model;

class CitaServicio extends ActiveRecord{
    // base de datos
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
}