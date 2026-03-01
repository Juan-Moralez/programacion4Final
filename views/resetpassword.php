<?php
session_start();

$token = $_GET['token'] ?? null;
if (!$token) die("Token inválido");
?>

<link rel="stylesheet" href="../public/visual/style.css">

<div class="auth-container">
    <div class="auth-card">
        <h2>Nueva contraseña</h2>

        <form method="POST" action="../controllers/resetpasswordcontroller.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="password" name="password" placeholder="Nueva contraseña" required>
            <button type="submit">Guardar</button>
        </form>
    </div>
</div>
