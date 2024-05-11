<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__text">Escribe tu nuevo Password</p>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($token_valido): ?>
        <form method="post" class="formulario">
            <div class="formulario__campo">
                <label class="formulario__label" for="password">Password</label>
                <input 
                    type="password"
                    class="formulario__input"
                    placeholder="Tu Nuevo Password"
                    id="password"
                    name="password"
                />
            </div>

            <input type="submit" value="Guardar Cambios" class="formulario__submit">
        </form>

        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
        </div>
    <?php endif; ?>
</main>