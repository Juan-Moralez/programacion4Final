<?php session_start(); ?>
<link rel="stylesheet" href="../public/visual/style.css">

<div class="auth-container">
    <div class="auth-card">

        <h2>Recuperar contraseña</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert-success">
                <?= $_SESSION['mensaje'] ?>

                <?php if (isset($_SESSION['link_recuperacion'])): ?>
                    <br><br>
                    <a href="<?= $_SESSION['link_recuperacion'] ?>">
                        Restablecer contraseña
                    </a>
                <?php endif; ?>
            </div>

            <?php unset($_SESSION['mensaje']); ?>
            <?php unset($_SESSION['link_recuperacion']); ?>
        <?php endif; ?>

        <form action="../controllers/recuperarcontroller.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" required>

            <button type="submit">Enviar enlace</button>
        </form>

        <a href="login.php">Volver al login</a>

    </div>
</div>
