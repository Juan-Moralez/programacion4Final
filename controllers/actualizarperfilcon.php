<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/perfil.php");
    exit;
}

$pass = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if ($pass !== $confirm) {
    die("Las contraseñas no coinciden.");
}

if (strlen($pass) < 6) {
    die("La contraseña debe tener al menos 6 caracteres.");
}

$hash = password_hash($pass, PASSWORD_BCRYPT);
$idUsuario = (int)$_SESSION['usuario']['id'];

$stmt = $pdo->prepare("UPDATE usuarios SET contrausuarioscol = ? WHERE idusuarios = ?");
$stmt->execute([$hash, $idUsuario]);

header("Location: ../public/perfil.php");
exit;
