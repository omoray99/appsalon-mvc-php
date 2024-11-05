<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcionpagina"> Administación de servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="servicios">
    <?php foreach($servicios as $servicio){ ?>
        <li>
            <p>Nombre: <span><?php echo $servicio  ?> </span></p>
        </li>
    <?php }  ?>
</ul>