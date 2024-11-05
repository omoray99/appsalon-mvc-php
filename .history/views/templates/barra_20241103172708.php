
<div class="barra">
    <p>Hola: <?php echo $nombre ?? '';  ?> </p>

    <a class="boton" href="/logout"> Cerrar Sesión</a> 
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin"></a>
        <a class="boton" href=""></a>
        <a class="boton" href=""></a>
    </div>

<?php }  ?>