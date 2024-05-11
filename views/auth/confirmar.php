<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__text">
        Tu Cuenta DevWebCamp
    </p>
    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if(isset($alertas['exito'])):?>
        <i class="fa-solid fa-champagne-glasses"></i>
        <div class="acciones--centrar">
            <a href="/login" class="acciones__enlace">Iniciar Sesión</a>
        </div>
    <?php endif; ?>

</main>