<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}
include 'header.php';
?>


<div class="container">
    <h2>Gestión de Perfil</h2>
    <div class="manga-card">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['usuario']['email']) ?></p>
        
        <hr>
        <h3>Cambiar Contraseña</h3>
        <form action="../controllers/actualizarperfilcon.php" method="POST">
            <label>Nueva Contraseña:</label><br>
            <input type="password" name="password" required minlength="6"><br><br>
            
            <label>Confirmar Nueva Contraseña:</label><br>
            <input type="password" name="confirm_password" required><br><br>
            
            <button type="submit">Actualizar Datos</button>
        </form>
    </div>
</div>
