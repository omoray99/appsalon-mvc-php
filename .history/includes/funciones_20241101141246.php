<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool{

}

// funcion que revisa que el usuario este autenticado
function isAuth(): void {
    if(!isset($_SESSION['login'])){ // si no esta definido esa variable de sesion y no esta como true
        header('Location: /');
    }
}