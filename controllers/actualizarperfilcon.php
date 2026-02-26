<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($pass !== $confirm) {
        die("Las contraseñas no coinciden."); // Aquí podrías usar tu sistema de errores
    }

    // Hashear la contraseña nueva (Requerimiento técnico) [cite: 46]
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    $idUsuario = $_SESSION['usuario']['id'];

    $stmt = $pdo->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
    if ($stmt->execute([$hash, $idUsuario])) {
        echo "Contraseña actualizada con éxito. <a href='../views/index.php'>Volver</a>";
    }
}