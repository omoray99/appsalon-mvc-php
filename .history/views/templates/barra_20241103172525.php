
<div class="barra">
    <p>Hola: <?php echo $nombre ?? '';  ?> </p>

    <a class="boton" href="/logout"> Cerrar Sesión</a> 
</div>

<?php if(isset($_SESSION['admin'])){
        echo "si es admin";
    } else {
        echo "No es admin"
    }?>