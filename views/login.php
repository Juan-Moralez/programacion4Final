<?php
session_start();
?>

<link rel="stylesheet" href="../public/visual/style.css">
<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert-success">
        <?= $_SESSION['mensaje'] ?>

        <?php if (isset($_SESSION['link_recuperacion'])): ?>
            <br>
            <a href="<?= $_SESSION['link_recuperacion'] ?>">
                Restablecer contraseña
            </a>
        <?php endif; ?>
    </div>

    <?php unset($_SESSION['mensaje']); ?>
    <?php unset($_SESSION['link_recuperacion']); ?>
<?php endif; ?>


<div class="auth-container">
    <div class="auth-card">
        
    <?php if (!empty($_SESSION['password_actualizada'])): ?>
    <div class="alert-success" id="mensaje-ok">
        ✅ Contraseña actualizada correctamente
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById("mensaje-ok");
            if (msg) msg.style.display = "none";
        }, 5000);
    </script>

    <?php unset($_SESSION['password_actualizada']); ?>
<?php endif; ?>

    
    <h2>Iniciar sesión</h2>



        <form method="POST" action="../controllers/authcontroller.php">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit" name="login">Ingresar</button>
        </form>

        <a href="register.php">Crear cuenta</a>
    
    
    <a href="recuperar.php" class="auth-link">¿Olvidaste tu contraseña?</a>

      </div>

</div>
