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
            foreach($citas as $cita){
        ?>
       <li>
           <p>ID: <span><?php echo $cita->id; ?> </span></p>
        </li>
        <?php  } ?>
    </ul>
</div>