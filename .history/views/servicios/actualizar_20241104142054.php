<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcionpagina"> Modificar los valores del formulario</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<?php
    //include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/formulario.php';
    ?>

<input type="submit" class="boton" value="Guardar Servicio">

</form>