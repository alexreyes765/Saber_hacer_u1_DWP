<?php include 'includes/header.php'; ?>

<section class="back-hero">
    <form action="includes/procesar_login.php" method="post">
        <fieldset class="formulario">
            <legend>Inicia Sesion</legend>

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" placeholder="correo@example.com" require>

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" require>

            <button type="submit">Iniciar Sesion</button>

            <div class="extra-links">
                <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
                <a href="registro.php">¿No tienes una cuenta? Regístrate</a>
            </div>

        </fieldset>
    </form>
</section>

<?php include 'includes/footer.php'; ?>