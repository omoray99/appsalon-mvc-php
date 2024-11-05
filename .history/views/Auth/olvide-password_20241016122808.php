<h1 class="nombre-pagina"> Olvide Contraseña</h1>
<p class="descripcion-pagina"> Restablece tu contraseña escribiendo tu email a continuación</p>

<form class="formulario" action="/olvide" method="POST">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="tu email">
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión.!</a>
    <a href="/olvide"> ¿Olvidaste tu contreaseña?</a>

</div>