<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripccion-pagina">Restablece tu password escribiendo tu emaila a continuacion</p>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu email" name="email">
    </div>

    <input type="submit" class="boton" value="Enviar">

</form>

<div class="acciones">
    <a href="/">ya tienes una cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
</div>