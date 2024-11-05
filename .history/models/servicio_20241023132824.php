<?php

namespace Model;

class Servicio extends ActiveRecord {
    // base de datos
    protected static $tabla = 'servicios';
    protected static $columnas = ['id', 'nombre', 'precio'];

}