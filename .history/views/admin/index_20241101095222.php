<h1 class="nombre-pagina"> Panel de Administración   </h1>

<?php include_once __DIR__ . '/../templates/barra.php';

?>

<h2> Buscar Citas </h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">    
        </div>
        

    </form>
</div>

<div id="citas-admin">

    <ul class="citas">
        <?php
            debuguear($citas);
        ?>
    </ul>
</div>