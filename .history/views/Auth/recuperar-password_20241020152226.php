<h1 class="nombre-pagina"> Recuperar Password</h1>
<p class="descripcion-pagina"> Coloca tu nueva contraseña a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formilario" method="POST">
    <div class="campo">
        <label for="password"> Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu nueva Contraseña">
    </div>
    <input type="submit" class="boton" value="Guardar nueva contraseña "> 

</form>

<div class="acciones">
    <a href="/">Ya tiene cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? create ahora!</a>
</div>