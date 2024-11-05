<?php

namespace Model;

class CitaServicio extends ActiveRecord{
    // base de datos
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];

    public $id;
    public $citaId;
    public $servicioId;

    public function __construct( $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citaId = $args['fecha'] ?? '';
        $this->servicioId = $args['hora'] ?? '';
    }
}