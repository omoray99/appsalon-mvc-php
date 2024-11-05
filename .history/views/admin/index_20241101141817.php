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
            foreach($citas as $key=> $cita){
                //debuguear($key);

                if( $idCita !== $cita->id ){ // consulta si hay un id ya anterior para que no se repita
                    $total = 0;
        ?>
       <li>
           <p>ID: <span><?php echo $cita->id; ?> </span></p>
           <p>Hora: <span><?php echo $cita->hora; ?> </span></p>
           <p>Cliente: <span><?php echo $cita->cliente; ?> </span></p>
           <p>Email: <span><?php echo $cita->email; ?> </span></p>
           <p>Telefono: <span><?php echo $cita->telefono; ?> </span></p>
            
           <h3>Servicios </h3>

           <?php $idCita = $cita->id; } //Fin del if
            $total += $cita->precio;
           ?>
           <p class="servicio"> <?php echo $cita->servicio . " - Precio: Gs." . $cita->precio; ?> </p>
           <?php  
                $actual = $cita->id; // nos va a retornar el id donde nos encontramos
                $proximo = $citas[$key + 1]->id ?? 0; // el indice en el arreglo de la bd
                
                if(esUltimo($actual, $proximo)){
                    echo "si es ultimo";
                }

           ?> 
        <?php  } // fin del foreach ?>
    </ul>
</div>