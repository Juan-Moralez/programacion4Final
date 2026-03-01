<link rel="stylesheet" href="../public/visual/style.css">


<div class="auth-container">
    <div class="auth-card">
        <h2>Crear cuenta</h2>

        <form method="POST" action="../controllers/authcontroller.php">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit" name="register">Registrarse</button>
        </form>

        <a href="login.php">Ya tengo cuenta</a>
    </div>
</div>
