<?php include 'includes/header.php'; ?>

<?php if (isset($_GET['mensaje'])): ?>
    <div style="background-color: #f8f9fa; border: 1px solid #ccc; padding: 10px; margin: 15px; border-radius: 5px; color: #333;">
        <?php echo htmlspecialchars($_GET['mensaje']); ?>
    </div>
<?php endif; ?>

<section class="back-hero">
    <form action="includes/procesar_registro.php" method="post">
        <fieldset class="formulario">
            <legend>Regístrate</legend>

            <div class="form-row">
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Alejandro" required>
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Reyes Patricio" required>
                </div>
            </div>

            <label for="celular">Celular</label>
            <input type="number" name="celular" id="celular" required>

            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" placeholder="correo@example.com" required>

            <div class="form-row">
                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div>
                    <label for="conf_password">Confirma tu contraseña</label>
                    <input type="password" name="conf_password" id="conf_password" required>
                </div>
            </div>

            <button type="submit">Registrarse</button>

            <div class="extra-links">
                <a href="login.php">¿Ya tienes una cuenta? Inicia Sesión</a>
            </div>
        </fieldset>
    </form>
</section>

<?php include 'includes/footer.php'; ?>