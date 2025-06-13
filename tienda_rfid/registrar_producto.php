<?php include 'includes/header.php'; ?>

<?php if (isset($_GET['mensaje'])): ?>
    <div style="background-color: #f8f9fa; border: 1px solid #ccc; padding: 10px; margin: 15px; border-radius: 5px; color: #333;">
        <?php echo htmlspecialchars($_GET['mensaje']); ?>
    </div>
<?php endif; ?>

<section class="back-hero">
    <form action="includes/procesar_producto.php" method="post">
        <fieldset class="formulario">
            <legend>Registrar productos</legend>

            <div class="form-row">
                <div>
                    <label for="producto">Producto</label>
                    <input type="text" name="producto" id="producto" placeholder="Lector UHF" required>
                </div>

                <div>
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" placeholder="10.00" required>
                </div>
            </div>

            <label for="categoria">Categoria</label>
            <input type="text" name="categoria" id="categoria" required>

            <label for="descripcion">Agrege una descripcion</label>
            <textarea name="descripcion" id="descripcion"></textarea>


            <button type="submit" name="agregar_producto">Agregar</button>
        </fieldset>
    </form>
</section>

<?php include 'includes/footer.php'; ?>