<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al Perfil</a>

    <form class="formulario" method="POST">
    <div class="campo campo-password">
            <label for="password_actual">Contraseña Actual</label>
            <input 
                type="password" 
                name="password_actual" 
                id="password_actual"
                placeholder="Tu Contraseña Actual"
            />
            <img class="boton-password" src="/build/img/ocultar.svg" alt="ocultar password">
        </div>

        <div class="campo campo-password">
            <label for="password_nuevo">Contraseña</label>
            <input 
                type="password" 
                name="password_nuevo"
                id="password"
                placeholder="Tu Contraseña Nueva"
            />
            <img class="boton-password" src="/build/img/ocultar.svg" alt="ocultar password">
        </div>

        <div class="campo campo-password">
            <label for="password2">Confirmar Contraseña</label>
            <input 
                type="password" 
                name="password2" 
                id="password2" 
                placeholder="Repite tu Contraseña Nueva"
            />
            <img class="boton-password" src="/build/img/ocultar.svg" alt="ocultar password">
        </div>

        <input type="submit" class="boton" value="Guardar Contraseña">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>