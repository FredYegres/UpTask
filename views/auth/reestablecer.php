<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Ingresa tu Nueva Contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if($mostrar) { ?>
            <form class="formulario" method="POST">

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

                <input type="submit" class="boton" value="Guardar Contraseña">
            </form>
        <?php } ?>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta?</a>

<?php include_once __DIR__ . '/footer-auth.php'; ?>