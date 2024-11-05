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
            $idCita = 0;
            foreach($citas as $cita){
                if( $idCita !== $cita->id ){ // consulta si hay un id ya anterior para que no se repita
        ?>
       <li>
           <p>ID: <span><?php echo $cita->id; ?> </span></p>
           <p>Hora: <span><?php echo $cita->hora; ?> </span></p>
           <p>Cliente: <span><?php echo $cita->cliente; ?> </span></p>
           <?php $idCita = $cita->id; } //Fin del if  ?>
        </li>
        <?php  } // fin del foreach ?>
    </ul>
</div>