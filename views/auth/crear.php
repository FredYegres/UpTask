<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/crear">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre; ?>">
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo $usuario->email; ?>">
            </div>

            <div class="campo campo-password">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña">
                <img class="boton-password" src="/build/img/ocultar.svg" alt="ocultar password">
            </div>

            <div class="campo campo-password">
                <label for="password2">Confirmar Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Contraseña">
                <img class="boton-password" src="/build/img/ocultar.svg" alt="ocultar password">
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>

<?php include_once __DIR__ . '/footer-auth.php'; ?>