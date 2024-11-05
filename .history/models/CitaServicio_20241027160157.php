<?php

namespace Model;

class CitaServicio extends ActiveRecord{
    // base de datos
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];

    public $id;
    public $citaId;
    public $hora;
}