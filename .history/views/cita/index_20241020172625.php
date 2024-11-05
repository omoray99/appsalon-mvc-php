<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina" > Elige tus servicios y coloca tus datos</p>

<div id="app">
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p> Elige tus servivios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y Cita</h2>
        <p> Coloca tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="campo">
                <label for="fecha">fecha</label>
                <input type="date" id="fecha">
            </div>
        </form>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p> Verifica que la información sea correcto</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

</div>