<?php

namespace Model;

class Cita extends ActiveRecord{
    // base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;
}