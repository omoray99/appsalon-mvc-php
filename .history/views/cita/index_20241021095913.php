<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina" > Elige tus servicios y coloca tus datos</p>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1"> Servicios </button>
        <button type="button" data-paso="2"> Información Cita </button>
        <button type="button" data-paso="3"> Resumen </button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center"> Elige tus servivios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y Cita</h2>
        <p class="text-center"> Coloca tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" value=" <?php  echo $nombre; ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">fecha</label>
                <input type="date" id="fecha">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>

        </form>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center"> Verifica que la información sea correcto</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >
        &laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >
         Siguiente &raquo;</button>

    </div>

</div>

<?php
    $script = "
    
    ":
?>