<?php

$db = mysqli_connect($_ENV['DB_HOST'], $ENV['DB_USER'], '123456789852', 'appsalon_mvc');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
