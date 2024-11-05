<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina" > Elige tus servicios y coloca tus datos</p>

<div class="barra">
    <p>Hola: <?php echo $nombre ?? '';  ?> </p>

    <a class="boton" href="/logout"> Cerrar Sesión</a> 
</div>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1"> Servicios </button>
        <button type="button" data-paso="2"> Información Cita </button>
        <button type="button" data-paso="3"> Resumen </button>
    </nav>

    

</div>

<?php
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script> 
    ";
?>